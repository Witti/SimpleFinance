<?php

namespace SimpleFinance\Http\Controllers;

use Illuminate\Http\Request;

use SimpleFinance\Http\Requests;
use SimpleFinance\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
