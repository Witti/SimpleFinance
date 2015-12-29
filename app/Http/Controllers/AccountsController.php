<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Account;

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

        $account = Account::findOrFail(1);
        if($account->user_id === Auth::user()->id) {
            return view('account/edit',['account' => $account]);
        }

        return false;
    }
}
