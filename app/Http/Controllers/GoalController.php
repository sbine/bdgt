<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Support\Facades\Request;

class GoalController extends Controller
{
    public function index()
    {
        return view('goal.index')->with(
            'goals',
            Goal::all()->sortByDesc(function ($goal) {
                return $goal->progress;
            })
        );
    }

    /**
     * Show an individual goal to the user.
     *
     * @param  Goal $goal
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        return view('goal.show')->with('goal', $goal);
    }

    /**
     * Create and store a new goal.
     *
     * @return Redirect
     */
    public function store()
    {
        request()->validate([
            'label' => 'required',
            'start_date' => 'required|date',
            'balance' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        if ($goal = Goal::create(Request::all())) {
            return redirect(route('goals.show', $goal->id))->with('alerts.success', trans('crud.goals.created'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
    }

    /**
     * Update an existing goal with new data.
     *
     * @param  Goal $goal
     *
     * @return Redirect
     */
    public function update(Goal $goal)
    {
        if ($goal->update(Request::all())) {
            return redirect(route('goals.show', $goal->id))->with('alerts.success', trans('crud.goals.updated'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
    }

    /**
     * Delete a goal.
     *
     * @param  Goal $goal
     *
     * @return Redirect
     */
    public function destroy(Goal $goal)
    {
        if ($goal->delete()) {
            return redirect(route('goals.index'))->with('alerts.success', trans('crud.goals.deleted'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
    }
}
