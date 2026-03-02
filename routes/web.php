<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ColocationCategoriesController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    switch (auth()->user()->load('role')->role->name) {
        case 'Admin':
            return redirect()->route('admin');
            break;
        case "User":
            return redirect()->route('app.colocations.index');
            break;
        default:
            # code...
            break;
    }
})->name('index');

Route::middleware(['auth','banned'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', AdminDashboardController::class)->name('admin');
    Route::put('/admin/users/{user}/update', [AdminUsersController::class,'update'])->name('admin.users.update');
    Route::prefix('app/colocations')
        ->name('app.colocations.')
        ->group(function () {
            Route::get('/', [ColocationController::class, 'index'])->name('index');
            Route::post('/', [ColocationController::class, 'store'])->name('post');
            Route::get('/{id}', [ColocationController::class, 'show'])->name('show');
            
            //members
            Route::delete('/members',[MemberController::class,'destroy'])->name('members.destroy');
            //categories routes
            Route::get('/{id}/categories', [ColocationCategoriesController::class, 'index'])->name('categories.index');
            Route::post('/{id}/categories', [ColocationCategoriesController::class, 'store'])->name('categories.store');

            //expenses routes
            Route::get('/{id}/expenses', [DepenseController::class, 'index'])->name('expenses.index');
            Route::post('/{id}/expenses', [DepenseController::class, 'store'])->name('expenses.store');
            Route::delete('/{colocation}/expenses/{expense}', [DepenseController::class, 'destroy'])->name('expenses.destroy');
            Route::put('/{colocation}/debts/{debt}', [DebtController::class, 'update'])->name('debts.update');

            //history
            Route::get('/{id}/history', [HistoryController::class, 'index'])->name('history.index');

            //invit
            Route::get('/invitations/edit',[InvitationController::class,'edit'])->name('invitations.edit');
            Route::patch('/invitations/update',[InvitationController::class,'update'])->name('invitations.update');
        });
    Route::post('/invite', [InvitationController::class,'store'])->name('member.invite');
});

require __DIR__ . '/auth.php';
