<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CmsSetting;
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
            $settings = CmsSetting::first();

            if (!$settings) {
                $settings = new CmsSetting();
                $settings->header = 'header_10.blade.php';
                $settings->footer = 'footer_1.blade.php';
                $settings->save();
            }

            $view->with([
                'cms_header' => $settings->header,
                'cms_footer' => $settings->footer
            ]);
        });
    }
}
