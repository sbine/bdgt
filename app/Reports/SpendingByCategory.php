<?php

namespace Bdgt\Reports;

use Bdgt\Repositories\Contracts\TransactionRepositoryInterface;
use DateTime;
use DateInterval;

class SpendingByCategory implements Reportable
{
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function name()
    {
        return 'Spending By Category';
    }

    public function get($startDate = null, $endDate = null)
    {
        $query = $this->transactionRepository->model();

        // If no start date, initialize to 1 year ago
        if (!$startDate) {
            $startDate = new DateTime(date('Y-m-d'));
            $monthInterval = new DateInterval('P1M');
            $monthInterval->invert = 1;
            $startDate->add($monthInterval);
        }
        // If no end date, initialize to now
        if (!$endDate) {
            $endDate = new DateTime(date('Y-m-d'));
        }
        // Limit it to our date range and group by category
        $results = $query->selectRaw('SUM(amount) AS total, categories.label AS category')
                        ->whereBetween('date', [$startDate->format('Y-m-01'), $endDate->format('Y-m-d')])
                        ->groupBy('transactions.category_id')
                        ->join('categories', 'category_id', '=', 'categories.id')->get();

        $dataSets = [];
        $labels = [];
        foreach ($results as $result) {
            $labels[] = $result->category;
            $dataSets[] = $result->total;
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $dataSets,
                ]
            ],
        ];
    }
}
