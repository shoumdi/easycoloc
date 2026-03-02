<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\RemoveMember;
use App\Models\Colocation;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

use function Symfony\Component\Clock\now;

class MemberController extends Controller
{
    public function post(InvitationRequest $req) {}

    public function destroy(RemoveMember $req)
    {
        $dto = $req->dto();
        // dd($dto);
        FacadesDB::transaction(function () use ($dto){
            Colocation::find($dto->pivot->colocation_id)
                ->users()
                ->updateExistingPivot($dto->id, ['left_at' => now()]);
        });
        return redirect()->back();
    }
}
