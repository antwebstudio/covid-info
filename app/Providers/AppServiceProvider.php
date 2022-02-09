<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		
        if (class_exists(\Fusion\Models\Collections\Post::class)) {
            $this->app->bind(\Fusion\Models\Collections\Post::class, \App\Models\Post::class);

            Relation::morphMap([
                app(\App\Models\Post::class)->morphTypeName() => \App\Models\Post::class,
            ]);
        }
    }
	
}
