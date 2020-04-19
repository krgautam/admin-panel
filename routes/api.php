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
Route::post('login', 'Auth\LoginController@loginApi');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('cameras', 'ApiController@cameras');
    Route::post('camera/images', 'ApiController@camera_images');
    Route::post('location', 'ApiController@saveLatLong');
    Route::get('payments/status/{id}', 'ApiController@payments');
    Route::get('payments/{id}/generateOrder', 'ApiController@generateOrder');
    Route::post('payments/{id}/savePayment', 'ApiController@savePayment');
});
