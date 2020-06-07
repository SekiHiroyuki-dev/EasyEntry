<?php

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

/**
 * Admin側
 */
Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function () {
    // ログイン前
    Route::middleware(['admin.guest'])->group(function () {
        Route::get('login', 'LoginController@index')->name('login');
        Route::post('login', 'LoginController@login')->name('login.login');
    });
    // ログイン後
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('logout', 'LogoutController@index')->name('logout');
    });
});
