<?php

namespace App\Providers;

use App\Http\Controllers\frontend\WishesController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class UserWishesServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('frontend.includes.header', function ($view) {
            $wishesController = new WishesController();
            $WishesData = $wishesController->getData();
            $CartData   = $wishesController->getData_2();
            $view->with($WishesData)->with($CartData);
        });
    }
}
