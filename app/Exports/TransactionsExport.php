<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function map($transaction): array
    {
        $amount = $transaction->amount;
        if (! $transaction->inflow) {
            $amount *= -1;
        }

        return [
            $transaction->date,
            $transaction->account->name,
            $transaction->category->label,
            $transaction->bill->label,
            $transaction->payee,
            $amount,
            $transaction->cleared ? 'Yes' : 'No',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactions = Transaction::with([
            'account' => function ($query) {
                $query->select('id', 'name');
            },
            'category' => function ($query) {
                $query->select('id', 'label');
            },
            'bill' => function ($query) {
                $query->select('id', 'label');
            },
        ])->ordered()
          ->get();

        return $transactions;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Account',
            'Category',
            'Bill',
            'Payee',
            'Amount',
            'Cleared',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }
}
