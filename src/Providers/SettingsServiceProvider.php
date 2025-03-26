<?php

namespace Codeminos\Settings\Providers;

use Codeminos\Settings\SettingsManager;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SettingsManager::class, function ($app) {
            return new SettingsManager();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/settings.php'
            => config_path('settings.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../database/migrations/create_settings_table.php.stub'
            => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_settings_table.php'),
        ], 'migrations');
    }
}