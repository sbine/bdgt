<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Show the index page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.index');
    }
}
