<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategory;
use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class ColocationCategoriesController extends Controller
{
    public function index($id){
        $colocation = Colocation::find($id);
        $categories = $colocation->first()
            ->categories()->with('depenses')->get();
        return view('colocation.categories',compact(['categories','colocation']));
    }

    public function store(CreateCategory $request,$id){
        Colocation::find($id)
            ->first()
            ->categories()
            ->create($request->all(['name','description']));
        return redirect()->back();
    }
}
