<?php

namespace SimpleFinance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use SimpleFinance\Http\Requests;
use SimpleFinance\Http\Controllers\Controller;
use SimpleFinance\Lending;
use SimpleFinance\Person;
use SimpleFinance\Transaction;

class LendingsController extends Controller
{
    public function createFromTransaction($transactionid) {
        $transaction = Transaction::findOrFail($transactionid);
        if($transaction->account->id == Auth::user()->id) {
            return view('lending.create',compact('transaction'));
        }
        else {
            return redirect('home')->with('status', 'You are not allowed to add a lending to this transaction.');
        }
    }

    public function store($transactionid) {
        $transaction = Transaction::findOrFail($transactionid);
        if($transaction->account->id == Auth::user()->id) {
            $person = New Person();
            $person->firstname = Input::get('firstname');
            $person->lastname = Input::get('lastname');
            $person->email = Input::get('email');
            $person->phone = Input::get('phone');
            $person->save();

            $lending = New Lending();
            $lending->person_id = $person->id;
            $lending->paid = 0;
            $lending->deadline = date('Y-m-d',strtotime(Input::get('deadline')));
            $lending->save();

            $transaction->lending_id = $lending->id;
            $transaction->save();

            return redirect('/transaction/account/' . $transaction->account->id)->with('status', 'Transaction and lending created.');
        }
        else {
            return redirect('home')->with('status', 'You are not allowed to add a lending to this transaction.');
        }
    }
}
