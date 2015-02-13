<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Account;
use Bdgt\Resources\Transaction;

class LedgerController extends Controller
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
        $account = new Account;
        $transactions = [];

        for ($i = 1; $i < 10; $i++) {
            $account->addTransaction(Transaction::find($i));
        }

        $c['ledger'] = [
            $account
        ];

        return view('ledger/index', $c);
    }
}
