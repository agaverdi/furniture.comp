<?php

namespace App\Providers;

use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class FooterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.includes.footer', function ($view) {
            $footerController = new FooterController();
            $footerData = $footerController->getData();
            $view->with($footerData);
        });
    }
}
