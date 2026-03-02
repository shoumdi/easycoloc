<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Dept;
use App\Models\User;
use DomainException;
use Exception;
use Illuminate\Support\Facades\DB;

class ExpenseService
{
    public function create($dto)
    {
        DB::transaction(function () use ($dto) {
            // dd($dto);
            $depense = Category::find($dto->category_id)
                ->depenses()
                ->create([
                    'titre' => $dto->titre,
                    'montant' => $dto->montant,
                    'date' => $dto->date,
                    'payer_id' => $dto->payer_id
                ]);
            $this->calculateDebts($depense->colocation);
        });
    }

    public function delete(Colocation $colocation, Depense $expense)
    {
        // $coloc = $expense->colocation;
        if ($colocation->depts()->where('is_paid', false)->exists()) throw new DomainException('cannot delete with unpaid debts');
        DB::transaction(function () use ($expense, $colocation) {
            // dd($expense);
            $expense->delete();
        });
    }

    private function calculateDebts(Colocation $coloc)
    {
        $members = $coloc->users()->whereNull('left_at')->get();
        $expenses = $coloc->depenses;

        $coloc->depts()->where('is_paid', false)->delete();
        foreach ($expenses as $expense) {
            $membersCount = $members->count();
            if ($membersCount === 0) continue;
            $part = $expense->montant / $membersCount;
            foreach ($members as $member) {
                if ($member->id === $expense->payer_id) continue;
                $debt = $coloc->depts()->create([
                    'debitor_id' => $member->id,
                    'creditor_id' => $expense->payer_id,
                    'amount' => $part
                ]);
            }
        }
    }
}
