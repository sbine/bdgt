<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bill;
use App\Models\Category;
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
            'accounts' => Account::select('id', 'name')
                ->orderBy('name')
                ->get(),
            'bills' => $bills
                ->map
                ->only(['id', 'label'])
                ->sortBy('label')
                ->values(),
            'categories' => Category::select('id', 'label')
                ->orderBy('label')
                ->get(),
            'flairs' => [
                'lightgray',
                'red',
                'orange',
                'yellow',
                'green',
                'blue',
                'purple',
            ],
        ]);
    }
}
