<?php

namespace App\Http\Controllers;

use App\Resources\Goal;
use Illuminate\Support\Facades\Input;

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
    public function show($goal)
    {
        return view('goal.show', compact('goal'));
    }

    /**
     * Create and store a new goal.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($goal = Goal::create(Input::all())) {
            return redirect(route('goals.show', $goal->id))->with('alerts.success', trans('crud.goals.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }

    /**
     * Update an existing goal with new data.
     *
     * @param  Goal $goal
     *
     * @return Redirect
     */
    public function update($goal)
    {
        if ($goal->update(Input::all())) {
            return redirect(route('goals.show', $goal->id))->with('alerts.success', trans('crud.goals.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }

    /**
     * Delete a goal.
     *
     * @param  Goal $goal
     *
     * @return Redirect
     */
    public function destroy($goal)
    {
        if ($goal->delete()) {
            return redirect(route('goals.index'))->with('alerts.success', trans('crud.goals.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }
}
