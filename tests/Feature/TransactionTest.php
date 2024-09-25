<?php

namespace Tests\Feature;

use App\Exports\TransactionsExport;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

/** @group transaction */
class TransactionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Transaction::flushEventListeners();
        Account::flushEventListeners();
    }

    public function test_store_persists_new_transaction_and_redirects()
    {
        $transaction = Transaction::factory()->forAccount()->make();

        $this->actingAs(User::factory()->create())
            ->post(route('transactions.store', $transaction->toArray()))
            ->assertStatus(302);

        $this->assertDatabaseHas('transactions', $transaction->getAttributes());
    }

    public function test_user_can_download_transactions_export()
    {
        Excel::fake();

        $this->actingAs(User::factory()->create())
            ->get(route('transactions.export'));

        Excel::assertDownloaded('bdgt-transactions.csv', function (TransactionsExport $export) {
            // Assert that the correct export is downloaded.
            return true;
        });
    }
}
