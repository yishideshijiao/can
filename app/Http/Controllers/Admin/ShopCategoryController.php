<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ShopCategoryController extends BaseController
{
    public function index()
    {

        $cates = ShopCategory::paginate(4);
        return view("admin.shop_category.index", compact("cates"));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "status" => "required",
                "sort" => "required",
                'img' => "required"
            ]);

            $data = $request->post();
            $data['img'] = $request->file("img")->store("images", "image");
//            dd($data);
            ShopCategory::create($data);
            return redirect()->route("admin.shopCate.index")->with("success", "添加成功");
        } else {
            return view("admin.shop_category.add");
        }
    }

    public function del($id)
    {
        $cate = ShopCategory::find($id);
        if ($cate->delete()) {
            return redirect()->route("admin.shopCate.index");
        }

    }

    public function edit(Request $request, $id)
    {
        $cate = ShopCategory::find($id);
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "status" => "required",
                "sort" => "required",
                'img' => "required"
            ]);
            $data = $request->post();
//            dd($data);
            $data['img'] = $request->file("img")->store("images", "image");
            if ($cate->update($data)) {
                return redirect()->route("admin.shopCate.index");
            }
        } else {
            return view('admin.shop_category.edit', compact('cate'));
        }
    }


}
