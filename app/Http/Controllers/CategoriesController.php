<?php

namespace SimpleFinance\Http\Controllers;

use Illuminate\Http\Request;

use SimpleFinance\Http\Requests;
use SimpleFinance\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use SimpleFinance\Category;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $categories = Category::where('user_id',Auth::user()->id)->get();
        return view('category/index', compact('categories'));
    }

    public function create() {
        return view('category/create');
    }

    public function store() {
        Category::create(Input::except(['_token']));
        return redirect('category')->with('status', 'Category created');
    }

    public function update($id) {
        $c = Category::findOrFail($id);
        if($c->user_id === Auth::user()->id) {
            $c->title = Input::get('title');
            $c->color = Input::get('color');
            $c->save();
            return redirect('category')->with('status', 'Category updated');
        }
        return false;
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        if($category->user_id === Auth::user()->id) {
            return view('category/edit',compact('category'));
        }
        return false;
    }
}
