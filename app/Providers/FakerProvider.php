<?php

namespace Bdgt\Providers;

use Faker\Provider\Base;

class FakerProvider extends Base
{
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

        return $this->randomElement($categories);
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
}
