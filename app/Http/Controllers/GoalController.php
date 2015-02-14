<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Goal;

use Input;

class GoalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $goals = Goal::all();

        $goals->sortByDesc(function ($goal) {
            return $goal->progress;
        });

        $c['goals'] = $goals;

        return view('goal/index', $c);
    }

    public function show($id)
    {
        try {
            $goal = Goal::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/goals');
        }

        $c['goal'] = $goal;

        return view('goal/show', $c);
    }

    public function store()
    {
        if ($goal = Goal::create(Input::all())) {
            session()->flash('alerts.success', 'Goal created');
            return redirect("/goals/{$goal->id}");
        } else {
            session()->flash('alerts.danger', 'Goal creation failed');
            return redirect()->back();
        }
    }

    public function update($id)
    {
        if (Goal::where('id', '=', $id)->update(Input::except(['_token', '_method']))) {
            session()->flash('alerts.success', 'Goal updated');
            return redirect("/goals/{$id}");
        } else {
            session()->flash('alerts.danger', 'Goal update failed');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if (Goal::where('id', '=', $id)->delete()) {
            session()->flash('alerts.success', 'Goal deleted');
            return redirect("/goals");
        } else {
            session()->flash('alerts.danger', 'Goal deletion failed');
            return redirect()->back();
        }
    }
}
