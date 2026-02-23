<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $supportedLocales = ['en', 'es', 'pl', 'de', 'fr'];
        $locale = config('app.locale');
        if (in_array($locale, $supportedLocales, true)) {
            app()->setLocale($locale);
        }

        // Ensure public storage link exists (e.g. for hero image).
        $link = public_path('storage');
        if (! is_link($link) && ! is_dir($link)) {
            Artisan::call('storage:link');
        }

        // Ensure hero upload directory exists so Filament uploads can succeed.
        Storage::disk('public')->makeDirectory('hero');
    }
}
