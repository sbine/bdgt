<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Ledger;
use App\Models\Transaction;
use Illuminate\Support\Facades\Request;
use App\Exports\TransactionsExport;
use Excel;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index')
            ->with('transactions', Transaction::all())
            ->with('ledger', new Ledger)
            ->with('accounts', Account::all())
            ->with('categories', Category::all());
    }

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

    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    public function update(Transaction $transaction)
    {
        request()->validate([
            'date' => 'required|date',
            'amount' => 'required',
            'payee' => 'required',
            'account_id' => 'required|numeric',
            'inflow' => 'required',
            'category_id' => 'nullable|numeric',
        ]);

        if ($transaction->update(Request::all())) {
            return redirect()->back()->with('alerts.success', trans('crud.transactions.updated'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.transactions.error'));
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->delete()) {
            return redirect(route('dashboard'))->with('alerts.success', trans('crud.transactions.deleted'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.transactions.error'));
    }

    public function export()
    {
        return Excel::download(new TransactionsExport, "transaction-report.csv");
    }
}
