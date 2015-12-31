<?php

namespace SimpleFinance\Http\Controllers;

use Illuminate\Http\Request;

use SimpleFinance\Http\Requests;
use SimpleFinance\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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

    public function store() {
        $account = Account::findOrFail(Input::get('accountid'));
        if($account->user_id === Auth::user()->id) {
            $transaction = New Transaction();
            $transaction->account_id = $account->id;
            $transaction->amount = Input::get('amount');
            $transaction->category_id = Input::get('category_id');
            $transaction->label = Input::get('label');
            $transaction->type = Input::get('type');
            $transaction->save();
            return redirect('home')->with('status', 'Transaction created');

        } else {
            return redirect('home')->with('status', 'You are not allowed to add an transaction to this account.');
        }
    }

    public function accountlist($accountid) {
        $account = Account::findOrFail($accountid);
        if($account->user_id === Auth::user()->id) {
            return Transaction::where('account_id',$accountid)->get()->toArray();
        } else {
            return redirect('home')->with('status', 'You are not allowed to view transactions of this account.');
        }
    }
}
