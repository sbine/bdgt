<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionExportController
{
    public function __invoke()
    {
        return Excel::download(new TransactionsExport, 'transaction-report.csv');
    }
}
