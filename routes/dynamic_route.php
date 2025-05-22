<?php

use App\Http\Controllers\Backend\WeekendSettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;




// RolePermission
Route::resource('rolepermission', 'App\Http\Controllers\Backend\RolePermissionController')->except(['show']);
Route::get('rolepermission/{id}/status/{status}/change', 'App\Http\Controllers\Backend\RolePermissionController@changeStatus')->name('rolepermission.status.change');


// RolePermission
Route::resource('rolepermission', 'App\Http\Controllers\Backend\RolePermissionController')->except(['show']);
Route::get('rolepermission/{id}/status/{status}/change', 'App\Http\Controllers\Backend\RolePermissionController@changeStatus')->name('rolepermission.status.change');



// WebsiteMenu
Route::resource('websitemenu', 'App\Http\Controllers\Backend\WebsiteController')->except(['show']);
Route::get('websitemenu/{id}/status/{status}/change', 'App\Http\Controllers\Backend\WebsiteController@changeStatus')->name('websitemenu.status.change');


// WebsitePage
Route::resource('websitepage', 'App\Http\Controllers\Backend\WebsitePageController')->except(['show']);
Route::get('websitepage/{id}/status/{status}/change', 'App\Http\Controllers\Backend\WebsitePageController@changeStatus')->name('websitepage.status.change');
