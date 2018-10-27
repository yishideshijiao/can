<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends BaseController
{
    public function index(Request $request)
    {
        $url=$request->query();
//        dd($url);

        //接受地址参数
        $cateId=$request->get("cate_id");
        $keyword=$request->get("keyword");
        $min=$request->get("min");
        $max=$request->get("max");
//        dd($min);
//        dd($keyword);

        $query = Menu::orderBy("id","desc");

        if($keyword !== null){
            $query->where("goods_name","like","%{$keyword}%");
        }

        if($cateId != null){
            $query->where("cate_id",$cateId);
        }

        if($min != null){
            $query->where("price",">=",$min);
        }

        if($max != null){
            $query->where("price","<=",$max);
        }

        $menus=$query->paginate(3);

        $leis=MenuCategory::all();

        return view("shop.menu.index", compact("menus","leis","url"));
    }

    public function add(Request $request)
    {
        $cates = MenuCategory::all();
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);

            $data = $request->post();
            $data['goods_img'] = $request->file("img")->store("images", "image");
//            dd($data);
            Menu::create($data);
            return redirect()->route("shop.menu.index")->with("success", "添加成功");
        } else {
            return view("shop.menu.add", compact("cates"));
        }
    }

    public function del($id)
    {
        $menu = Menu::find($id);
        if ($menu->delete()) {
            //删除原来图片
            @unlink ($menu->goods_img);
            return redirect()->route("shop.menu.index");
        }

    }

    public function edit(Request $request, $id)
    {

        $menu = Menu::find($id);

//        dd($menu->goods_img);
        $cates=MenuCategory::all();
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);
            $data = $request->post();
            $img=$request->file("img");
            if ($img){
                //删除原来图片
                @unlink ($menu->goods_img);
                //赋值
                $data['goods_img'] = $request->file("img")->store("images", "image");
            }

//            dd($data);
            if ($menu->update($data)) {
                return redirect()->route("shop.menu.index");
            }
        } else {
            return view('shop.menu.edit', compact('menu','cates'));
        }
    }


}
