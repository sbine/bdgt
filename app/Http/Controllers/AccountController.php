<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Account;

use Input;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $c['accounts'] = Account::all();

        return view('account/index', $c);
    }

    public function show($id)
    {
        try {
            $account = Account::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/accounts');
        }

        $c['account'] = $account;

        return view('account/show', $c);
    }

    public function store()
    {
        if ($account = Account::create(Input::all())) {
            session()->flash('alerts.success', 'Account created');
            return redirect("/accounts/{$account->id}");
        } else {
            session()->flash('alerts.danger', 'Account creation failed');
            return redirect()->back();
        }
    }

    public function update($id)
    {
        if (Account::where('id', '=', $id)->update(Input::except(['_token', '_method']))) {
            session()->flash('alerts.success', 'Account updated');
            return redirect("/accounts/{$id}");
        } else {
            session()->flash('alerts.danger', 'Account update failed');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if (Account::where('id', '=', $id)->delete()) {
            session()->flash('alerts.success', 'Account deleted');
            return redirect("/accounts");
        } else {
            session()->flash('alerts.danger', 'Account deletion failed');
            return redirect()->back();
        }
    }
}
