<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Depense;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        $totalUsers = User::count();
        $bannedUsers = User::where('is_banned', true)->count();
        $totalSpent = Depense::sum('montant');
        $totalColocations = Colocation::count();
        $users = User::whereHas('role', function ($q) {
            $q->where('name', '!=', 'Admin');
        })->get();
        // dd($users);
        return view('admin.index', compact(['users','totalUsers','bannedUsers','totalColocations','totalSpent']));
    }
}
