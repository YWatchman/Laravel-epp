<?php

namespace YWatchman\LaravelEPP;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap application events
     */
    public function boot() {
        $this->publishConfig();
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('laravel-epp.php')], 'config');
    }
    private function getConfigPath()
    {
        return __DIR__ . '/../../config/laravel-epp.php';
    }
}
