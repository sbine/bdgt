<?php

namespace Bdgt\Tests\Resources;

use Bdgt\Tenancy\TenancyScope;
use Bdgt\Tests\TestCase;
use Bdgt\Resources\Model;

class ModelTest extends TestCase
{
    public function testTenancyScopeIsApplied()
    {
        // Assert that we are applying the TenancyScope in Model::boot
        $this->assertTrue((new Model)->hasGlobalScope(TenancyScope::class));
    }
}
