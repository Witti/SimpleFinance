<?php

namespace SimpleFinance\Providers;

use SimpleFinance\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class OwnerInjectionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::saving(function($category) {
            if (Auth::user()->id) {
                $category->user_id = Auth::user()->id;
                return true;
            }
            return false;
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
