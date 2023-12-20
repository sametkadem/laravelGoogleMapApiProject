<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('', '\App\Http\Controllers\LocationController@create');

Route::get('/form', [FormController::class, 'showForm']);
Route::post('/process-form', [FormController::class, 'processForm']);

Route::get('/settings', '\App\Http\Controllers\SettingsController@showForm')->name('settings');
Route::put('/settings/{id}', '\App\Http\Controllers\SettingsController@update')->name('settings.update');


Route::get('/location', '\App\Http\Controllers\LocationController@create')->name('location.create');
Route::post('/location/store', '\App\Http\Controllers\LocationController@store')->name('location.store');

Route::get('/location/detail/{id}', '\App\Http\Controllers\LocationController@editByID')->name('location.edit');
Route::post('/location/detail/update', '\App\Http\Controllers\LocationController@updateById')->name('location.updateById');
Route::get('/location/detail/delete/{id}', '\App\Http\Controllers\LocationController@deleteById')->name('location.deleteById');


Route::get('/location/map/show/{id}', '\App\Http\Controllers\LocationController@showMapById')->name('location.showById');
Route::post('/location/map/show/distance', '\App\Http\Controllers\LocationController@showDistanceMayByIds')->name('location.distance');
Route::post('/location/map/show/all', '\App\Http\Controllers\LocationController@showMapAll')->name('location.showMapAll');

