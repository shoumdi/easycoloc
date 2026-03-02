<?php

namespace App\Services;

use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{

    public function execute($data, $invitation)
    {
        DB::transaction(function () use ($data, $invitation) {
            $user = Role::where('name', (!User::exists()) ? 'Admin' : 'User')
                ->first()
                ->users()
                ->create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
            // dd(Colocation::where('id', $invitation->colocation_id)->first());
            if (isset($invitation)) Colocation::where('id', $invitation->colocation_id)
                ->first()
                ->users()->syncWithoutDetaching([$user->id]);

            event(new Registered($user));

            Auth::login($user);
        });
    }
}
