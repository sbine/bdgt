<?php

namespace App\Reports;

use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Spending implements Reportable
{
    public function name()
    {
        return 'spending_over_time';
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
            $startDate = Carbon::now()->subYear();
        }
        // If no end date, initialize to now
        if (! $endDate) {
            $endDate = Carbon::now();
        }

        if ($startDate->diffInMonths($endDate) === 0) {
            // If range is < 1 month, use days as interval
            $interval = CarbonInterval::day();
            $dateFormat = 'Y_m_d';
            $labelFormat = 'M j';
        } else {
            // Otherwise use months
            $interval = CarbonInterval::month();
            $dateFormat = 'Y_m';
            $labelFormat = 'F';
        }

        // Limit it to our date range and group by category
        $results = $this->getQueryResults($startDate, $endDate, $interval);

        $dataSets = [];
        $labels = [];
        $labelsInitialized = false;
        $total = 0;

        foreach ($results as $result) {
            $data = [];
            // Retrieve totals for every interval (e.g. month)
            $date = $startDate->copy();
            while ($date <= $endDate) {
                $key = 'total_' . $date->format($dateFormat);
                $data[] = (float)$result->$key;
                if (! $labelsInitialized) {
                    $labels[] = $date->format($labelFormat);
                }
                $date->add($interval);
            }
            $labelsInitialized = true;
            $total += array_sum($data);

            $dataSets[] = [
                'data' => $data,
                'name' => $result->category,
            ];
        }

        return [
            'datasets' => $dataSets,
            'labels' => $labels,
            'total' => $total,
        ];
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param CarbonInterval $interval
     * @return Collection
     */
    private function getQueryResults(Carbon $startDate, Carbon $endDate, CarbonInterval $interval): Collection
    {
        $dateFormat = 'Y-m';
        $dateSqlFormat = '%Y-%m';
        $dateLabelFormat = 'Y_m';

        if ($interval->equalTo(CarbonInterval::day())) {
            $dateFormat = 'Y-m-d';
            $dateSqlFormat = '%Y-%m-%d';
            $dateLabelFormat = 'Y_m_d';
        }

        $query = Transaction::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d 23:59:59')])
            ->addSelect(DB::raw('categories.label AS category'))
            ->groupBy('category')
            ->join('categories', 'category_id', '=', 'categories.id');

        $date = $startDate->copy();
        while ($date <= $endDate) {
            // Select totals for every interval period
            $query->addSelect(
                DB::raw('SUM(IF(DATE_FORMAT(date, "' . $dateSqlFormat . '") = "' . $date->format($dateFormat) . '",amount,0)) as total_' . $date->format($dateLabelFormat))
            );
            $date->add($interval);
        }

        return $query->get();
    }
}
