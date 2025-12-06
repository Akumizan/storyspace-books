<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\AdminMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register middleware alias
        $router = $this->app['router'];
        $router->aliasMiddleware('admin', AdminMiddleware::class);
    }
}