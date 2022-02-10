<?php

namespace Addons\TinyMceFieldtype\Providers;

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
    }

    /**
     * Bootstrap any addon services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Fusion::asset('/addons/TinyMceFieldtype/js/app.js');
        fieldtypes()->register(\Addons\TinyMceFieldtype\Fieldtypes\TinyMceFieldtype::class);
    }
}