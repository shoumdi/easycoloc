<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Base64;
use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Role;
use App\Models\User;
use App\Services\RegisterUserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $invit = $request->input('invit', '');
        $invitee = json_decode(Base64::decode($invit));
        return view('auth.register', compact('invitee', 'invit'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, RegisterUserService $service): RedirectResponse
    {

        $service->execute(
            $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'invitee' => ['string']
            ]),
            json_decode($request->invitee)
        );
        return redirect(route('index', absolute: false));
    }
}
