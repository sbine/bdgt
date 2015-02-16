<?php namespace Bdgt\Http\Controllers;

use Bdgt\Resources\Category;

use Input;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();

        $categories->sortBy(function ($category) {
            return $category->nextDue;
        });

        $c['categories'] = $categories;

        return view('category/index', $c);
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/categories');
        }

        $c['category'] = $category;

        return view('category/show', $c);
    }

    public function store()
    {
        if ($category = Category::create(Input::all())) {
            session()->flash('alerts.success', 'Category created');
            return redirect("/categories/{$category->id}");
        } else {
            session()->flash('alerts.danger', 'Category creation failed');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if (Category::where('id', '=', $id)->delete()) {
            session()->flash('alerts.success', 'Category deleted');
            return redirect("/categories");
        } else {
            session()->flash('alerts.danger', 'Category deletion failed');
            return redirect()->back();
        }
    }
}
