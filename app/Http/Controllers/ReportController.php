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
        return response()->json(
            ReportFactory::generate($type)
                           ->forDateRange(new Carbon(Request::input('startDate')), new Carbon(Request::input('endDate')))
        );
    }
}
