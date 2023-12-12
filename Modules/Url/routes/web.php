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
});
Route::group([
    'prefix' => 'quan-tri-vien',
    'as' => 'admin.',
], function () {
    Route::get('user-urls/user={user}', 'UrlController@show')->name('user-urls.show');
});
