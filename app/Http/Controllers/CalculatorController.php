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

    public function debt()
    {
        return view('calculator/debt');
    }
}
