<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\app\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [ClientController::class, 'welcome'])->middleware(['check.authenticated'])->name('welcome');

Route::group(
    [
        'prefix' => 'trang-ca-nhan',
        'as' => 'client.',
        'middleware' => 'web'
    ],
    function () {
        Route::get('/', function (){
            return redirect()->route('client.home');
        });
        Route::get('home', [ClientController::class, 'home'])->name('home');
        Route::get('setting', [ClientController::class, 'setting'])->name('setting');
        Route::group(['as' => 'links.', 'prefix' => 'links'], function (){
            Route::get('/', [ClientController::class, 'links'])->name('index');

            Route::get('/create', [ClientController::class, 'createUrl'])->name('create');
            Route::post('/', [ClientController::class, 'storeUrl'])->name('store');

            Route::get('/data/{id?}',[ClientController::class, 'dataUrl'])->name('data');
            Route::post('/hidden', [ClientController::class, 'hideUrls'])->name('hidden');
            Route::post('/active', [ClientController::class, 'activeUrls'])->name('active');

            Route::patch('/{url}',[ClientController::class, 'updateUrl'])->name('update');
            Route::put('/{url}',[ClientController::class, 'updateUrl'])->name('update');
            Route::delete('/{url}', [ClientController::class, 'deleteUrl'])->name('delete');

            Route::get('/{shortLink}/detail', [ClientController::class, 'showUrl'])->name('show');
        });
        Route::group(['as' => 'tags.', 'prefix'=> 'tags'], function (){
            Route::post('/', [ClientController::class, 'storeTag'])->name('store');
        });
        Route::group(['as' =>'user.', 'prefix' => 'user'], function (){
            Route::put('/{user}', [ClientController::class, 'updateUser'])->name('update');
            Route::patch('/{user}', [ClientController::class, 'updateUser'])->name('update');
            Route::delete('/{user}', [ClientController::class, 'deleteUser'])->name('destroy');
        });
    }
);
