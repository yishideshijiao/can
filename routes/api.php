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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(function (){

//店铺
Route::get("shop/index","ShopController@index");
Route::get("shop/detail","ShopController@detail");
//会员
Route::get("member/sms","MemberController@sms");
Route::post("member/login","MemberController@login");
Route::post("member/reg","MemberController@reg");
Route::post("member/wang","MemberController@wang");
Route::post("member/change","MemberController@change");
Route::get("member/detail","MemberController@detail");
//地址
Route::get("adress/index","AdressController@index");
Route::post("adress/add","AdressController@add");
Route::post("adress/edit","AdressController@edit");
Route::get("adress/del","AdressController@del");
//购物车
Route::post("carts/add","CartsController@add");
Route::get("carts/show","CartsController@show");
//订单
Route::post("order/add","OrderController@add");
Route::get("order/detail","OrderController@detail");
Route::get("order/index","OrderController@index");
Route::post("order/pay","OrderController@pay");
Route::get("order/wxPay","OrderController@wxPay");
Route::any("order/ok","OrderController@ok");
Route::any("order/status","OrderController@status");
});
