<?php

namespace Bdgt\Providers;

use Faker\Provider\Base;

class FakerProvider extends Base
{
    public function randomCategory()
    {
        $categories = [
            'Gas',
            'Groceries',
            'Bills',
            'Restaurants',
            'Entertainment',
            'Rent',
            'Insurance',
            'Cell Phone',
            'Pets',
            'Home',
            'Childcare',
            'Gifts',
            'Health',
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
