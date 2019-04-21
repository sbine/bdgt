<?php

namespace App\Reports;
use App\Resources\Transaction;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Spending implements Reportable
{
    public function name()
    {
        return 'Spending Over Time';
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public function forDateRange($startDate = null, $endDate = null)
    {
        // If no start date, initialize to 1 year ago
        if (! $startDate) {
            $startDate = $this->getOneYearAgoDate();
        }
        // If no end date, initialize to now
        if (! $endDate) {
            $endDate = new DateTime(date('Y-m-d'));
        }

        // Limit it to our date range and group by category
        $results = $this->getQueryResults($startDate, $endDate);

        $dataSets = [];
        $labels = [];
        $labelsInitialized = false;
        $monthInterval = new DateInterval('P1M');

        foreach ($results as $result) {
            $data = [];
            // Retrieve totals for every month
            $date = new DateTime($startDate->format('Y-m-d'));
            while ($date <= $endDate) {
                $key = 'total_' . $date->format('Y_m');
                $data[] = (float)$result->$key;
                if (! $labelsInitialized) {
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

    /**
     * @return DateTime
     */
    private function getOneYearAgoDate(): DateTime
    {
        $startDate = new DateTime(date('Y-m-d'));
        $yearInterval = new DateInterval('P1Y');
        $yearInterval->invert = 1;
        $startDate->add($yearInterval);

        return $startDate;
    }

    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return Collection
     */
    private function getQueryResults(DateTime $startDate, DateTime $endDate): Collection
    {
        $monthInterval = new DateInterval('P1M');

        $query = Transaction::whereBetween('date', [$startDate->format('Y-m-01'), $endDate->format('Y-m-d')])
            ->addSelect('date')
            ->addSelect(DB::raw('categories.label AS category'))
            ->groupBy('category')
            ->join('categories', 'category_id', '=', 'categories.id');

        $date = new DateTime($startDate->format('Y-m-d'));
        while ($date <= $endDate) {
            // Select totals for every month
            $query = $query->addSelect(DB::raw('SUM(IF(DATE_FORMAT(date, "%Y-%m") = "' . $date->format('Y-m') . '",amount,0)) as total_' . $date->format('Y_m')));
            $date->add($monthInterval);
        }

        return $query->get();
    }
}
