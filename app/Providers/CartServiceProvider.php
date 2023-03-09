<?php

namespace App\Providers;

use App\Cart\Cart;
use App\Cart\Contracts\CartInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CartInterface::class, function () {
            return new Cart(session());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
