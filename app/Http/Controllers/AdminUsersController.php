<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    function update(User $user)
    {
        $user->is_banned = !$user->is_banned;
        $user->save();
        return redirect()->back();
    }
}
