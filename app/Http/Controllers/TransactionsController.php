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
use SimpleFinance\RepatedTransaction;

class TransactionsController extends Controller
{
     /**
     * creationform for transactions bind to an specific account
     *
     * @param $account_id
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($account_id) {
        $account = Account::findOrFail($account_id);
        $accounts = Account::where('user_id',Auth::user()->id)->get()->pluck('title','id');
        $categories = Category::where('user_id',Auth::user()->id)->get()->pluck('title','id');

        if($account->user_id === Auth::user()->id) {
            if($categories) {
                return view('transaction/create', compact('account','accounts', 'categories'));
            }
            else {
                return redirect('/category/create')->with('status', 'Please create a Category before you create a transaction.');
            }
        }

        return false;
    }

    public function store() {
        $account = Account::findOrFail(Input::get('accountid'));
        if($account->user_id === Auth::user()->id) {
            $transaction = New Transaction();
            $transaction->account_id = $account->id;
            $transaction->category_id = Input::get('category_id');
            $transaction->label = Input::get('label');
            $transaction->type = Input::get('type');
            $transaction->transactiondate = date('Y-m-d',strtotime(Input::get('transactiondate')));
            $transaction->amount = Input::get('amount');
            $transaction->save();

            if(Input::get('transfer') && Input::get('transfer_account_id')) {
                $transferAccount = Account::findOrFail(Input::get('transfer_account_id'));
                if($transferAccount->user_id === Auth::user()->id) {
                    if (Input::get('type') == 'expense') {
                        $transferTransactionType = 'income';
                    } else {
                        $transferTransactionType = 'expense';
                    }

                    $transferTransaction = New Transaction();
                    $transferTransaction->account_id = Input::get('transfer_account_id');
                    $transferTransaction->category_id = Input::get('category_id');
                    $transferTransaction->label = Input::get('label');
                    $transferTransaction->type = $transferTransactionType;
                    $transferTransaction->transactiondate = date('Y-m-d', strtotime(Input::get('transactiondate')));
                    $transferTransaction->amount = Input::get('amount');
                    $transferTransaction->transfer_id = $transaction->id;
                    $transferTransaction->save();

                    $transaction->transfer_id = $transferTransaction->id;
                    $transaction->save();
                }
                else {
                    return redirect('home')->with('status', 'You are not allowed to add an transaction to this account.');
                }
            }

            if(Input::get('lending')) {
                return redirect('/lending/create/transaction/' . $transaction->id)->with('status','Transaction created, now you can create the lending.');
            }

            return redirect('/transaction/account/' . $account->id)->with('status', 'Transaction created');
        } else {
            return redirect('home')->with('status', 'You are not allowed to add an transaction to this account.');
        }
    }

    public function accountlist($accountid) {
        $account = Account::findOrFail($accountid);
        if($account->user_id === Auth::user()->id) {
            $transactions = Transaction::where('account_id',$accountid)->orderBy('transactiondate','DESC')->get();
            $currentbalance = (float)$account->startbalance + Transaction::where('account_id',$accountid)->sum('amount');
            return view('transaction/list',compact('account','transactions','currentbalance'));
        } else {
            return redirect('home')->with('status', 'You are not allowed to view transactions of this account.');
        }
    }

    public function delete($id) {
        $transaction = Transaction::findOrFail($id);

        if($transaction->account->user_id === Auth::user()->id) {
            if($transaction->transfer_id) {
                $transferTransaction = Transaction::findOrFail($transaction->transfer_id);
                $transferTransaction->delete();
            }
            $transaction->delete();
            return redirect('/transaction/account/' . $transaction->account->id)->with('status', 'Transaction deleted');
        }

        return false;
    }

    public function edit($id) {
        $transaction = Transaction::findOrFail($id);
        $accounts = Account::where('user_id',Auth::user()->id)->get()->pluck('title','id');
        $categories = Category::where('user_id',Auth::user()->id)->get()->pluck('title','id');

        if($transaction->account->user_id === Auth::user()->id) {
            return view('transaction/edit',compact('transaction','accounts','categories'));
        }

        return false;
    }

    public function update($id) {
        $transaction = Transaction::findOrFail($id);

        if($transaction->account->user_id === Auth::user()->id) {
            $transaction->category_id = Input::get('category_id');
            $transaction->transactiondate = date('Y-m-d',strtotime(Input::get('transactiondate')));
            $transaction->label = Input::get('label');
            $transaction->type = Input::get('type');
            $transaction->amount = Input::get('amount');

            if(Input::get('transfer') && Input::get('transfer_account_id')) {
                $transferAccount = Account::findOrFail(Input::get('transfer_account_id'));
                if($transferAccount->user_id === Auth::user()->id) {

                    if (Input::get('type') == 'expense') {
                        $transferTransactionType = 'income';
                    } else {
                        $transferTransactionType = 'expense';
                    }

                    $transferTransaction = Transaction::findOrNew($transaction->transfer_id);
                    $transferTransaction->account_id = Input::get('transfer_account_id');
                    $transferTransaction->category_id = Input::get('category_id');
                    $transferTransaction->label = Input::get('label');
                    $transferTransaction->type = $transferTransactionType;
                    $transferTransaction->transactiondate = date('Y-m-d', strtotime(Input::get('transactiondate')));
                    $transferTransaction->amount = Input::get('amount');
                    $transferTransaction->transfer_id = $transaction->id;
                    $transferTransaction->save();

                    $transaction->transfer_id = $transferTransaction->id;
                    $transaction->save();
                }
                else {
                    return redirect('home')->with('status', 'You are not allowed to add an transaction to this account.');
                }
            }
            else {
                $transaction->transfer_id = NULL;
            }

            $transaction->save();

            return redirect('/transaction/account/' . $transaction->account->id)->with('status', 'Transaction updated');
        }

        return false;
    }

    /**
     * show form for duplication process
     *
     * @param $id
     * @return \Illuminate\View\View|bool
     */
    public function duplicate($id) {
        $transaction = Transaction::findOrFail($id);
        $accounts = Account::where('user_id',Auth::user()->id)->get()->pluck('title','id');
        $categories = Category::where('user_id',Auth::user()->id)->get()->pluck('title','id');

        if($transaction->account->user_id === Auth::user()->id) {
            return view('transaction/duplicate',compact('transaction','accounts','categories'));
        }

        return false;
    }

    /**
     * show form for creating a repeated transaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createRepeated() {
        $accounts = Auth::user()->accounts()->get()->pluck('title','id');
        $categories = Auth::user()->categories()->get()->pluck('title','id');
        return view('transaction/repeated/create',compact('accounts','categories'));
    }

    /*
     * store repeated transaction
     * 
     */
    public function storeRepeated() {
        //Validate input
        $account = Account::where('id',Input::get('accountid'))->where('user_id',Auth::id())->firstOrFail();
        $category = Category::where('id',Input::get('category_id'))->where('user_id',Auth::id())->firstOrFail();
        $transferaccount = false;
        $transfer = false;

        if(Input::get('transfer')) {
            $transferaccount = Account::where('id',Input::get('transfer_account_id'))->where('user_id',Auth::id())->firstOrFail();
            $transfer = true;
        }

        $rtransaction = New RepatedTransaction();
        $rtransaction->user_id = Auth::id();
        $rtransaction->category_id = $category->id;
        $rtransaction->account_id = $account->id;
        $rtransaction->type = Input::get('type');
        $rtransaction->amount = Input::get('amount');
        $rtransaction->label = Input::get('label');
        $rtransaction->startdate = date('Y-m-d', strtotime(Input::get('startdate')));
        $rtransaction->rmode = Input::get('rmode');
        $rtransaction->transfer = $transfer;
        if($transfer) {
            $rtransaction->transfer_account_id = $transferaccount->id;
        }
        $rtransaction->save();

        return redirect('/transaction/repeated/')->with('status', 'Transaction created');
    }

    public function indexRepeated() {
        $transactions = RepatedTransaction::where('user_id',Auth::id())->get();
        return view('transaction/repeated/index',compact('transactions'));
    }

    public function editRepeated($id) {
        $transaction = RepatedTransaction::where('user_id',Auth::id())->where('id',$id)->firstOrFail();
        $accounts = Auth::user()->accounts()->get()->pluck('title','id');
        $categories = Auth::user()->categories()->get()->pluck('title','id');
        return view('transaction/repeated/edit',compact('transaction','accounts','categories'));
    }

    public function updateRepeated($id) {
        $rtransaction = RepatedTransaction::where('user_id',Auth::id())->where('id',$id)->firstOrFail();
        $account = Account::where('user_id',Auth::id())->where('id',Input::get('accountid'))->firstOrFail();
        $category = Category::where('user_id',Auth::id())->where('id',Input::get('category_id'))->firstOrFail();

        $transferaccount = false;
        $transfer = false;

        if(Input::get('transfer')) {
            $transferaccount = Account::where('id',Input::get('transfer_account_id'))->where('user_id',Auth::id())->firstOrFail();
            $transfer = true;
        }

        $rtransaction->user_id = Auth::id();
        $rtransaction->category_id = $category->id;
        $rtransaction->account_id = $account->id;
        $rtransaction->type = Input::get('type');
        $rtransaction->amount = Input::get('amount');
        $rtransaction->label = Input::get('label');
        $rtransaction->startdate = date('Y-m-d', strtotime(Input::get('startdate')));
        $rtransaction->rmode = Input::get('rmode');
        $rtransaction->transfer = $transfer;
        if($transfer) {
            $rtransaction->transfer_account_id = $transferaccount->id;
        }
        $rtransaction->save();

        return redirect('/transaction/repeated/')->with('status', 'Transaction updated');
    }

    public function deleteRepeated($id) {
        $rtransaction = RepatedTransaction::where('user_id',Auth::id())->where('id',$id)->firstOrFail();
        $rtransaction->delete();
        return redirect('/transaction/repeated/')->with('status', 'Transaction deleted');
    }
}
