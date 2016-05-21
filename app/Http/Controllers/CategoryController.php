<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Input;

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
        $c['categories'] = $this->repository->all(['label' => 'asc']);

        return view('category.index', $c);
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

        return view('category.show', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $category->transactions ]);
    }

    /**
     * Create and store a new category.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($category = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect("/categories/{$category->id}")->with('alerts.success', trans('crud.categories.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
        }
    }

    /**
     * Update an existing category with new data.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->repository->update(Input::except(['_token', '_method']), $id)) {
            return redirect("/categories/{$id}")->with('alerts.success', trans('crud.categories.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
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
            return redirect('/categories')->with('alerts.success', trans('crud.categories.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
        }
    }
}
