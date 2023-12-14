<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\app\Http\Controllers\DashboardController;

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
    'as' => 'admin.dashboard.'
], function (){
    Route::get('/', 'DashboardController@index')->name('index');
});
