<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Request;

class BillEventController
{
    public function __invoke()
    {
        $billsByDate = [];
        if (Request::has(['start', 'end'])) {
            Bill::with('transactions')->get()->each(function ($bill) use (&$billsByDate) {
                $dueDates = $bill->getDueDatesForInterval(Request::get('start'), Request::get('end'));

                foreach ($dueDates as $date) {
                    $billsByDate[] = [
                        'title' => $bill->label . ' due',
                        'url' => route('bills.show', $bill->id),
                        'paid' => $bill->paid,
                        'start' => $date,
                        'end' => (new DateTime($date))->add(new DateInterval('P1D'))->format('Y-m-d'),
                    ];
                }
            });
        }

        return response()->json($billsByDate);
    }
}
