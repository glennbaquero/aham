<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Carbon\Carbon;

use App\GlobalChecker;

use App\Category;
use App\ContactUs;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $view->with('carbon', new Carbon);

            $words = explode(' ', config('app.name'));
            $acronym = "";

            foreach ($words as $w) {
              $acronym .= $w[0];
            }

            $view->with('headerAcronym', $acronym);

            /* Add in the public vars */
            View::share('checker', new GlobalChecker);

            View::composer('includes.footer',  function($view) {
                $view->with('contacts', ContactUs::all());
            });

            $categories = Category::select(Category::MINIMAL_COLUMN)->get();

            $view->with('headerCategories', $categories);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
