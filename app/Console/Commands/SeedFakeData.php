<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Goal;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SeedFakeData extends Command
{
    protected $signature = 'seed:fakedata
                            {--p|purge : Wipe user data for admin@example.com before seeding}
                            {--a|add-noise : Add random noise to a few categories (for report variance)}';

    protected $description = 'Seed realistic-looking fake data for the user admin@example.com';

    public function handle()
    {
        $adminUser = User::where('email', 'admin@example.com')->first();

        if ($adminUser) {
            $this->info('Found existing admin user.');
        } else {
            $this->info('No admin user found, creating a new one...');
            $adminUser = User::factory()->create([
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
            ]);
        }

        Auth::login($adminUser);

        if ($this->option('purge')) {
            if (App::environment('production')
                && ! $this->confirm('PRODUCTION ENVIRONMENT. Are you sure you want to purge admin@example.com?')
            ) {
                return 1;
            }

            $this->warn('Purge option was specified, deleting all admin data!');

            $adminUser->accounts()->delete();
            $adminUser->categories()->delete();
            $adminUser->bills()->delete();
            $adminUser->goals()->delete();
            $adminUser->transactions()->delete();
        }

        $this->seed($adminUser, $this->option('add-noise'));

        Auth::logout();
    }

    private function seed(User $adminUser, bool $addNoise = false)
    {
        $this->info('Seeding fake accounts...');
        Account::insert(Account::factory()->count(5)->make()->toArray());
        $this->info('Seeding fake bills...');
        Bill::insert(Bill::factory()->count(5)->make()->toArray());
        $this->info('Seeding fake goals...');
        Goal::insert(Goal::factory()->count(5)->make()->toArray());

        $this->info('Seeding fake transactions...');
        $adminUser->load(['accounts', 'bills']);
        // Seed some predictable transactions first so reports look nice.
        $this->seedRecentTransactions($adminUser, 'Rent', rand(1000, 2000), true);
        $this->seedRecentTransactions($adminUser, 'Restaurants', 400);
        $this->seedRecentTransactions($adminUser, 'Groceries', 500);
        $this->seedRecentTransactions($adminUser, 'Fuel', 150);
        $this->seedRecentTransactions($adminUser, 'Cell Phone', 150);
        $this->seedRecentTransactions($adminUser, 'Entertainment', 500);
        $this->seedRecentTransactions($adminUser, 'Digital Services', 200);
        $this->seedRecentTransactions($adminUser, 'Pets', 300);

        if ($addNoise) {
            $adminUser
                ->categories()
                ->whereIn('label', ['Entertainment', 'Pets', 'Restaurants'])
                ->get()
                ->each(function (Category $category) use ($adminUser) {
                    $this->info('Seeding extra transactions into ' . $category->label . '...');

                    Transaction::factory()->count(10)->create([
                        'user_id' => $adminUser->id,
                        'account_id' => function () use ($adminUser) {
                            return $adminUser->accounts->random();
                        },
                        'category_id' => $category->id,
                        'bill_id' => function () use ($adminUser) {
                            return $adminUser->bills->random();
                        },
                    ]);
                });
        }
    }

    private function seedRecentTransactions(User $user, string $categoryLabel, int $amount, bool $static = false)
    {
        $category = Category::factory()->make([
            'label' => $categoryLabel,
            'budgeted' => $amount,
        ]);
        $user->categories()->save($category);

        $transactions = [];

        for ($i = 0; $i < 24; $i++) {
            $transactions[] = Transaction::factory()->make([
                'date' => Carbon::now()->startOfMonth()->subMonths($i)->format('Y-m-d H:i:s'),
                'user_id' => $user->id,
                'account_id' => $user->accounts->random(),
                'category_id' => $category->id,
                'bill_id' => $user->bills->random(),
                'amount' => function () use ($amount, $category, $static) {
                    return $static ? $category->budgeted : $this->weightedRand(1, $amount, 0.4);
                },
                'inflow' => 0,
            ])->toArray();
        }

        Transaction::insert($transactions);
    }

    private function weightedRand($min, $max, $gamma): int
    {
        $offset = $max - $min + 1;

        return floor($min + pow(lcg_value(), $gamma) * $offset);
    }
}
