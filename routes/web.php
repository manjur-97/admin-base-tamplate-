<?php

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

Route::get('/', function () {

    if (auth()->guard('admin')->check()) {
        // Redirect to the admin dashboard
        return redirect()->route('backend.dashboard');
    } elseif (auth()->guard('employee')->check()) {
        // Redirect to the employee dashboard
        return redirect()->route('backend.employee_dashboard');
    } else {
        // Redirect to the backend home if the user is not authenticated
        return redirect()->route('backend.home');
    }
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
