<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Account;

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
}
