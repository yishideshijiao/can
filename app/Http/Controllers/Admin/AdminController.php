<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends BaseController
{


    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $this->validate($request, [
                'name' => "required",
                'password' => "required"
            ]);


            if (Auth::guard("admin")->attempt($data, $request->has("remember"))) {
                return redirect()->intended(route("admin.admin.index"))->with("success", "登录成功");
            } else {
                return redirect()->back()->withInput()->with("danger", "账号或密码错误");
            }

//            dd($_POST);
        }
        return view("admin.admin.login");

    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route("admin.admin.login");
    }

    public function index()
    {
        $admins = Admin::all();
        return view("admin.admin.index", compact("admins"));

    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "email" => "required",
                "password" => "required",

            ]);

            $data = $request->post();
            $data['password'] = bcrypt($data['password']);
//            dd($data);
            Admin::create($data);
            return redirect()->route("admin.admin.index")->with("success", "添加成功");
        } else {
            return view("admin.admin.add");
        }
    }

    public function del($id)
    {
        $admin = Admin::find($id);

        if ($admin->delete()) {
            //删除他的店铺
            //删除店铺图片
            return redirect()->route("admin.admin.index");
        }

    }

    public function edit(Request $request, $id)
    {
        $admin = Admin::find($id);
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "name" => "required",
                "email" => "required",
                "password" => "required",
            ]);
            $data = $request->post();
//            dd($data);
            if ($admin->update($data)) {
                return redirect()->route("admin.admin.index");
            }
        } else {

            return view('admin.admin.edit', compact('admin'));
        }
    }

    public function change(Request $request)
    {
        if($request->isMethod("post")){
            $admin=Admin::find(Auth::guard("admin")->user()->id);
            $data=$request->post();
            $id=Auth::guard("admin")->user()->id;
//            dd($name);
            $password=bcrypt($_POST['password']);
            $admin->password=$password;
            $admin->save();
            return redirect()->route("admin.user.index")->with("success", "修改成功");

        }
        return view("admin.admin.change");

    }



}
