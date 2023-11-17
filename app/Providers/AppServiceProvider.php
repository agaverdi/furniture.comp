<?php

namespace App\Providers;

use App\Models\Pages;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {
            $slug = request()->segment(1);
            $pages = Pages::whereSlug($slug)->first();
            $view->with('pages', $pages);
        });
    }
}
