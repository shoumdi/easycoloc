<?php

namespace App\Services;

use App\Helpers\Base64;
use App\Http\Dto\InvitationDto;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function Symfony\Component\Clock\now;

class SendInvitationService
{
    public function execute(InvitationDto $dto)
    {
        // dd($dto);
        $token = Colocation::find($dto->colocation->id)
                ->invitations()
                ->create([
                    'token' => Base64::encode([
                        'colocation_id' => $dto->colocation->id,
                        'email' => $dto->email,
                        'iat' => now(),
                        'exp' => 1700000
                    ])
                ])->token;
        $userExists = User::where('email',$dto->email)->exists();

            Mail::raw('open this link : ' . route(!$userExists ? 'register' : 'app.colocations.invitations.edit', ['invit' => $token]), function ($m) {
                $m->to('xhoumdi25@gmail.com')
                    ->subject('Colocation invit');
            });
    }
}
