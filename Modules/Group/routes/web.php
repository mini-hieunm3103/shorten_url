<?php

use Illuminate\Support\Facades\Route;
use Modules\Group\app\Http\Controllers\GroupController;

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
        'prefix' => 'quan-tri-vien',
        'as' => 'admin.',
        'middleware' => ['web', 'check.role:user']
    ],
    function () {
    Route::resource('group', GroupController::class)->names('group');
    Route::group(
        [
            'as' => 'group.',
            'prefix' => 'group',
        ],
        function (){
            Route::get('/{id}/permission', [GroupController::class, 'getPermissionForm'])->name('permission');
            Route::put('/{id}/permission', [GroupController::class, 'permissionHandle'])->name('permission-handle');
        }
    );
});
