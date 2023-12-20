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

Route::get('test', '\App\Http\Controllers\GeneralController@test');

Route::get('/form', [FormController::class, 'showForm']);
Route::post('/process-form', [FormController::class, 'processForm']);

Route::get('/settings', '\App\Http\Controllers\SettingsController@showForm')->name('settings');
Route::put('/settings/{id}', '\App\Http\Controllers\SettingsController@update')->name('settings.update');


Route::get('/location/create', '\App\Http\Controllers\LocationController@create')->name('location.create');
Route::post('/location/store', '\App\Http\Controllers\LocationController@store')->name('location.store');