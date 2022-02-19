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



Route::middleware('api')->post('/register', 'AuthController@register');
Route::middleware('api')->post('/login', 'AuthController@login');
Route::middleware('api')->get('/verify', 'AuthController@verify');
Route::middleware('api')->post('/resend_token', 'AuthController@resend_token');
Route::middleware('api')->post('/forget_pass', 'AuthController@forget_pass');
Route::middleware('api')->post('/change_forget_pass', 'AuthController@change_forget_pass');

Route::middleware('api')->get('/map', 'MapController@index');
Route::middleware('api')->get('/shop/{store_id}', 'ApiController@show');
Route::middleware('api')->get('/shop/menu/{store_id}', 'ApiController@menu');
Route::middleware('api')->get('/shop/detail/{store_id}', 'ApiController@detail');
Route::middleware('api')->get('/review/{store_id}', 'ApiController@get_review');

Route::group(['middleware' => 'auth:sanctum'], function() {
  Route::post('/coupon/{store_id}/{user_id}', 'ApiController@use_coupon');
  Route::get('/user/{user_id}', 'UserController@show');
  Route::post('/user/{user_id}/update', 'UserController@update');
  Route::get('/history/{user_id}', 'UserController@history');
  Route::get('/check/{store_id}/{user_id}', 'UserController@check_today');
  Route::post('/review/make/{store_id}/{user_id}', 'ApiController@create_review');
  Route::post('/favorite/{store_id}/{user_id}', 'ApiController@update_favorite');
  Route::post('/contact/{user_id}', 'UserController@contact');
  Route::get('/my_page/{user_id}', 'UserController@get_my_page');
  Route::get('/lotos/{user_id}', 'UserController@get_amount_of_lotos');
  Route::post('/change_pass/{user_id}', 'UserController@change_pass');
  Route::post('/logout', 'AuthController@logout');
  Route::post('/verify/{user_id}', 'AuthController@verify_email');
  Route::post('/get_device_token', 'UserDeviceTokenController@getDeviceToken');
  Route::get('/notice/{user_id}', 'UserController@get_notice');
  Route::post('/read_article', 'UserController@read_article');
  Route::post('/read_articles', 'UserController@read_articles');
  Route::post('/loto/{user_id}', 'UserController@create_loto');
});