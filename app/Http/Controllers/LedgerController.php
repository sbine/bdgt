<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Ledger;
use Bdgt\Resources\Bill;

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
        $ledger = new Ledger;

        $c['ledger'] = $ledger;

        $bills = Bill::all();

        $bills->sortBy(function ($bill) {
            return $bill->nextDue;
        });

        $c['nextBill'] = $bills->first();

        return view('ledger/index', $c);
    }
}
