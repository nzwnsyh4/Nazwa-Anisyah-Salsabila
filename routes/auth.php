<?php

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

Route::group(['controller' => AuthController::class, 'as' => 'auth.', 'middleware' => ['guest']], function () {
    Route::get('/', 'index')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/', 'login')->name('login.proccess');
    Route::post('/register', 'store')->name('register.proccess');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
