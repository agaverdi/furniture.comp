<?php

namespace App\Providers;

use App\Http\Controllers\frontend\ProductController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    public const HOME = '/';
    public const ADMINHOME = '/admin';

    // protected $namespace = 'App\\Http\\Controllers';


    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            /*Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));*/

            Route::middleware('web')
                ->prefix('admin')
                ->namespace($this->namespace)
                ->name('backend.')
                ->group(base_path('routes/backend.php'));


            Route::middleware('web')
                ->namespace($this->namespace)
                ->name('frontend.')
                ->group(base_path('routes/frontend.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
