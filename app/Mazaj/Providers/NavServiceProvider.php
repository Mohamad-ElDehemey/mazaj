<?php

namespace Mazaj\Providers;

use Illuminate\Support\ServiceProvider;

class NavServiceProvider extends ServiceProvider {

	protected $defer = false;

    public function register()
    {
        $this->app->bind('nav', function()
            {
                return new \Mazaj\Nav();
            });
    }

}