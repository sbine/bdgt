<?php

namespace Bdgt\Repositories\Eloquent;

use Bdgt\Repositories\Contracts\GoalRepositoryInterface;
use Bdgt\Resources\Goal;

class EloquentGoalRepository extends EloquentRepository implements GoalRepositoryInterface
{
    public function __construct(Goal $goal)
    {
        parent::__construct($goal);
    }
}
