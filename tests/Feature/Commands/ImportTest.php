<?php

namespace Tests\Feature\Commands;

use App\Models\Account;
use Tests\TestCase;

/** @group import */
class ImportTest extends TestCase
{
    /** @test */
    public function can_import_ofx_file_to_existing_account()
    {
        $account = Account::factory()->forUser()->create(['name' => 'CHECKING']);
        $path = base_path('tests/assets/sample.ofx');

        $this->artisan('import', [
            'user' => $account->user->id,
            'path' => $path,
        ])->expectsConfirmation(sprintf('Import %s for user %s?', $path, $account->user->email), 'yes');

        $this->assertDatabaseHas('transactions', [
            'date' => '2009-02-09 00:00:00',
            'payee' => 'GROCER A & Z',
            'amount' => 98.91,
            'inflow' => false,
            'account_id' => $account->id,
        ]);

        $this->assertDatabaseHas('transactions', [
            'date' => '2009-02-09 00:00:00',
            'payee' => 'DEPOSIT    00000000',
            'amount' => 308.86,
            'inflow' => true,
            'account_id' => $account->id,
        ]);
    }
}
