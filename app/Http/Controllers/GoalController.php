<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\GoalRepositoryInterface;
use Bdgt\Resources\Goal;
use Input;

class GoalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GoalRepositoryInterface $goalRepository)
    {
        $this->repository = $goalRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $goals = $this->repository->all();

        $goals->sortByDesc(function ($goal) {
            return $goal->progress;
        });

        $c['goals'] = $goals;

        return view('goal.index', $c);
    }

    /**
     * Show an individual goal to the user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $goal = $this->repository->find($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/goals');
        }

        $c['goal'] = $goal;

        return view('goal.show', $c);
    }

    /**
     * Create and store a new goal.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($goal = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect("/goals/{$goal->id}")->with('alerts.success', trans('crud.goals.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }

    /**
     * Update an existing goal with new data.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->repository->update(Input::except(['_token', '_method']), $id)) {
            return redirect("/goals/{$id}")->with('alerts.success', trans('crud.goals.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }

    /**
     * Delete a goal by ID.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            return redirect("/goals")->with('alerts.success', trans('crud.goals.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }
}
