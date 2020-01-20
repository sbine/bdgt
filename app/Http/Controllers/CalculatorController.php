<?php

namespace App\Http\Controllers;

class CalculatorController extends Controller
{
    /**
     * Show the debt calculator to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function debt()
    {
        return view('calculator.debt');
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
