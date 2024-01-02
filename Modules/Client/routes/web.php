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
        Route::get('links', [ClientController::class, 'links'])->name('links.index');
        Route::get('links/create', [ClientController::class, 'createUrl'])->name('links.create');
        Route::get('links/{shortLink}/detail', [ClientController::class, 'showUrl'])->name('links.show');
        Route::get('setting', [ClientController::class, 'setting'])->name('setting');
    }
);
