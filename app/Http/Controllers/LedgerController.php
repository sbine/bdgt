<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\BillRepositoryInterface;
use Bdgt\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Input;

class LedgerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository, BillRepositoryInterface $billRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->billRepository        = $billRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $ledger = new Ledger($this->transactionRepository);

        $c['ledger'] = $ledger;

        $bills = $this->billRepository->all();

        $bills->sortBy(function ($bill) {
            return $bill->nextDue;
        });

        $c['nextBill'] = $bills->first();

        return view('ledger.index', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $ledger->transactions(), 'actionable' => true ]);
    }
}
