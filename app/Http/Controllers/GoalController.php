<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\GoalRepositoryInterface;
use Bdgt\Resources\Goal;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;

class GoalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param GoalRepositoryInterface $goalRepository
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
        $goals = $this->repository->all()->sortByDesc(function ($goal) {
            return $goal->progress;
        });

        return view('goal.index', compact('goals'));
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
        } catch (ModelNotFoundException $e) {
            return redirect(route('goals.index'));
        }

        return view('goal.show', compact('goal'));
    }

    /**
     * Create and store a new goal.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($goal = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect(route('goals.show', $goal->id))->with('alerts.success', trans('crud.goals.created'));
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
            return redirect(route('goals.show', $id))->with('alerts.success', trans('crud.goals.updated'));
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
            return redirect(route('goals.index'))->with('alerts.success', trans('crud.goals.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.goals.error'));
        }
    }
}
