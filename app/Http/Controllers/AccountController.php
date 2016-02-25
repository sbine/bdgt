<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\AccountRepositoryInterface;
use Input;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->repository = $accountRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $c['accounts'] = $this->repository->all();

        $c['accounts']->sortBy('name');

        return view('account.index', $c);
    }

    /**
     * Show an individual account to the user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $account = $this->repository->find($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/accounts');
        }

        $c['account'] = $account;

        return view('account.show', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $account->transactions ]);
    }

    /**
     * Create and store a new account.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($account = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect("/accounts/{$account->id}")->with('alerts.success', trans('crud.accounts.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }

    /**
     * Update an existing account with new data.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->repository->update(Input::except(['_token', '_method']), $id)) {
            return redirect("/accounts/{$id}")->with('alerts.success', trans('crud.accounts.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }

    /**
     * Delete an account by ID.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            return redirect("/accounts")->with('alerts.success', trans('crud.accounts.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }
}
