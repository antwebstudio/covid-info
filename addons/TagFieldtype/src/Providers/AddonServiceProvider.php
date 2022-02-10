<?php

namespace Addons\TagFieldtype\Providers;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    /**
     * Register any addon services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any addon services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Fusion::asset('/addons/TagFieldtype/js/app.js');
        fieldtypes()->register(\Addons\TagFieldtype\Fieldtypes\TagFieldtype::class);
    }
}