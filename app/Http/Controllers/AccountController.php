<?php

namespace App\Http\Controllers;

use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index')->with(
            'accounts',
            Account::withCount('transactions')->get()->sortBy(function ($account) {
                return $account->name;
            })
        );
    }

    public function store()
    {
        request()->validate([
            'date_opened' => 'required|date',
            'name' => 'required',
            'balance' => 'required|numeric',
            'interest' => 'required|numeric',
        ]);

        if ($account = Account::create(request()->all())) {
            return redirect(route('accounts.show', $account->id))->with('alerts.success', trans('crud.accounts.created'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
    }

    public function show(Account $account)
    {
        return view('account.show')->with('account', $account->load('transactions', 'transactions.category', 'transactions.account'));
    }

    public function update(Account $account)
    {
        if ($account->update(request()->all())) {
            return redirect(route('accounts.show', $account->id))->with('alerts.success', trans('crud.accounts.updated'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
    }

    public function destroy(Account $account)
    {
        if ($account->delete()) {
            return redirect(route('accounts.index'))->with('alerts.success', trans('crud.accounts.deleted'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
    }
}
