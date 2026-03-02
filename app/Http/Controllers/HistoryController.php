<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($id){
        $colocation = Colocation::find($id);
        return view('colocation.history',compact(['colocation']));
    }
}
