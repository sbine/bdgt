<?php

namespace Tests\Unit\Tenancy;

use App\Models\User;
use App\Tenancy\Tenant;
use Tests\TestCase;

class TenantTest extends TestCase
{
    public function testItRetrievesTheUsersId()
    {
        $user = $this->mock(User::class, function () { return User::class; });

        $user->shouldReceive('getAttribute')->once()->with('id')
            ->andReturn(31);

        $this->assertEquals(31, (new Tenant($user))->id());
    }
}
