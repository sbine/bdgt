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
        $start_date = new Carbon(Request::input('startDate'));
        $end_date = new Carbon(Request::input('endDate'));
        $difference = $start_date->diffInYears($end_date);
        if ($difference > 0) {
            $end_date = $start_date->addYear();
        }
        return response()->json(
            [
                'chart' => ReportFactory::generate($type)
                    ->forDateRange($start_date, $end_date),
                'startDate' => $start_date,
                'endDate' => $end_date,
            ]
        );
    }
}
