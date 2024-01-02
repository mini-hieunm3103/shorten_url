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

Route::get('/login.php', "LoginController@showLoginForm")->name('login');
Route::post('/login.php', "LoginController@login");

Route::post('/logout.php', 'LoginController@logout')->name('logout');

Route::get('/register.php', "RegisterController@showRegistrationForm")->name('register');
Route::post('/register.php', "RegisterController@register");

// forgot password and reset password
Route::get('password/reset.php', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email.php', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset.php', 'ResetPasswordController@reset')->name('password.update');
