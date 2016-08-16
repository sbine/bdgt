<?php

namespace Bdgt\Http\Controllers;

class PageController extends Controller
{
    /**
     * Show the index page to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('page.index');
    }
}
