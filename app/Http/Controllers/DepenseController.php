<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepenseRequest;
use App\Http\Requests\DeleteDepense;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\Dept;
use App\Services\CreateExpenseService;
use App\Services\ExpenseService;
use DomainException;
use Exception;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function __construct(private ExpenseService $service) {}
    public function index($id)
    {
        $colocation = Colocation::find($id);
        $depenses = $colocation->depenses()->get();
        $debts = $colocation->depts()->where('is_paid', false)->with(['debitor', 'creditor'])->get();
        return view('colocation.expenses', compact(['depenses', 'colocation', 'debts']));
    }

    public function store(CreateDepenseRequest $req)
    {
        $this->service->create($req->dto());
        return redirect()->back();
    }
    function destroy(Colocation $colocation, Depense $expense,)
    {
        try {
            $this->service->delete($colocation, $expense);
        } catch (Exception $e) {
            ///log
            // dd($e);
        } finally {
            return redirect()->back();
        }
    }

   
}
