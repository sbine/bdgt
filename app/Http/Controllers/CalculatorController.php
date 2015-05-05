<?php namespace Bdgt\Http\Controllers;

class CalculatorController extends Controller
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
     * Show the debt calculator to the user.
     *
     * @return Response
     */
    public function debt()
    {
        return view('calculator/debt');
    }
}
