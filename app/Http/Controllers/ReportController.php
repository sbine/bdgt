<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Services\ReportService;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the default report to the user.
     *
     * @return Response
     */
    public function index()
    {
        return $this->show('spending');
    }

    /**
     * Show an individual report to the user.
     *
     * @param $type
     * @return Response
     */
    public function show($type)
    {
        $reportService = new ReportService($type);

        $report = (object)[
            'name' => $reportService->getReportName(),
            'url' => '/reports/ajax/' . $type,
        ];

        return view('report.show', compact('report'));
    }

    /**
     * Retrieve report data based on type
     * @param  string $type
     * @return Response
     */
    public function ajax_report($type)
    {
        $reportService = new ReportService($type);

        return response()->json($reportService->get(Input::get('startDate'), Input::get('endDate')));
    }
}
