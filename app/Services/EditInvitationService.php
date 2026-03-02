<?php

namespace App\Services;

use App\Models\Colocation;
use App\Models\Invitation;

class EditInvitationService
{

    public function execute($token)
    {
        $invit = Invitation::where('token', $token)->first();
        if ($invit->expired()) return null;
        $coloc = Colocation::find($invit->colocation_id)->with('users')->first();
        foreach ($coloc->users as $user) {
            if ($user->id === $coloc->created_by) {
                $owner = $user;
                break;
            }
        }
        return json_decode(json_encode(['invit'=>$invit,'coloc'=>$coloc,'owner'=>$owner]));
    }
}
