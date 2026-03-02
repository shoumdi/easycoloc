<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateColocation;
use App\Models\Colocation;
use App\Services\CreateColocationService;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $colocations = $user->colocations()->get();
        // dd($colocations);
        return view('colocation.index',compact('colocations'));
    }

    public function show($id)
    {
        // dd(route('member.invite'));
        $colocation = Colocation::with([
            'users' => function ($q) {
                $q->wherePivot('left_at', null);
            }
        ])->find($id);
        // dd($colocation->users[0]->username);
        return view('colocation.details', compact('colocation'));
    }
    public function store(CreateColocation $request, CreateColocationService $service)
    {
        $data = $request->validated();
        $coloc = new Colocation();
        $coloc->name = $data['name'];
        $service->execute($coloc);
        return redirect()->route('app.colocations.show', ['id' => $coloc->id]);
    }
}
