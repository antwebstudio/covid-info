<?php

namespace Addons\TagFieldtype\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Fusion\Events\ServingFusion;
use Addons\TagFieldtype\Listeners\AddonMenuLoader;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ServingFusion::class => [
            AddonMenuLoader::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
