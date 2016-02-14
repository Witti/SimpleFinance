<?php

namespace SimpleFinance\Http\Controllers;

use SimpleFinance\Http\Requests;
use Illuminate\Http\Request;
use SimpleFinance\Account;
use Illuminate\Support\Facades\Auth;
use SimpleFinance\Transaction;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $categoryusage = DB::table('transactions')
            ->select('category_id', 'categories.title', 'categories.color', DB::raw('count(category_id) as total'))
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
            ->groupBy('category_id')
            ->where('accounts.user_id', '=', Auth::user()->id)
            ->get('total','category_id','categories.title','categories.color');

        $accounts = Account::where('user_id',Auth::user()->id)->with('transactions')->get();
        return view('home', compact('accounts','categoryusage'));
    }
}
