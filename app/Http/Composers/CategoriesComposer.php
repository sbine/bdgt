<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoriesComposer
{
    protected $categoryRepository;

    /**
     * Create a new composer.
     *
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = $this->categoryRepository->all();

        $view->with(['categories' => $categories]);
    }
}
