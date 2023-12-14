<?php

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

Route::get('/login', "Admin\LoginController@showLoginForm")->name('login');
Route::post('/login', "Admin\LoginController@login");

Route::post('/logout', 'Admin\LoginController@logout')->name('logout');

// forgot password and reset password
Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Admin\ResetPasswordController@reset')->name('password.update');
