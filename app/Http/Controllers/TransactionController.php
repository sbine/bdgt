<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Ledger;
use Bdgt\Resources\Transaction;
use Bdgt\Resources\Account;

use Input;
use Response;

class TransactionController extends Controller
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
        $ledger = new Ledger;

        $c['ledger'] = $ledger;

        $c['accounts'] = Account::all();

        return view('transaction/index', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $ledger->transactions() ]);
    }

    public function store()
    {
        $transaction = Input::all();

        if (Transaction::create($transaction)) {
            return Response::json(["status" => "success"]);
        }
        return Response::json(["status" => "error"]);
    }

    public function update($id)
    {
        $transaction = Transaction::find($id);

        $transaction = [
            Input::get('name') => Input::get('value'),
        ];

        if (Transaction::where('id', '=', $id)->update($transaction)) {
            return Response::json(["status" => "success"]);
        }
        return Response::json(["status" => "error"]);
    }
}
