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

Route::group(['prefix'=>'auth','namespace' => 'Api'],function (){
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('update/{id}','AuthController@update');
});



Route::group(['namespace' => 'Api','middleware'=>'jwtAuth'],function (){
    Route::get('/orders','OrderController@index')->name('orders');
    Route::post('/order/store','OrderController@store')->name('order.store');
    Route::get('/order/cancel/{id}','OrderController@cancel')->name('order.cancel');
});
