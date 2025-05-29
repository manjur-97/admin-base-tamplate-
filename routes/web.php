<?php

use App\Http\Controllers\Cms\CmsController;
use App\Http\Controllers\Backend\CmsSettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CmsController::class, 'index'])->name('home');

Route::get('/cms/settings', [CmsSettingController::class, 'index'])->name('cms.settings.index');
Route::post('/cms/settings/save', [CmsSettingController::class, 'saveSetting'])->name('cms.settings.save');
Route::get('/cms/settings/get/{component}', [CmsSettingController::class, 'getComponent'])->name('cms.settings.get');

Route::get('/cms/settings/headers', [CmsSettingController::class, 'headerList'])->name('cms.settings.headers');
Route::post('/cms/settings/save-header', [CmsSettingController::class, 'saveHeader'])->name('cms.settings.save-header');

Route::get('/cms/settings/footers', [CmsSettingController::class, 'footerList'])->name('cms.settings.footers');
Route::post('/cms/settings/save-footer', [CmsSettingController::class, 'saveFooter'])->name('cms.settings.save-footer');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



Route::get('/about', [App\Http\Controllers\Cms\CmsController::class, 'about'])->name('about');