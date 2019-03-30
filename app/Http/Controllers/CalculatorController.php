<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function debt()
    {
        return view('calculator/debt');
    }

    /**
     * Show the savings calculator to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function savings()
    {
        return view('errors.coming_soon');
    }
}
