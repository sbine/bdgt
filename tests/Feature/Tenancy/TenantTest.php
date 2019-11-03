<?php

namespace Tests\Unit\Tenancy;

use App\Models\User;
use App\Tenancy\Tenant;
use Tests\TestCase;

class TenantTest extends TestCase
{
    public function testItRetrievesTheUsersId()
    {
        $user = new User();
        $user->id = 31;

        $this->assertEquals(31, (new Tenant($user))->id());
    }
}
