<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{

    public function index()
    {
        $shops = Shop::paginate(4);
        return view("shop.shop.index", compact("shops"));
    }

    public function add(Request $request)
    {
        $cates = ShopCategory::all();
        $users = User::all();
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
//            dd($data);
            Shop::create($data);
            return redirect()->route("shop.shop.index")->with("success", "添加成功");
        } else {
            return view("shop.shop.add", compact("cates", "users"));
        }
    }

    public function del($id)
    {
        $shop = Shop::find($id);
        if ($shop->delete()) {
            return redirect()->route("shop.shop.index");
        }

    }

    public function edit(Request $request, $id)
    {
        $shop = Shop::find($id);
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);
            $data = $request->post();
//            dd($data);
            $data['shop_img'] = $request->file("img")->store("images", "image");
            if ($shop->update($data)) {
                return redirect()->route("shop.shop.index");
            }
        } else {
            return view('shop.shop.edit', compact('shop'));
        }
    }

    public function examine($id)
    {
        $shop = Shop::find($id);
        //给该用户赋值为1
        $shop->status = 1;
        //保存
        $shop->save();
        return redirect()->route("shop.shop.index");
    }


}
