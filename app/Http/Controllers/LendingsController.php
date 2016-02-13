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
    public function index() {
        $lendings = Lending::whereHas('transaction.account', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->get();

        return view('lending.index', compact('lendings'));
    }

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

    public function show($lendingid) {
        $lending = Lending::findOrFail($lendingid);
        if($lending->transaction->account->id == Auth::user()->id) {
            return view('lending.edit', compact('lending'));
        }
        else {
            return redirect('home')->with('status', 'You are not allowed to view this lending.');
        }
    }

    public function close($lendingid) {
        $lending = Lending::findOrFail($lendingid);
        if($lending->transaction->account->id == Auth::user()->id) {
            $lending->paid = 1;
            $lending->save();
            return redirect('/lending')->with('status', 'Wohoo, good to hear that you got your money back! Lending closed.');
        }
        else {
            return redirect('home')->with('status', 'You are not allowed to edit this lending.');
        }
    }

    public function reopen($lendingid) {
        $lending = Lending::findOrFail($lendingid);
        if($lending->transaction->account->id == Auth::user()->id) {
            $lending->paid = 0;
            $lending->save();
            return redirect('/lending')->with('status', 'Bummer, lending reopen, hope the best.');
        }
        else {
            return redirect('home')->with('status', 'You are not allowed to edit this lending.');
        }
    }
}
