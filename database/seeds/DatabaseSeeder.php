<?php

use Illuminate\Database\Seeder;
use Sbine\Tenancy\SuperAdmin;
use Sbine\Tenancy\Tenant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()->singleton(Tenant::class, SuperAdmin::class);

        // $this->call(DummyDataSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BillSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(GoalSeeder::class);
    }
}
