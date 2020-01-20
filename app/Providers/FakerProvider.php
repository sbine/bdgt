<?php

namespace App\Providers;

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
            'Fuel',
            'Groceries',
            'Restaurants',
            'Fast Food',
            'Entertainment',
            'Rent',
            'Car Insurance',
            'Car Repairs',
            'Home Maintenance',
            'Clothing',
            'Health Insurance',
            'Cell Phone',
            'Pets',
            'Home',
            'Childcare',
            'Gifts',
            'Health Expenses',
            'Charity',
            'Energy Bill',
            'Water Bill',
            'Coffee',
            'Alcohol',
            'Education',
            'Digital Services',
        ];

        return $this->randomMostlyUnique($categories);
    }

    public function randomGoal()
    {
        $goals = [
            'New cell phone',
            'New car',
            'College',
            'Laracon',
            'Down payment',
            'Retirement',
            'Holiday gifts',
        ];

        return $this->randomMostlyUnique($goals);
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
            'purple',
        ];

        return $this->randomElement($flairs);
    }

    public function randomAmount($max = 2000)
    {
        $random = random_int(0, 100);
        if ($random <= 90) {
            return $this->generator->biasedNumberBetween(0, 50) . '.' . $this->numberBetween(0, 99);
        }

        return $this->generator->biasedNumberBetween(0, $max, function ($x) {
            return 1 - pow($x, 4);
        }) . '.' . $this->numberBetween(0, 99);
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
}
