<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('AccountSeeder');
        $this->call('TransactionSeeder');
        $this->call('CategorySeeder');
        $this->call('BillSeeder');
        $this->call('GoalSeeder');
    }
}
