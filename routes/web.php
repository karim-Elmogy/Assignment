<?php

use App\Http\Controllers\UserSignup\UserRegisterController;
use Illuminate\Support\Facades\Auth;
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
//Auth::routes(['register'=>false]);
//Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('selection')
    ->middleware('guest')->middleware('disBack');




Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}','LoginController@loginForm')->middleware('guest')
        ->name('login.show')->middleware('disBack');

    Route::post('/login','LoginController@login')->name('login');

    Route::get('/logout/{type}','LoginController@logout')->name('logout');

});





######################### - Admin Dashboard - ##########################
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'Admin'])
    ->name('admin.home')->middleware('auth:admin')->middleware('disBack');




######################### - Service Provider Dashboard - ##########################
Route::get('/service/home', [App\Http\Controllers\HomeController::class, 'Service'])
    ->name('service.home')->middleware('auth:service')->middleware('disBack');


######################### - Customer Dashboard - ##########################
Route::get('/user/home', function () {
    return view('user.home');
})->name('user.home')->middleware('auth:web')->middleware('disBack');







######################### - Register New Customer - ##########################
Route::group(['namespace' => 'UserSignup'],function (){
    Route::get('/signup/user','UserRegisterController@index')->name('signup.user');
    Route::post('/signup/store','UserRegisterController@store')->name('signup.store');
    Route::get('/edit/user','UserRegisterController@edit')->name('user.edit');
    Route::PATCH('user/update/{id}','UserRegisterController@update')->name('user.update');
});





######################### - Register New Service Provider - ##########################
Route::group(['namespace' => 'ServiceSignup'],function (){
    Route::get('/signup/service','ServicerRegisterController@index')->name('signup.service');
    Route::post('/service/store','ServicerRegisterController@store')->name('services.store');
    Route::get('/edit/service','ServicerRegisterController@edit')->name('service.edit');
    Route::PATCH('account/update/id}','ServicerRegisterController@update')->name('account.update');
});














######################### - Admin - ##########################

Route::group(['namespace' => 'SystemUse','middleware'=>'auth:admin'],function (){

    ######################### - View All User - ##########################
    Route::get('/users','UserController@index')->name('users.index');
    Route::delete('/users/delete/{id}','UserController@delete')->name('users.delete');

    ######################### - View All Service Provider - ##########################
    Route::get('/services','ServiceController@index')->name('services.index');
    Route::patch('services/update/{id}','ServiceController@update')->name('services.update');
    Route::delete('/delete/{id}','ServiceController@delete')->name('services.delete');
});





######################### - Routes Service Dashboard - ##########################
Route::group(['namespace' => 'ProductController'],function (){
    Route::resource('/products','ProductController');
});





Route::group(['namespace' => 'OrderController'],function (){
    Route::get('/orders','OrderController@index')->name('orders.index');
    Route::get('/store/{test}','OrderController@store')->name('orders.store');
    Route::patch('/update/{id}','OrderController@update')->name('order.update');
    Route::get('/cancel/{id}','OrderController@cancel')->name('order.cancel');
    Route::delete('/destroy/{test}','OrderController@destroy')->name('orders.destroy');
});
