<?php

namespace App\Http\Composers;

use App\Models\Account;
use Illuminate\Contracts\View\View;

class AccountsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('accounts', Account::all());
    }
}
