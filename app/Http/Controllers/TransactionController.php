<?php

namespace App\Http\Controllers;

use App\Resources\Account;
use App\Resources\Category;
use App\Resources\Ledger;
use App\Resources\Transaction;
use Illuminate\Support\Facades\Input;

class TransactionController extends Controller
{
    /**
     * Show the application dashboard to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.index')
            ->with('transactions', Transaction::all())
            ->with('ledger', new Ledger)
            ->with('accounts', Account::all())
            ->with('categories', Category::all());
    }

    /**
     * Show an individual transaction to the user.
     *
     * @param  Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    /**
     * Create and store a new transaction.
     *
     * @return Redirect
     */
    public function store()
    {
        request()->validate([
            'date'        => 'required|date',
            'amount'      => 'required',
            'payee'       => 'required',
            'account_id'  => 'required|numeric',
            'inflow'      => 'required',
            'category_id' => 'numeric',
        ]);

        if (Transaction::create(Input::all())) {
            return redirect()->back()->with('alerts.success', trans('crud.transactions.created'));
        }
        return redirect()->back()->with('alerts.danger', trans('crud.transactions.error'));
    }

    /**
     * Update an existing transaction with new data.
     *
     * @param  Transaction $transaction
     *
     * @return Redirect
     */
    public function update(Transaction $transaction)
    {
        request()->validate([
            'date'        => 'required|date',
            'amount'      => 'required',
            'payee'       => 'required',
            'account_id'  => 'required|numeric',
            'inflow'      => 'required',
            'category_id' => 'numeric',
        ]);

        if ($transaction->update(Input::all())) {
            return redirect()->back()->with('alerts.success', trans('crud.transactions.updated'));
        }
        return redirect()->back()->with('alerts.danger', trans('crud.transactions.error'));
    }

    /**
     * Delete a transaction.
     *
     * @param  Transaction $transaction
     *
     * @return Redirect
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->delete()) {
            return redirect(route('transactions.index'))->with('alerts.success', trans('crud.transactions.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.transactions.error'));
        }
    }
}
