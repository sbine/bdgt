<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Request;

class TransactionController extends Controller
{
    public function store()
    {
        request()->validate([
            'date' => 'required|date',
            'amount' => 'required',
            'payee' => 'required',
            'account_id' => 'required|numeric',
            'inflow' => 'required',
            'category_id' => 'nullable|numeric',
        ]);

        if (Transaction::create(Request::all())) {
            return redirect()->back()->with('alerts.success', trans('crud.transactions.created'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.transactions.error'));
    }
}
