<?php namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\CategoryRepositoryInterface;

use Input;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->repository->all();

        $categories->sortBy(function ($category) {
            return $category->nextDue;
        });

        $c['categories'] = $categories;

        return view('category/index', $c);
    }

    /**
     * Show an individual category to the user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $category = $this->repository->find($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/categories');
        }

        $c['category'] = $category;

        return view('category/show', $c);
    }

    /**
     * Create and store a new category.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($category = $this->repository->create(Input::all())) {
            session()->flash('alerts.success', 'Category created');
            return redirect("/categories/{$category->id}");
        } else {
            session()->flash('alerts.danger', 'Category creation failed');
            return redirect()->back();
        }
    }

    /**
     * Delete a category by ID.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            session()->flash('alerts.success', 'Category deleted');
            return redirect("/categories");
        } else {
            session()->flash('alerts.danger', 'Category deletion failed');
            return redirect()->back();
        }
    }
}
