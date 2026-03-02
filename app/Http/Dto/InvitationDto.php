<?php

namespace App\Http\Dto;

class InvitationDto
{
    public function __construct(
        readonly object $colocation,
        readonly string $email
    ) {}
}
