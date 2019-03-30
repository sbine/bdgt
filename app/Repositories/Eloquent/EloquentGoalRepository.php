<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\GoalRepositoryInterface;
use App\Resources\Goal;

class EloquentGoalRepository extends EloquentRepository implements GoalRepositoryInterface
{
    public function __construct(Goal $goal)
    {
        parent::__construct($goal);
    }
}
