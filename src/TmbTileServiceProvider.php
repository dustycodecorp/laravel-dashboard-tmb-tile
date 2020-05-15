<?php

namespace Dustycode\TmbTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class TmbTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ListenForTmbUpdatesCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-tmb-tile'),
        ], 'dashboard-tmb-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-tmb-tile');

        Livewire::component('tmb-tile', TmbTileComponent::class);
    }
}
