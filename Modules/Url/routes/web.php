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

Route::get('/', 'UrlController@create')->name('create');
Route::post('/', 'UrlController@store')->name('store');
Route::get('/detail-{id}.php', 'UrlController@show')->name('show');
Route::get('/{shortenUrl}', 'UrlController@redirect')->where('shortenUrl', '.*');
