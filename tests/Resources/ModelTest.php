<?php

namespace Bdgt\Tests\Resources;

use Bdgt\Tests\TestCase;
use Bdgt\Resources\Transaction;
use Bdgt\Scopes\TenancyScope;

class ModelTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = $this->mock('Bdgt\Resources\Model[save,update,create,delete,destroy]');
    }

    public function testTenancyScopeIsApplied()
    {
        // Assert that we are applying the TenancyScope in Model::boot
        $this->assertTrue($this->model->hasGlobalScope(TenancyScope::class));
    }

    public function testNullablesCanBeSetToNull()
    {
        $transaction = new Transaction;
        $transaction->payee = '';
        $transaction->bill_id = '';
        $transaction->category_id = '';

        $this->runReflectedMethod($this->model, 'setNullables', [$transaction]);

        // payee is not nullable
        $this->assertEquals('', $transaction->payee);
        // bill_id and category_id are both nullable
        $this->assertNull($transaction->bill_id);
        $this->assertNull($transaction->category_id);
    }
}
