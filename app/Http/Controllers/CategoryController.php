<?php

namespace App\Http\Controllers;

use App\Resources\Category;
use Illuminate\Support\Facades\Input;

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
        if ($category = Category::create(Input::all())) {
            return redirect(route('categories.show', $category->id))->with('alerts.success', trans('crud.categories.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
        }
    }

    /**
     * Update an existing category with new data.
     *
     * @param  Category $category
     *
     * @return Redirect
     */
    public function update($category)
    {
        if ($category->update(Input::all())) {
            return redirect(route('categories.show', $category->id))->with('alerts.success', trans('crud.categories.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
        }
    }

    /**
     * Delete a category.
     *
     * @param  Category $category
     *
     * @return Redirect
     */
    public function destroy($category)
    {
        if ($category->delete()) {
            return redirect(route('categories.index'))->with('alerts.success', trans('crud.categories.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.categories.error'));
        }
    }
}
