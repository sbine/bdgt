<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\Bill;

class BillEventController
{
    public function __invoke()
    {
        $billsByDate = [];
        if (Request::has(['start', 'end'])) {
            Bill::all()->each(function ($bill) use (&$billsByDate) {
                $dueDates = $bill->getDueDatesForInterval(Request::get('start'), Request::get('end'));

                foreach ($dueDates as $date) {
                    $billsByDate[] = [
                        'title' => $bill->label . ' due',
                        'url' => route('bills.show', $bill->id),
                        'paid' => $bill->paid,
                        'start' => $date,
                        'end' => $date,
                    ];
                }
            });
        }

        return response()->json($billsByDate);
    }
}
