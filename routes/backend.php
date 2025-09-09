<?php


use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CmsSettingController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CommandController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ModuleMakerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [LoginController::class, 'loginPage'])->name('home')->middleware('AuthCheck');
Route::get('/', [LoginController::class, 'loginPage'])->name('home');

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    Artisan::call('optimize:clear');
    Artisan::call('storage:link');
    // Artisan::call('optimize');
    session()->flash('message', 'System Updated Successfully.');
    return redirect()->route('backend.home');
});


Route::group(['as' => 'auth.'], function () {
    Route::get('/login', [LoginController::class, 'loginPage'])->name('login2')->middleware('AuthCheck');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['as' => 'tanent.'], function () {
   
   
});



Route::match(['get', 'post'], '/module-make', [ModuleMakerController::class, 'index'])->name('moduleMaker');

Route::group(['middleware' => 'AdminAuth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/employee_dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee_dashboard');


    // for user
    Route::resource('user', AdminController::class);
    Route::get('user/{id}/status/{status}/change', [AdminController::class, 'changeStatus'])->name('user.status.change');

    // for role
    Route::resource('role', RoleController::class);

    // for permission entry
    Route::resource('permission', PermissionController::class);


    Route::resource('menu', MenuController::class);
    Route::get('menu/{id}/menu/{status}/change', [MenuController::class, 'changeStatus'])->name('menu.status.change');

    Route::resource('command', CommandController::class);
    Route::get('command/{id}/command/{status}/change', [CommandController::class, 'changeStatus'])->name('command.status.change');

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('profile/change_password', [AdminController::class, 'change_password'])->name('profile.change_password');
    Route::post('profile/password_update', [AdminController::class, 'password_update'])->name('profile.password_update');

    include 'dynamic_route.php';
    Route::get('cms-setting/header-list', [CmsSettingController::class, 'headerList'])->name('cms-setting.header-list');
});


Route::get('cms-setting/footer-list', [CmsSettingController::class, 'footerList'])->name('cms-setting.footer-list');
