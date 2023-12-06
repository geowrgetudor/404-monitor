<?php

namespace Geow\NotFoundMonitor;

use Geow\NotFoundMonitor\Livewire\NotFoundMonitor;
use Illuminate\Contracts\Foundation\Application;
use Livewire\LivewireManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NotFoundMonitorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('404-monitor')
            ->hasViews();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', '404-monitor');

        $this->callAfterResolving('livewire', function (LivewireManager $livewire, Application $app) {
            $livewire->component('404-monitor', NotFoundMonitor::class);
        });
    }
}
