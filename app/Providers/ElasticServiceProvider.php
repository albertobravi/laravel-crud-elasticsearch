<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Item;
use App\Observers\ItemObserver;

class ElasticServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Item::observe(ItemObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}