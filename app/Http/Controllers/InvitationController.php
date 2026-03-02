<?php

namespace App\Http\Controllers;

use App\Helpers\Base64;
use App\Http\Requests\AcceptInvitationRequest;
use App\Http\Requests\InvitationRequest;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Services\EditInvitationService;
use App\Services\SendInvitationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    //

    public function edit(Request $req, EditInvitationService $service)
    {
        $dto = $service->execute($req->input('invit'));
        if (!$dto) return redirect()->route('app.colocations.index');
        return view('colocation.invitation', compact(['dto']));
    }
    public function update(AcceptInvitationRequest $req)
    {
        $dto = $req->dto();
        DB::transaction(function () use ($dto) {
            $invit = Invitation::find($dto->invitation->id);
            $invit->status = in_array($dto->choice, ['ACCEPTED', 'DECLINED']) ? $dto->choice : 'PENDING';
            $invit->save();
            if ($invit->status === 'ACCEPTED') {
                Colocation::find($invit->colocation_id)
                    ->users()
                    ->syncWithoutDetaching([auth()->user()->id]);
            }
        });
        return redirect()->route('app.colocations.index');
    }
    public function store(InvitationRequest $req, SendInvitationService $service)
    {
        try {
            // dd($req->dto());
            $service->execute($req->dto());
            return redirect()->back()->with('ok', 'invit successfully sent');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'error message');
        }
    }
}
