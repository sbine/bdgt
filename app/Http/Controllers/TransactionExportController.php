<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionExportController
{
    public function __invoke()
    {
        return Excel::download(new TransactionsExport, 'bdgt-transactions.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
