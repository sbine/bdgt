<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Ledger;

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

        return view('ledger/index', $c);
    }
}
