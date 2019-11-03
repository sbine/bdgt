<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Models\Bill;

class BillEventController
{
    public function __invoke()
    {
        $billsByDate = [];
        if (Input::has(['start', 'end'])) {
            Bill::all()->each(function ($bill) use (&$billsByDate) {
                $dueDates = $bill->getDueDatesForInterval(Input::get('start'), Input::get('end'));

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
