<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Account;
use Illuminate\Support\Facades\Auth;

class MenuComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function($view) {
            if(!Auth::guest()) {
                $accounts = Account::where('user_id', Auth::user()->id)->get();
            }
            else {
                $accounts = false;
            }
            $view->with('accounts', $accounts);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
