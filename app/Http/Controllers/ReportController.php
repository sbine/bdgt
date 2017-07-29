<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Services\ReportService;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    private $reportService;

    /**
     * Create a new controller instance.
     *
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
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
        $report = (object)[
            'name' => $this->reportService->generate($type)->name(),
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
        return response()->json(
            $this->reportService->generate($type)
                                ->get(Input::get('startDate'), Input::get('endDate'))
        );
    }
}
