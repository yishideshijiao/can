<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::paginate(2);
//        dd($users);
        return view("shop.user.index", compact("users"));
    }

    public function reg(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => "required",
                'password' => "required",
                'email' => "required"
            ]);

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
//            dd($data);
            User::create($data);
            return redirect()->route("shop.user.login")->with("success", "注册成功");
        } else {
            return view("shop.user.reg");
        }

    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $this->validate($request, [
                'name' => "required",
                'password' => "required"
            ]);

            //前端不要守门员
            if (Auth::attempt($data, $request->has("remember"))) {
                return redirect()->intended(route("shop.index.index"))->with("success", "登录成功");

            } else {
                return redirect()->back()->withInput()->with("danger", "账号或密码错误");
            }

        }
        return view("shop.user.login");

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("shop.user.login");
    }

    public function add(Request $request, $id)
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
            return redirect()->route("shop.index.index")->with("success", "添加成功");
        } else {
            $shops = Shop::all();
//            dd($shops);
            return view("shop.user.add", compact("shops"));
        }
    }

    public function del($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route("shop.user.index");
        }

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
                return redirect()->route("shop.user.index");
            }
        } else {
            $shops = Shop::all();
            return view('shop.user.edit', compact('user', 'shops'));
        }
    }


}
