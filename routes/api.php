<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Apis')->group(function () {
    Route::prefix('arduino/finger')->middleware(['arduino'])->group(function () { // 用户API
        Route::get('login', 'LockController@fingerLogin'); // 用户按指纹进门
        Route::get('logout', 'LockController@fingerLogout'); // 用户按指纹离开
    });

    Route::prefix('arduino/finger/admin')->middleware(['arduino'])->group(function () { // 管理API
        Route::get('get_available_id', 'LockController@getAvailableId'); // 获取可用的指纹ID
        Route::get('new', 'LockController@newFingerInput'); // 新指纹录入
    });

    Route::get('arduino/time', 'LockController@getServerTime'); // 获取服务器时间
    Route::get('arduino/sign', 'LockController@signTest'); // 获取服务器时间
});
