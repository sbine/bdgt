<?php

namespace App\Http\Controllers;

use App\Reports\ReportFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

class ReportController extends Controller
{
    public function index()
    {
        return $this->show('spending');
    }

    public function show($type)
    {
        $report = (object)[
            'name' => ReportFactory::generate($type)->name(),
            'url' => '/reports/ajax/' . $type,
        ];

        return view('report.show')->with('report', $report)->with('type', $type);
    }

    public function ajax($type)
    {
        $startDate = new Carbon(Request::input('startDate'));
        $endDate = new Carbon(Request::input('endDate'));
        if ($startDate->diffInDays($endDate) > 366) {
            $endDate = $startDate->copy()->addYear();
        }

        return response()->json(
            [
                'data' => ReportFactory::generate($type)->forDateRange($startDate, $endDate),
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]
        );
    }
}
