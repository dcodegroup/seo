<?php

namespace Dcodegroup\SeoSettings;

use Dcodegroup\SeoSettings\Http\Controllers\Admin\SeoDataController;
use Dcodegroup\SeoSettings\Http\Controllers\Admin\SeoSettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SeoSettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->providesDefaultConfig();

        $this->app->bind('seo', function($app) {
            return new Seo();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfigs();
            $this->publishMigrations();
        }

        $this->registerRoutes();
        $this->registerViews();
    }

    private function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/1_create_seo_settings_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_seo_settings_table.php'),
            __DIR__.'/../database/migrations/2_create_seo_data_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 1).'_create_seo_data_table.php'),
        ], 'seo-settings-migrations');
    }

    private function publishConfigs()
    {
        $this->publishes([
            __DIR__.'/../config/seo-settings.php' => config_path('seo-settings.php'),
        ], 'seo-settings-config');
    }

    private function registerRoutes()
    {
        Route::macro('seoSettings', function () {
            Route::name(config('seo-settings.routing.admin.name_prefix'))
                ->prefix(config('seo-settings.routing.admin.prefix'))
                ->middleware(config('seo-settings.routing.admin.middlewares'))
                ->group(function () {
                    Route::resource('seo-settings', SeoSettingController::class)->except('show');
                });

            Route::get('/seo-data/{modelClass}/{modelId}', [SeoDataController::class, 'get']);
            Route::post('/seo-data/{modelClass}/{modelId}', [SeoDataController::class, 'save']);
        });
    }

    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'seo-settings');
    }

    private function providesDefaultConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/seo-settings.php', 'seo-settings'
        );
    }
}