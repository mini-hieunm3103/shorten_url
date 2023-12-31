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

Route::group([
    'prefix' => 'quan-tri-vien',
    'as' => 'admin.',
], function () {
    Route::resource('url', UrlController::class)->names('url');
    Route::get('url/data/{id?}', 'UrlController@data')->name('url.data');
    Route::post('url/hidden', 'UrlController@hideListUrl')->name('url.hidden');
    Route::post('url/active', 'UrlController@activeListUrl')->name('url.active');
});
