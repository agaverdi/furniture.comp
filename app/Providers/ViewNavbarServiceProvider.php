<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\frontend\NavbarController;
use Illuminate\Support\Facades\View;
class ViewNavbarServiceProvider extends ServiceProvider
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
        View::composer('frontend.components.nav', function ($view) {
            $navbarController = new NavbarController();
            $navbarData = $navbarController->getData();
            $view->with($navbarData);
        });

        View::composer('backend.includes.navbar',function ($view){
            $navbarController = new NavbarController();
            $navbarData = $navbarController->getPosition();
            $view->with($navbarData);
        });
    }
}
