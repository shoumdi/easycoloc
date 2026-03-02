<?php

namespace App\Services;

use App\Models\Colocation;
use App\Models\User;

class CreateColocationService
{
    public function __construct() {}
    public function execute(Colocation $coloc)
    {
        $test = auth()->user()->saveColocation($coloc);
    }
}
