<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SettingsController;


Route::get('', [LocationController::class, 'create']);

Route::get('/settings', [SettingsController::class, 'showForm'])->name('settings');
Route::put('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');

Route::get('/location/map/show/{id}', [LocationController::class, 'showMapById'])->name('location.showById');
Route::post('/location/map/show/distance', [LocationController::class, 'showDistanceMayByIds'])->name('location.distance');
Route::post('/location/map/show/all', [LocationController::class, 'showMapAll'])->name('location.showMapAll');

Route::prefix('/location')->group(function () {
    Route::get('', [LocationController::class, 'create'])->name('location.create');
    Route::post('/store', [LocationController::class, 'storeOrUpdate'])->name('location.store');
    Route::get('/detail/{id}', [LocationController::class, 'editByID'])->name('location.edit');
    Route::post('/detail/update', [LocationController::class, 'storeOrUpdate'])->name('location.updateById');
    Route::get('/detail/delete/{id}', [LocationController::class, 'deleteById'])->name('location.deleteById');
});



