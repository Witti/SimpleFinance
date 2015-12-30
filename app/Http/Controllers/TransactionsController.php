<?php

namespace SimpleFinance\Http\Controllers;

use Illuminate\Http\Request;

use SimpleFinance\Http\Requests;
use SimpleFinance\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use SimpleFinance\Transaction;
use SimpleFinance\Account;
use SimpleFinance\Category;

class TransactionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * creationform for transactions bind to an specific account
     *
     * @param $account_id
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($account_id) {
        $account = Account::findOrFail($account_id);
        $categories = Category::where('user_id',Auth::user()->id)->get()->lists('title','id');

        if($account->user_id === Auth::user()->id) {
            return view('transaction/create', compact('account','categories'));
        }

        return false;
    }
}
