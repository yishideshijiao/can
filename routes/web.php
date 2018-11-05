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
    return view('index');
});


//点餐项目
Route::domain("admin.clm.com")->namespace("Admin")->group(function () {

    //region商户分类
    Route::get("shopCate/index", "ShopCategoryController@index")->name("admin.shopCate.index");
    Route::any("shopCate/add", "ShopCategoryController@add")->name("admin.shopCate.add");
    Route::any("shopCate/edit/{id}", "ShopCategoryController@edit")->name("admin.shopCate.edit");
    Route::get("shopCate/del/{id}", "ShopCategoryController@del")->name("admin.shopCate.del");
    Route::any("shopCate/upload", "ShopCategoryController@upload")->name("admin.shopCate.upload");
    //endregion

    //region管理员
    Route::any("admin/login", "AdminController@login")->name("admin.admin.login");
    Route::any("admin/logout", "AdminController@logout")->name("admin.admin.logout");
    Route::get("admin/index", "AdminController@index")->name("admin.admin.index");
    Route::any("admin/edit/{id}", "AdminController@edit")->name("admin.admin.edit");
    Route::get("admin/del/{id}", "AdminController@del")->name("admin.admin.del");
    Route::any("admin/add", "AdminController@add")->name("admin.admin.add");
    Route::any("admin/change", "AdminController@change")->name("admin.admin.change");
    //endregion

    //region管理用户
    Route::get("user/index", "UserController@index")->name("admin.user.index");
    Route::any("user/add", "UserController@add")->name("admin.user.add");
    Route::any("user/edit/{id}", "UserController@edit")->name("admin.user.edit");
    Route::get("user/del/{id}", "UserController@del")->name("admin.user.del");
    //endregion

    //region添加店铺
    Route::any("user/jia/{id}", "UserController@jia")->name("admin.jia.jia");
    //endregion

    //region管理商铺
    Route::get("shop/index", "ShopController@index")->name("admin.shop.index");
    Route::any("shop/add", "ShopController@add")->name("admin.shop.add");
    Route::any("shop/edit/{id}", "ShopController@edit")->name("admin.shop.edit");
    Route::get("shop/del/{id}", "ShopController@del")->name("admin.shop.del");
    Route::get("shop/examine/{id}", "ShopController@examine")->name("admin.shop.examine");
    Route::any("shop/upload", "ShopController@upload")->name("admin.shop.upload");
//    endregion

    //region活动
    Route::get("activity/index", "ActivityController@index")->name("admin.activity.index");
    Route::any("activity/add", "ActivityController@add")->name("admin.activity.add");
    Route::any("activity/edit/{id}", "ActivityController@edit")->name("admin.activity.edit");
    Route::get("activity/del/{id}", "ActivityController@del")->name("admin.activity.del");
    //endregion
});

Route::domain("shop.clm.com")->namespace("Shop")->group(function () {

    //region用户登录
    Route::any("user/reg", "UserController@reg")->name("shop.user.reg");
    Route::any("user/login", "UserController@login")->name("shop.user.login");
    Route::any("user/logout", "UserController@logout")->name("shop.user.logout");
    Route::any("user/change", "UserController@change")->name("shop.user.change");
    //endregion

    //region后台首页
    Route::any("index/index", "IndexController@index")->name("shop.index.index");
    Route::any("index/add", "IndexController@add")->name("shop.index.add");
    //endregion

    //region用户店铺
    Route::get("shop/index", "ShopController@index")->name("shop.shop.index");
    Route::any("shop/add", "ShopController@add")->name("shop.shop.add");
    Route::any("shop/edit/{id}", "ShopController@edit")->name("shop.shop.edit");
    Route::get("shop/del/{id}", "ShopController@del")->name("shop.shop.del");
    Route::get("shop/examine/{id}", "ShopController@examine")->name("shop.shop.examine");
    //endregion

    //region菜单分类
    Route::get("menuCate/index", "MenuCategoryController@index")->name("shop.menucategory.index");
    Route::any("menuCate/add", "MenuCategoryController@add")->name("shop.menucategory.add");
    Route::any("menuCate/edit/{id}", "MenuCategoryController@edit")->name("shop.menucategory.edit");
    Route::get("menuCate/del/{id}", "MenuCategoryController@del")->name("shop.menucategory.del");
    //endregion

    //region显示菜品
    Route::get("menuCate/show/{id}", "MenuCategoryController@show")->name("shop.menucategory.show");
    //endregion

    //region菜品
    Route::get("menu/index", "MenuController@index")->name("shop.menu.index");
    Route::any("menu/add", "MenuController@add")->name("shop.menu.add");
    Route::any("menu/edit/{id}", "MenuController@edit")->name("shop.menu.edit");
    Route::get("menu/del/{id}", "MenuController@del")->name("shop.menu.del");
    Route::any("menu/upload", "MenuController@upload")->name("shop.menu.upload");
    //endregion

    //region活动
    Route::get("activity/index", "ActivityController@index")->name("shop.activity.index");
    Route::get("activity/show/{id}", "ActivityController@show")->name("shop.activity.show");
    //endregion

    //region订单
    Route::get("order/index", "OrderController@index")->name("shop.order.index");
    Route::get("order/show/{id}", "OrderController@show")->name("shop.order.show");
    Route::get("order/remove/{id}", "OrderController@remove")->name("shop.order.remove");
    Route::get("order/go/{id}", "OrderController@go")->name("shop.order.go");
    //endregion

    //region会员
    Route::get("member/index", "MemberController@index")->name("shop.member.index");
    Route::any("member/add", "MemberController@add")->name("shop.member.add");
    Route::any("member/check/{id}", "MemberController@check")->name("shop.member.check");
    Route::get("member/forbidden/{id}", "MemberController@forbidden")->name("shop.member.forbidden");
    Route::get("member/useing/{id}", "MemberController@useing")->name("shop.member.useing");
    //endregion
});


