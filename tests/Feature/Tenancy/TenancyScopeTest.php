<?php

namespace Tests\Feature\Scopes;

use App\Resources\User;
use App\Tenancy\TenancyScope;
use Tests\TestCase;
use DomainException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenancyScopeTest extends TestCase
{
    public function testApplyAddsWhereConditionToBuilder()
    {
        $builder = $this->mock(Builder::class);
        $model = $this->mock(Model::class);

        $user = new User();
        $user->id = 50;

        Auth::shouldReceive('check')->once()->andReturn(true);
        Auth::shouldReceive('user')->once()->andReturn($user);

        $model->shouldReceive('getTable')->once()->andReturn('table');
        $builder->shouldReceive('where')->once()->with('table.user_id', '=', 50);

        (new TenancyScope)->apply($builder, $model);
    }

    public function testApplyWithoutAuthenticatedUserThrowsException()
    {
        $builder = $this->mock(Builder::class);
        $model = $this->mock(Model::class);

        Auth::shouldReceive('check')->once()->andReturn(false);

        $model->shouldReceive('getTable')->once()->andReturn('table');

        $this->expectException(DomainException::class);

        (new TenancyScope)->apply($builder, $model);
    }
}
