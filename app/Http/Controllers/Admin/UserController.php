<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{

    public function index()
    {
        $users = User::paginate(2);
//        dd($users);
        return view("admin.user.index", compact("users"));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required|unique:users",
                "email" => "required",
                "password" => "required",

            ]);

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            User::create($data);
            return redirect()->route("admin.user.index")->with("success", "添加成功");
        } else {
            $shops = Shop::all();
//            dd($shops);
            return view("admin.user.add", compact("shops"));
        }
    }

    public function del($id)
    {
//        $id=Shop::where("shop_category_id", $id)->count();
//        dd($id);
        //事务
        DB::transaction(function () use ($id) {
            //1.删除用户
//            User::findOrFail($id)->delete();
            //查到他的店（默认1对1）
            $cate = Shop::where("user_id", $id)->get();
//            dd($cate);
            @unlink($cate[0]->shop_img);
            //2.删除对应店铺
            Shop::where("user_id", $id)->delete();
        });


            return redirect()->route("admin.user.index");


    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "email" => "required",
                "password" => "required",
            ]);
            $data = $request->post();
//            dd($data);
            if ($user->update($data)) {
                return redirect()->route("admin.user.index");
            }
        } else {
            $shops = Shop::all();
            return view('admin.user.edit', compact('user', 'shops'));
        }
    }

    public function jia(Request $request,$id)
    {

        $cates=ShopCategory::all();
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);

            $data = $request->post();
            $data['shop_img'] = $request->file("img")->store("images");

            //自动绑定当前登录用户id

            $data["user_id"] = $id;

//            dd($data);
            Shop::create($data);
            return redirect()->route("admin.user.index")->with("success", "添加成功");
        }

        return view("admin.jia.jia",compact("cates"));

    }




}
