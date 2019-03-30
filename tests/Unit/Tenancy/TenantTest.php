<?php

namespace Tests\Unit\Tenancy;

use App\Resources\User;
use App\Tenancy\Tenant;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class TenantTest extends TestCase
{
    public function testItRetrievesTheUsersId()
    {
        $user = $this->mock(Model::class, User::class);

        $user->shouldReceive('getAttribute')->once()->with('id')
            ->andReturn(31);

        $this->assertEquals(31, (new Tenant($user))->id());
    }
}
