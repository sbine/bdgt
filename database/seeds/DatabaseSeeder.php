<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
