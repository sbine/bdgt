<?php

namespace Tests\Feature\Models;

use App\Models\Model;
use Sbine\Tenancy\TenancyScope;
use Tests\TestCase;

class ModelTest extends TestCase
{
    public function test_tenancy_scope_is_applied()
    {
        // Assert that we are applying the TenancyScope in Model::boot
        $this->assertTrue((new Model)->hasGlobalScope(TenancyScope::class));
    }
}
