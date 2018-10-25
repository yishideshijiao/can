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


//点餐项目
Route::domain("admin.clm.com")->namespace("Admin")->group(function () {

    //商户分类
    Route::get("shopCate/index", "ShopCategoryController@index")->name("admin.shopCate.index");
    Route::any("shopCate/add", "ShopCategoryController@add")->name("admin.shopCate.add");
    Route::any("shopCate/edit/{id}", "ShopCategoryController@edit")->name("admin.shopCate.edit");
    Route::get("shopCate/del/{id}", "ShopCategoryController@del")->name("admin.shopCate.del");

    Route::any("admin/login", "AdminController@login")->name("admin.admin.login");
    Route::any("admin/logout", "AdminController@logout")->name("admin.admin.logout");
    Route::get("admin/index", "AdminController@index")->name("admin.admin.index");
    Route::any("admin/edit/{id}", "AdminController@edit")->name("admin.admin.edit");
    Route::get("admin/del/{id}", "AdminController@del")->name("admin.admin.del");
    Route::any("admin/add", "AdminController@add")->name("admin.admin.add");
});

Route::domain("shop.clm.com")->namespace("Shop")->group(function () {

    //用户
    Route::get("user/index", "UserController@index")->name("shop.user.index");
    Route::any("user/add", "UserController@add")->name("shop.user.add");
    Route::any("user/edit/{id}", "UserController@edit")->name("shop.user.edit");
    Route::get("user/del/{id}", "UserController@del")->name("shop.user.del");
    Route::get("user/examine", "UserController@examine")->name("shop.user.examine");
    Route::any("user/reg", "UserController@reg")->name("shop.user.reg");
    Route::any("user/login", "UserController@login")->name("shop.user.login");
    Route::any("user/logout", "UserController@logout")->name("shop.user.logout");

    //user首页
    Route::any("index/index", "IndexController@index")->name("shop.index.index");
    Route::any("index/add", "IndexController@add")->name("shop.index.add");
});

Route::domain("shop.clm.com")->namespace("Shop")->group(function () {

    //店铺
    Route::get("shop/index", "ShopController@index")->name("shop.shop.index");
    Route::any("shop/add", "ShopController@add")->name("shop.shop.add");
    Route::any("shop/edit/{id}", "ShopController@edit")->name("shop.shop.edit");
    Route::get("shop/del/{id}", "ShopController@del")->name("shop.shop.del");
    Route::get("shop/examine/{id}", "ShopController@examine")->name("shop.shop.examine");

});
