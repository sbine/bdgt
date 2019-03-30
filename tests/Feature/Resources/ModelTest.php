<?php

namespace Tests\Feature\Resources;

use App\Tenancy\TenancyScope;
use Tests\TestCase;
use App\Resources\Model;

class ModelTest extends TestCase
{
    public function testTenancyScopeIsApplied()
    {
        // Assert that we are applying the TenancyScope in Model::boot
        $this->assertTrue((new Model)->hasGlobalScope(TenancyScope::class));
    }
}
