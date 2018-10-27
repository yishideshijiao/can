<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuCategoryController extends BaseController
{
    public function index()
    {
        $cates = MenuCategory::all();
        return view("shop.menu_category.index", compact("cates"));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "describe" => "required",

            ]);

            $data = $request->post();

            //查询是否有分类已被选中
            $show=MenuCategory::where("is_selected",1)->count();
//            dd($show);
            if($show){
                return back()->withInput()->with("danger","只能有一种菜品类默认选中");
            }

//            dd($data);
            MenuCategory::create($data);
            return redirect()->route("shop.menucategory.index")->with("success", "添加成功");
        } else {
            return view("shop.menu_category.add");
        }
    }

    public function del($id)
    {
        $cate = MenuCategory::find($id);

        //查询该分类有几个菜品
        $count=Menu::where("cate_id",$cate->id)->count();
//        dd($count);
        if ($count){
            //回跳
            return back()->with("danger","该分类下有菜品品，不允许删除");
        }

        if ($cate->delete()) {
            return redirect()->route("shop.menucategory.index");
        }

    }

    public function edit(Request $request, $id)
    {
        $cate = MenuCategory::find($id);
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "describe" => "required",
            ]);
            $data = $request->post();
//            dd($data);

            //查询是否有分类已被选中
            $show=MenuCategory::where("is_selected",1)->count();
//            dd($show);
            if($show){
                return back()->withInput()->with("danger","只能有一种菜品类默认选中");
            }

            if ($cate->update($data)) {
                return redirect()->route("shop.menucategory.index");
            }
        } else {
            return view('shop.menu_category.edit', compact('cate'));
        }
    }

    public function show(Request $request,$id)
    {
//        $cate=Menu::all();
        $cates=Menu::where("cate_id",$id)->get();
//        dd($cate);
        return view("shop.menu_category.show",compact("cates"));

    }


}
