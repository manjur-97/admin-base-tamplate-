<?php

use App\Http\Controllers\Cms\CmsController;
use App\Http\Controllers\Backend\CmsSettingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShowMyPro\ShowMyProController;
use App\Http\Controllers\TanentRegistrationController;
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

Route::get('/website/{slug}/{id}', [CmsController::class, 'index'])->name('home');

Route::get('/', [ShowMyProController::class, 'landing_page'])->name('landing_page');
Route::get('/register_page', [ShowMyProController::class, 'register_page'])->name('tanent.register');
Route::get('/login_page', [ShowMyProController::class, 'login_page'])->name('tanent.login');
Route::post('/register', [ShowMyProController::class, 'register'])->name('tanent.register.post');
Route::post('/verify-otp', [ShowMyProController::class, 'verifyOtp'])->name('tanent.verify.otp');

Route::post('/tanent_login', [ShowMyProController::class, 'TanentLogin'])->name('tanent_login')->middleware('AuthCheck');
Route::get('/tanent_logout', [LoginController::class, 'TanentLogout'])->name('tanent_logout');


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


if (file_exists(base_path('routes/cms_dynamic.php'))) {
    require base_path('routes/cms_dynamic.php');
} 


Route::get('/contact', [App\Http\Controllers\Cms\CmsController::class, 'contact'])->name('contact');
Route::get('/about', [App\Http\Controllers\Cms\CmsController::class, 'about'])->name('about');
