<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Artisan;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Artisan::call('scout:flush "App\\\\Models\\\\Product"');
        Artisan::call('scout:import "App\\\\Models\\\\Product"');
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Artisan::call('scout:flush "App\\\\Models\\\\Product"');
        Artisan::call('scout:import "App\\\\Models\\\\Product"');
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Artisan::call('scout:flush "App\\\\Models\\\\Product"');
        Artisan::call('scout:import "App\\\\Models\\\\Product"');
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        Artisan::call('scout:flush "App\\\\Models\\\\Product"');
        Artisan::call('scout:import "App\\\\Models\\\\Product"');
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        Artisan::call('scout:flush "App\\\\Models\\\\Product"');
        Artisan::call('scout:import "App\\\\Models\\\\Product"');
    }
}
