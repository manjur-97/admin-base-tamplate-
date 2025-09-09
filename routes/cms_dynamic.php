
<?php

use Illuminate\Support\Facades\Route;


Route::get('/manjur-rahman', [\App\Http\Controllers\Cms\Tanent3Controller::class, 'index'])->name('manjur-rahman');

Route::get('/manjur-rahman/about', [App\Http\Controllers\Cms\Tanent3Controller::class, 'about'])->name('manjur-rahman.about');
Route::get('/manjur-rahman/contact', [App\Http\Controllers\Cms\Tanent3Controller::class, 'contact'])->name('manjur-rahman.contact');
Route::get('/shuvo', [\App\Http\Controllers\Cms\Tanent4Controller::class, 'index'])->name('shuvo');

Route::get('/shuvo/about', [App\Http\Controllers\Cms\Tanent4Controller::class, 'about'])->name('shuvo.about');
Route::get('/sfgsd', [\App\Http\Controllers\Cms\Tanent5Controller::class, 'index'])->name('sfgsd');
