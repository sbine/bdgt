<?php

namespace Bdgt\Tests\Resources;

use Bdgt\Scopes\TenancyScope;
use Bdgt\Tests\TestCase;
use Bdgt\Resources\Model;
use Bdgt\Resources\Transaction;

class ModelTest extends TestCase
{
    public function testTenancyScopeIsApplied()
    {
        // Assert that we are applying the TenancyScope in Model::boot
        $this->assertTrue((new Model)->hasGlobalScope(TenancyScope::class));
    }

    public function testNullablesCanBeSetToNull()
    {
        $transaction = new Transaction;
        $transaction->payee = '';
        $transaction->bill_id = '';
        $transaction->category_id = '';

        $this->runReflectedMethod(new Model, 'setNullables', [$transaction]);

        // payee is not nullable
        $this->assertEquals('', $transaction->payee);
        // bill_id and category_id are both nullable
        $this->assertNull($transaction->bill_id);
        $this->assertNull($transaction->category_id);
    }
}
