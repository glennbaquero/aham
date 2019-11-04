<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Carbon\Carbon;

use App\GlobalChecker;

use App\Category;
use App\ContactUs;
use App\Message;
use App\Invoice;
use App\Page;

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
                $logo = Page::where('slug', 'logo')->first()->getData()['item'];
                $view->with('contacts', ContactUs::all());
                $view->with('footerLogo', $logo);
            });

            View::composer('includes.header',  function($view) {
                $contact = ContactUs::first();
                $logo = Page::where('slug', 'logo')->first()->getData()['item'];
                $view->with('headerLogo', $logo);
                $view->with('contact', $contact);
            });

            View::composer('admin.includes.header',  function($view) {
                $view->with('messages', auth()->user()->notifications()->where(['type' => 'App\Notifications\ContactUsMessageNotification'])->latest()->get());
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
