<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Bill;

use Input;

class BillController extends Controller
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
        $bills = Bill::all();

        $bills->sortBy(function ($bill) {
            return $bill->nextDue;
        });

        $c['bills'] = $bills;

        return view('bill/index', $c);
    }

    public function show($id)
    {
        try {
            $bill = Bill::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/bills');
        }

        $c['bill'] = $bill;

        return view('bill/show', $c);
    }

    public function store()
    {
        $bill = Input::all();

        if (Bill::create($bill)) {
            return response()->json(["status" => "success"]);
        }
        return response()->json(["status" => "error"]);
    }

    public function destroy($id)
    {
        if (Bill::where('id', '=', $id)->delete()) {
            return response()->json(["status" => "success"]);
        }
        return response()->json(["status" => "error"]);
    }
}
