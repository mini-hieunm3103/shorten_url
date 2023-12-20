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

Route::get('/login.php', "Admin\LoginController@showLoginForm")->name('login');
Route::post('/login.php', "Admin\LoginController@login");

Route::post('/logout.php', 'Admin\LoginController@logout')->name('logout');

// forgot password and reset password
Route::get('password/reset.php', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email.php', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset.php', 'Admin\ResetPasswordController@reset')->name('password.update');
