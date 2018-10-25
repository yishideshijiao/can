<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function index()
    {
        //判断是否有店铺
//        dd(Auth::user()->shop);
        if (Auth::user()->shop === null) {

            //跳转到添加商铺
            return redirect()->route("shop.index.add")->with("danger", "你还没有创建店铺");

        }
        return view("shop.index.index")->with("danger", "你已有店铺");
    }

    public function add(Request $request)
    {
        $cates = ShopCategory::all();

        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);

            $data = $request->post();
            $data['shop_img'] = $request->file("img")->store("images", "image");

            $id = Auth::guard()->user()->id;
            $data["user_id"] = $id;

//            dd($data);
            Shop::create($data);
            return redirect()->route("shop.index.index")->with("success", "添加成功");
        } else {
            return view("shop.index.add", compact("cates"));
        }
    }
}
