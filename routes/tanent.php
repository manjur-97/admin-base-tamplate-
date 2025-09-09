<?php

use App\Http\Controllers\Backend\WebsitePageController;
use App\Http\Controllers\Cms\CmsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tanent\TanentDashboardController;

Route::group(['middleware' => 'AdminAuth'], function () {
    Route::get('/dashboard', [TanentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/website/create', [TanentDashboardController::class, 'create'])->name('website.create');
    Route::post('/website/store', [TanentDashboardController::class, 'store'])->name('website.store');
    Route::get('/website/edit/{id}', [TanentDashboardController::class, 'edit'])->name('website.edit');
    Route::post('/website/update/{id}', [TanentDashboardController::class, 'update'])->name('website.update');
    Route::get('/website/destroy/{id}', [TanentDashboardController::class, 'destroy'])->name('website.destroy');
    Route::get('/website/show/{id}', [TanentDashboardController::class, 'show'])->name('website.show');
    Route::get('/website/settings/{id}', [CmsController::class, 'settings'])->name('website.settings');

    Route::get('/website/configuration/{id}', [CmsController::class, 'configuration'])->name('website.configuration');
    Route::get('/website/header_config/{id}', [CmsController::class, 'header_config'])->name('website.header_config');
    Route::get('/website/header_customization/{id}', [CmsController::class, 'header_customization'])->name('website.header_customization');
    Route::get('/website/footer_config/{id}', [CmsController::class, 'footer_config'])->name('website.footer_config');
    Route::get('/website/menu_config/{id}', [CmsController::class, 'menu_config'])->name('website.menu_config');
    Route::get('/website/pages_config/{id}', [CmsController::class, 'pages_config'])->name('website.pages_config');
    Route::get('/website/page_create/{id}', [CmsController::class, 'page_create'])->name('website.page_create');
    Route::get('/website/page_edit/{id}', [CmsController::class, 'page_edit'])->name('website.page_edit');
    Route::post('/website/page_store', [WebsitePageController::class, 'store'])->name('website.page_store');
    Route::put('/website/page_update/{id}', [WebsitePageController::class, 'update'])->name('website.page_update');

    Route::get('/website/content/{id}', [TanentDashboardController::class, 'content'])->name('website.content');
    Route::get('/website/seo/{id}', [TanentDashboardController::class, 'seo'])->name('website.seo');
    Route::get('/website/analytics/{id}', [TanentDashboardController::class, 'analytics'])->name('website.analytics');
    Route::get('/website/sitemap/{id}', [TanentDashboardController::class, 'sitemap'])->name('website.sitemap');
    Route::get('/website/social/{id}', [TanentDashboardController::class, 'social'])->name('website.social');
    Route::get('/website/security/{id}', [TanentDashboardController::class, 'security'])->name('website.security');
    
    
    
    
});
