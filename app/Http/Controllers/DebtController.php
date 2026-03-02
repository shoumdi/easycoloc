<?php

namespace App\Http\Controllers;

use App\Services\DebtService;
use Exception;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function __construct(
        private DebtService $service
    ) {}
    function update($colocation, $debt)
    {
        try {
            $this->service->update($debt);
        } catch (Exception $e) {
            dd($e);
        } finally {
            return redirect()->back();
        }
    }
}
