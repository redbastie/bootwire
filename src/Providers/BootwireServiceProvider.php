<?php

namespace Redbastie\Bootwire\Providers;

use Illuminate\Support\ServiceProvider;
use Redbastie\Bootwire\Commands\InstallsBootwire;

class BootwireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallsBootwire::class,
            ]);
        }
    }
}
