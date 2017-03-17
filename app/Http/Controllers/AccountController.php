<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param AccountRepositoryInterface $accountRepository
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
        $accounts = $this->repository->all(['name' => 'asc']);

        return view('account.index', compact('accounts'));
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
        } catch (ModelNotFoundException $e) {
            return redirect(route('accounts.index'));
        }

        return view('account.show', compact('account'))->nest('transactions', 'transaction._list', [ 'transactions' => $account->transactions ]);
    }

    /**
     * Create and store a new account.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($account = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect(route('accounts.show', $account->id))->with('alerts.success', trans('crud.accounts.created'));
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
            return redirect(route('accounts.show', $id))->with('alerts.success', trans('crud.accounts.updated'));
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
            return redirect(route('accounts.index'))->with('alerts.success', trans('crud.accounts.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.accounts.error'));
        }
    }
}
