<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Ledger;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $bills = Bill::all()->sortBy('nextDue');
        $transactions = Transaction::with(['account', 'category'])->ordered()->get();

        return view('dashboard')->with([
            'ledger' => new Ledger,
            'nextBill' => $bills->first(),
            'transactions' => $transactions,
            'accounts' => $transactions
                ->map(function ($transaction) {
                    return $transaction->account->only(['id', 'name']);
                })
                ->unique()
                ->sortBy('name')
                ->values(),
            'bills' => $bills
                ->map
                ->only(['id', 'label'])
                ->sortBy('label')
                ->values(),
            'categories' => $transactions
                ->map(function ($transaction) {
                    return $transaction->category->only(['id', 'label']);
                })
                ->unique()
                ->sortBy('label')
                ->values(),
            'flairs' => $transactions
                ->map
                ->flair
                ->unique()
                ->sort()
                ->values()
        ]);
    }
}
