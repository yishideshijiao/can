<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
