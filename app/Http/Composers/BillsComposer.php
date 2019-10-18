<?php

namespace App\Http\Composers;

use App\Resources\Bill;
use Illuminate\Contracts\View\View;

class BillsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('bills', Bill::all());
    }
}
