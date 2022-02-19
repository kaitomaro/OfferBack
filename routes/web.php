<?php

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



Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    Auth::routes(['reset' => false, 'verify' => false]);
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('/notify', 'HomeController@notify')->name('notify');
	Route::get('show/{shop_id}/bills', 'HomeController@fee')->name('bills');
	Route::get('show/{shop_id}/bills/{month_id}', 'HomeController@fee_datail')->name('bills.detail');
	Route::get('earnings', 'HomeController@earnings')->name('earnings');
	Route::get('earnings/{month_id}', 'HomeController@earning_detail')->name('earnings.detail');
	Route::post('/notify', 'HomeController@create_notify')->name('create_notify');
	Route::get('/prize_notify/{loto_id}', 'HomeController@show_prize_notify')->name('private_notify');
	Route::post('/notify_prize', 'HomeController@send_prize_notify')->name('send_prize_notify');
	Route::get('show/{shop_id}/mail', 'HomeController@mail')->name('mail');
	Route::post('show/{shop_id}/mail', 'HomeController@change_mail')->name('change_mail');
	Route::get('show/{shop_id}', 'HomeController@show')->name('show');
});

Route::prefix('store')->name('store.')->namespace('Store')->group(function() {
	Auth::routes(['verify' => false,'register' => false]);
	Route::get('/', 'StoresController@index')->name('home');
	Route::get('/bills', 'StoresController@fee')->name('bills');
	Route::get('/bills/{month_id}', 'StoresController@fee_datail')->name('bills.detail');
	Route::get('/articles', 'StoresController@articles')->name('articles');
	Route::get('/files/operation', 'StoresController@get_operation')->name('file.operation');
	Route::get('/', 'StoresController@index')->name('home');
	Route::get('/basic', 'StoresController@basic')->name('basic');
	Route::post('/basic/update', 'StoresController@update_basic')->name('basic.update');
	Route::get('/images', 'StoreImageController@index')->name('images');
	Route::post('/images', 'StoreImageController@create_image')->name('images.create');
	Route::get('/services', 'ServiceController@index')->name('service');
	Route::post('/services/create', 'ServiceController@insert_service')->name('service.create');
	Route::post('/services/update/', 'ServiceController@update_service')->name('service.update');
	Route::get('/coupons', 'CouponController@index')->name('coupon');
	Route::get('/coupons/{time_type}/{time_id}', 'CouponController@show')->name('coupon.show');
	Route::post('/coupons/{time_type}/{time_id}/update', 'CouponController@update_coupon')->name('coupon.update');
	Route::get('/menus', 'MenuController@index')->name('menu');
	Route::post('/menus/create', 'MenuController@create')->name('menu.create');
});

Route::group(['middleware' => 'signed'], function() {
    Route::get('/hello/hi', 'HelloController@get_hello_mail')->name('hello.hi');
});
Route::post('/hello/start', 'HelloController@start_store_account')->name('hello.start');

Route::get('/', 'HomeController@hp')->name('hp');
Route::get('/stores', 'HomeController@hp_store')->name('hp_store');
Route::get('/about', 'HomeController@about')->name('about');
Route::post('/contact', 'HomeController@contact')->name('contact');
Route::get('/coupon/{shop_id}', 'HomeController@open_app')->name('open_app');