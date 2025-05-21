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

