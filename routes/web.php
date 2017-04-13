<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


/**
 * Home routes
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeController@show')->name('show')->where('id', '[0-9]+');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/comment/{id}', 'HomeController@addComment')->name('comment')->where('id', '[0-9]+');
    Route::post('/comment/{id}', 'HomeController@setComment')->where('id', '[0-9]+');
    Route::delete('/comment/{id}', 'HomeController@destroyComment')->name('comment.destroy')->where('id', '[0-9]+');
});


/**
 * Profile routes
 */
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/{id}', 'ProfileController@index')->name('profile')->where('id', '[0-9]+');
    Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/edit', 'ProfileController@update')->name('profile.update');
});


/**
 * Admin routes
 */
Route::get('admin', 'Admin\Auth\LoginController@showLoginForm')->name('admin');
Route::post('admin', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::group(['prefix' => 'admin'], function () {
    Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Admin\Auth\RegisterController@register');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin/logout');
    Route::get('espace', 'AdminController@espace')->name('espace')->middleware('admin');
});

/**
 * Cart routes
 */
Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function () {
    Route::get('', 'CartController@index')->name('cart.index');
    Route::get('add/{id}', 'CartController@add')->where('key', '[0-9]+');
    Route::get('clear', 'CartController@clear')->name('cart.clear');
    Route::get('remove/{key}', 'CartController@remove')->name('cart.remove');
    Route::get('remove/minus/{key}', 'CartController@minus')->where('key', '[0-9]+');
    Route::get('remove/plus/{key}', 'CartController@plus')->where('key', '[0-9]+');
    Route::get('purchase', 'CartController@purchase')->name('cart.purchase');
});

/**
 * Order routes
 */
Route::group(['prefix' => 'order', 'middleware' => 'auth'], function () {
    Route::get('', 'OrderController@index')->name('order.index');
});

/**
 * Admin.Product routes
 */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resource('product', 'Admin\ProductController');
});

/**
 * Admin.Type routes
 */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('type', 'Admin\TypeController@index')->name('type.index');
    Route::post('type/store', 'Admin\TypeController@store')->name('type.store');
    Route::delete('type/{id}', 'Admin\TypeController@destroy')->name('type.destroy')->where('id', '[0-9]+');
});

/**
 * Admin.Order routes
 */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('order', 'Admin\OrderController@index')->name('admin.order.index');
    Route::get('order/{id}', 'Admin\OrderController@show')->name('admin.order.show')->where('id', '[0-9]+');
    Route::put('order/state/{id}', 'Admin\OrderController@changeState')->name('order.state')->where('id', '[0-9]+');
});