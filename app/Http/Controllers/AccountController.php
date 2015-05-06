<?php namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\AccountRepositoryInterface;
use Bdgt\Resources\Account;

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

        return view('account/index', $c);
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

        return view('account/show', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $account->transactions() ]);
    }

    /**
     * Create and store a new account.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($account = $this->repository->create(Input::all())) {
            session()->flash('alerts.success', 'Account created');
            return redirect("/accounts/{$account->id}");
        } else {
            session()->flash('alerts.danger', 'Account creation failed');
            return redirect()->back();
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
            session()->flash('alerts.success', 'Account updated');
            return redirect("/accounts/{$id}");
        } else {
            session()->flash('alerts.danger', 'Account update failed');
            return redirect()->back();
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
            session()->flash('alerts.success', 'Account deleted');
            return redirect("/accounts");
        } else {
            session()->flash('alerts.danger', 'Account deletion failed');
            return redirect()->back();
        }
    }
}
