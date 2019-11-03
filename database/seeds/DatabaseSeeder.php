<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('DummyDataSeeder');
        //$this->call('UserSeeder');
        //$this->call('AccountSeeder');
        //$this->call('TransactionSeeder');
        //$this->call('CategorySeeder');
        //$this->call('BillSeeder');
        //$this->call('GoalSeeder');
    }
}
