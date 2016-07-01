<?php

namespace Bdgt\Reports;

use Bdgt\Repositories\Contracts\TransactionRepositoryInterface;
use Bdgt\Repositories\Contracts\CategoryRepositoryInterface;
use DB;
use DateTime;
use DateInterval;

class Spending implements ReportInterface
{
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function name()
    {
        return 'Spending Over Time';
    }

    public function get($startDate = null, $endDate = null)
    {
        $query = $this->transactionRepository->query();

        // If no start date, initialize to 1 year ago
        if (!$startDate) {
            $startDate = new DateTime(date('Y-m-d'));
            $monthInterval = new DateInterval('P1M');
            $yearInterval = new DateInterval('P1Y');
            $yearInterval->invert = 1;
            $startDate->add($yearInterval);
        }
        // If no end date, initialize to now
        if (!$endDate) {
            $endDate = new DateTime(date('Y-m-d'));
        }
        $date = new DateTime($startDate->format('Y-m-d'));
        while ($date <= $endDate) {
            // Select totals for every month
            $query->addSelect(DB::raw('SUM(IF(DATE_FORMAT(date, "%Y-%m") = "' . $date->format('Y-m') . '",amount,0)) as total_' . $date->format('Y_m')));
            $date->add($monthInterval);
        }
        // Limit it to our date range and group by category
        $results = $query->whereBetween('date', [$startDate->format('Y-m-01'), $endDate->format('Y-m-d')])
                        ->selectRaw('date, categories.label AS category')
                        ->groupBy('category')
                        ->join('categories', 'category_id', '=', 'categories.id')->get();

        $dataSets = [];
        $labels = [];
        $labelsInitialized = false;
        foreach ($results as $result) {
            $data = [];
            // Retrieve totals for every month
            $date = new DateTime($startDate->format('Y-m-d'));
            while ($date <= $endDate) {
                $key = 'total_' . $date->format('Y_m');
                $data[] = (float)$result->$key;
                if (!$labelsInitialized) {
                    $labels[] = $date->format('F');
                }
                $date->add($monthInterval);
            }
            $labelsInitialized = true;

            $dataSets[] = [
                'data' => $data,
                'label' => $result->category,
            ];
        }
        return [
            'datasets' => $dataSets,
            'labels' => $labels,
        ];
    }
}
