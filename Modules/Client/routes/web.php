<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\app\Http\Controllers\ClientController;

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

Route::group(
    [
        'prefix' => 'trang-ca-nhan',
        'as' => 'client.'
    ],
    function () {
        Route::get('home', [ClientController::class, 'home'])->name('home');
        Route::get('links', [ClientController::class, 'links'])->name('links.index');
        Route::get('links/create', [ClientController::class, 'createUrl'])->name('links.create');
    }
);
// thay vì gửi id lên thẳng url thì có thể lấy ra bằng auth()->user() sau khi đăng nhập
