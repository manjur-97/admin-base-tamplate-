<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CmsSetting;
use App\Models\WebsiteMenu;
use Illuminate\Support\Facades\File;

class CmsServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        // Share CMS components with all views
        View::composer('*', function ($view) {


          
        });
    }
}
