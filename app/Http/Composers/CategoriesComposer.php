<?php

namespace App\Http\Composers;

use App\Resources\Category;
use Illuminate\Contracts\View\View;

class CategoriesComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['categories' => Category::all()]);
    }
}
