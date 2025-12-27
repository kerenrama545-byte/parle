<?php

namespace App\Providers;

use App\ViewComposers\SeoMetadataComposer;
use Illuminate\Support\Facades\View;
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
        // Register SEO metadata composer for all views using main layout
        View::composer('components.layouts.main', SeoMetadataComposer::class);
    }
}
