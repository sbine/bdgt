<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Input;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index')->with(
            'accounts',
            Account::all()->sortBy(function ($account) {
                return $account->name;
            })
        );
    }

    /**
     * Show an individual account to the user.
     *
     * @param  Account $account
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('account.show')->with('account', $account->load('transactions'));
    }

    /**
     * Create and store a new account.
     *
     * @return Redirect
     */
    public function store()
    {
        request()->validate([
            'date_opened' => 'required|date',
            'name' => 'required',
            'balance' => 'required|numeric',
            'interest' => 'required|numeric',
        ]);

        if ($account = Account::create(Input::all())) {
            return redirect(route('accounts.show', $account->id))->with('alerts.success', trans('crud.accounts.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }

    /**
     * Update an existing account with new data.
     *
     * @param  Account $account
     *
     * @return Redirect
     */
    public function update(Account $account)
    {
        if ($account->update(Input::all())) {
            return redirect(route('accounts.show', $account->id))->with('alerts.success', trans('crud.accounts.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }

    /**
     * Delete a account.
     *
     * @param  Account $account
     *
     * @return Redirect
     */
    public function destroy(Account $account)
    {
        if ($account->delete()) {
            return redirect(route('accounts.index'))->with('alerts.success', trans('crud.accounts.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }
}
