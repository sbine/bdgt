<?php

namespace Bdgt\Providers;

use Faker\Provider\Base;
use OverflowException;

class FakerProvider extends Base
{
    public function randomAccount()
    {
        $accounts = [
            'Bank Co',
            'Auto Loan',
            'Personal Loan',
            'Checking',
            'Savings',
            'Credit',
            'Gift Card',
        ];

        return $this->randomMostlyUnique($accounts);
    }

    public function randomCategory()
    {
        $categories = [
            'Fuel' => 5,
            'Groceries' => 10,
            'Restaurants' => 1,
            'Fast Food' => 1,
            'Entertainment' => 1,
            'Rent' => 1,
            'Car Insurance' => 1,
            'Car Repairs' => 1,
            'Home Maintenance' => 1,
            'Clothing' => 3,
            'Health Insurance' => 1,
            'Cell Phone' => 2,
            'Pets' => 2,
            'Home' => 2,
            'Childcare' => 1,
            'Gifts' => 1,
            'Health Expenses' => 3,
            'Charity' => 1,
            'Energy Bill' => 1,
            'Water Bill' => 1,
            'Coffee' => 1,
            'Alcohol' => 2,
            'Education' => 5,
            'Digital Services' => 1,
        ];

        return self::getRandomWeightedElement($categories);
    }

    public function randomBill()
    {
        $bills = [
            'Water',
            'Natural Gas',
            'Cell Phone',
            'Internet',
            'Gym',
            'Trash',
            'Auto Loan',
        ];

        return $this->randomMostlyUnique($bills);
    }

    public function randomFlair()
    {
        $flairs = [
            'lightgray',
            'red',
            'orange',
            'yellow',
            'green',
            'blue',
            'purple'
        ];

        return $this->randomElement($flairs);
    }

    public function randomAmount($max = 2000)
    {
        $random = rand(0, 100);
        if ($random <= 90) {
            return $this->generator->biasedNumberBetween(0, 50) . '.' . $this->numberBetween(0, 99);
        }

        return $this->generator->biasedNumberBetween(0, $max, function($x) { return 1 - pow($x, 4); }) . '.' . $this->numberBetween(0, 99);
    }

    private function randomMostlyUnique($elements)
    {
        // Attempt to keep fake data unique, but fall back on duplicates if necessary
        try {
            return $this->unique()->randomElement($elements);
        } catch (OverflowException $e) {
            $this->unique(true);
            return $this->randomElement($elements);
        }
    }

    public static function getRandomWeightedElement($values)
    {
        $rand = mt_rand(1, (int)array_sum($values));

        foreach ($values as $k => $v) {
            $rand -= $v;
            if ($rand <= 0) {
                return $k;
            }
        }
    }
}
