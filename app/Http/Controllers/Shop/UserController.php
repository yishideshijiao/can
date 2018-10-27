<?php

namespace App\Http\Controllers\Shop;

//use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
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

                //判断是否有店铺
//        dd(Auth::user()->shop);
                if (Auth::user()->shop === null) {

                    //跳转到添加商铺
                    return redirect()->route("shop.index.add")->with("danger", "你还没有创建店铺");

                }

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
            return redirect()->route("shop.index.index")->with("success", "添加成功");
        } else {
            $shops = Shop::all();
//            dd($shops);
            return view("shop.user.add", compact("shops"));
        }
    }

    public function change(Request $request)
    {
        if ($request->isMethod("post")) {
            $id = Auth::guard()->user()->id;
//            dd($id);
            $user = User::find($id);
//            dd($user);
            $password = bcrypt($_POST['password']);
            $user->password = $password;
            $user->save();
            return redirect()->route("shop.index.index")->with("success", "修改成功");

        }
        return view("shop.user.change");

    }


}
