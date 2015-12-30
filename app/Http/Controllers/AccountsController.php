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
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * load account index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('account/index',['accounts' => Account::where('user_id',Auth::user()->id)->get()]);
    }

    /**
     * load account data and edit-form
     *
     * @param $id
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {

        $account = Account::findOrFail($id);
        if($account->user_id === Auth::user()->id) {
            return view('account/edit',['account' => $account]);
        }

        return false;
    }

    /**
     * update account data
     *
     * @return bool|mixed
     */
    public function update() {
        $account = Account::findOrFail(Input::get('id'));
        if($account->user_id === Auth::user()->id) {
            $account->title = Input::get('title');
            $account->startbalance = Input::get('startbalance');
            $account->save();
            return redirect('account')->with('status', 'Account updated!');
        }

        return false;
    }

    /**
     * store new account
     *
     * @return mixed
     */
    public function store() {
        $account = New Account();
        $account->title = Input::get('title');
        $account->startbalance = Input::get('startbalance');
        $account->user_id = Auth::user()->id;
        $account->save();

        return redirect('account')->with('status', 'Account created!');
    }

    /**
     * show creation form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('account/create');
    }
}
