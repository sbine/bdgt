<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index')->with('categories', Category::all());
    }

    /**
     * Show an individual category to the user.
     *
     * @param  Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show')->with('category', $category);
    }

    /**
     * Create and store a new category.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($category = Category::create(Request::all())) {
            return redirect(route('categories.show', $category->id))->with('alerts.success', trans('crud.categories.created'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
    }

    /**
     * Update an existing category with new data.
     *
     * @param  Category $category
     *
     * @return Redirect
     */
    public function update(Category $category)
    {
        if ($category->update(Request::all())) {
            return redirect(route('categories.show', $category->id))->with('alerts.success', trans('crud.categories.updated'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
    }

    /**
     * Delete a category.
     *
     * @param  Category $category
     *
     * @return Redirect
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect(route('categories.index'))->with('alerts.success', trans('crud.categories.deleted'));
        }

        return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
    }
}
