<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Dept;
use DomainException;
use Illuminate\Support\Facades\DB;

class DebtService
{
    

    function update($debtId)
    {
        $debt = Dept::findOrFail($debtId);
        if ($debt->is_paid) throw new DomainException('this debt is already paid');

        if ($debt->debitor_id !== auth()->user()->id) throw new DomainException('not able to pay this debt');

        DB::transaction(function () use ($debt) {
            $debt->update(['is_paid' => true]);
            // dd($debt);
            if (Dept::where('creditor_id', $debt->creditor_id)
                ->where('is_paid', false)
                ->count()
            ) $debt->debitor()->increment('reputation');
        });
    }
}
