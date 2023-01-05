<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::resource('photos', PhotoController::class);

Route::get('test', function () {
    clock('Message text.'); //在Clockwork的log中显示'Message text.'
    logger('Message text.'); //也Clockwork的log中显示'Message text.'

    clock(array('hello' => 'world')); //以json方式在log中显示数组
    //如果对象实现了__toString()方法则在log中显示对应字符串，
    //如果对象实现了toArray方法则显示对应json格式数据，
    //如果都没有则将对象转化为数组并显示对应json格式数据
    return 888;
});

Route::get('test/user/{user}', 'AuthController@user');
Route::get('transistor', 'TransistorController@test');
Route::get('computer/price', 'ComputerController@price');
Route::get('house/backhome', 'HouseController@backHome');

Route::post('sso/okta/callback', function (\Illuminate\Http\Request $request) {
    dd(\MobileNowGroup\OktaLaravelAdmin\Facades\Okta::user());
});
