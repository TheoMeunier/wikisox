<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;
use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Setting $settings): void
    {
        $settings = Cache::remember('settings', 60, static function() use ($settings){
            return $settings->query()->pluck('value', 'name')->all();
        });

        config()->set('settings', $settings);
    }
}
