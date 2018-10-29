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
use Illuminate\Support\Facades\Hash;

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
            //运用哈希
            //1.验证
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|confirmed'
            ]);

            //得到当前用户对象
            $admin=Auth::guard('admin')->user();
            $oldPassword=$request->post('old_password');
            //判断对错
            if(Hash::check($oldPassword,$admin->password)){
                //正确，修改密码
                $admin->password=Hash::make($request->post('password'));
                //保存
                $admin->save();
//                exit;
                return redirect()->route("admin.user.index")->with("success", "修改成功");

            }
            //输入的老密码不对
            return back()->with("danger","旧密码不对");
        }
        return view("admin.admin.change");
    }


}
