<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Company;
use App\Models\FrontMenu;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Inertia::share([
            'auth' => function () {
                return [
                    'user' => Auth::guard('admin')->user(),
                ];
            },

            
        ]);

        //$companyInfo = session()->get('companyInfo', Company::first());
        //$navbarMenus = session()->get('navbarMenus', FrontMenu::where('status', 'Active')->where('type', 'navbar')->get());
        //$headerMenus = session()->get('headerMenus', FrontMenu::where('status', 'Active')->where('type', 'header')->get());
        //$footerMenus = session()->get('footerMenus', FrontMenu::where('status', 'Active')->where('type', 'footer')->get());

        //View::share([
        //    'companyInfo' => $companyInfo,
        //    'navbarMenus' => $navbarMenus,
        //    'headerMenus' => $headerMenus,
        //    'footerMenus' => $footerMenus,
        //]);
    }
}
