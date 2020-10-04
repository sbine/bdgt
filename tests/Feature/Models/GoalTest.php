<?php

namespace Tests\Feature\Models;

use App\Models\Goal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @group goal */
class GoalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function goal_get_achieved_attribute_false()
    {
        $goal = Goal::factory()->make([
            'balance' => 0.5,
            'amount' => 1,
        ]);

        $this->assertFalse($goal->getAchievedAttribute());
    }

    /** @test */
    public function goal_get_achieved_attribute_true()
    {
        $goal = Goal::factory()->make([
            'balance' => 1,
            'amount' => 1,
        ]);

        $this->assertTrue($goal->getAchievedAttribute());
    }

    /** @test */
    public function goal_get_achieved_attribute_true_overbalance()
    {
        $goal = Goal::factory()->make([
            'balance' => 3,
            'amount' => 1,
        ]);

        $this->assertTrue($goal->getAchievedAttribute());
    }

    /** @test */
    public function goal_get_progress_attribute_300()
    {
        $goal = Goal::factory()->make([
            'balance' => 3,
            'amount' => 1,
        ]);

        $this->assertIsString($goal->getProgressAttribute());
        $this->assertEquals(100, $goal->getProgressAttribute());
    }

    /** @test */
    public function goal_get_progress_attribute_100()
    {
        $goal = Goal::factory()->make([
            'balance' => 1,
            'amount' => 1,
        ]);

        $this->assertIsString($goal->getProgressAttribute());
        $this->assertEquals(100, $goal->getProgressAttribute());
    }

    /** @test */
    public function goal_get_progress_attribute_0()
    {
        $goal = Goal::factory()->make([
            'balance' => 0,
            'amount' => 1,
        ]);

        $this->assertIsString($goal->getProgressAttribute());
        $this->assertEquals(0, $goal->getProgressAttribute());
    }
}
