<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FetchDataController;
use App\Http\Controllers\Admin\MaskapaiController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
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

Route::group(['as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('maskapai', MaskapaiController::class);
    Route::resource('products', ProductController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('user', UserController::class);

    Route::group(['prefix' => 'fetch', 'as' => 'fetch.'], function () {
        Route::post('/airport', [FetchDataController::class, 'fetchDataAirport'])->name('airport');
    });
    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'controller' => RolesController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/edit', 'update')->name('update');
    });
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.', 'controller' => PermissionsController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/edit', 'update')->name('update');
    });
});
