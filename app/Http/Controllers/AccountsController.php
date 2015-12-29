<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Account;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller
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

    public function index() {
        return view('account/index',['accounts' => Account::where('user_id',Auth::user()->id)->get()]);
    }

    public function edit($id) {

        $account = Account::findOrFail($id);
        if($account->user_id === Auth::user()->id) {
            return view('account/edit',['account' => $account]);
        }

        return false;
    }

    public function store() {
        $account = Account::findOrFail(Input::get('id'));
        if($account->user_id === Auth::user()->id) {
            $account->title = Input::get('title');
            $account->startbalance = Input::get('startbalance');
            $account->save();
            return redirect('account')->with('status', 'Account updated!');

        }

        return false;
    }
}
