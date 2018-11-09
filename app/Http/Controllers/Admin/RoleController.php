<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            //1.接收参数 并处理数据
            $pers=$request->post('pers');
            //2.添加角色
            $role=Role::create([
                "name"=>$request->post("name"),
                "guard_name"=>"admin"
            ]);
            //3. 给角色同步权限
            if ($pers){
                $role->syncPermissions($pers);

            }
        }
        //得到所有权限
        $pers = Permission::all();
        return view("admin.role.add",compact("pers"));
    }

    public function index()
    {
        $roles=Role::paginate(3);
//        dd($pers);
        return view('admin.role.index',compact('roles'));
    }


    public function edit(Request $request,$id)
    {
        $role=Role::find($id);
        if($request->isMethod('post')){
            //1.接收参数 并处理数据
            $pers=$request->post('pers');
//            dd($pers);

//            $data=$request->post();

            //2.添加角色
            $role->update([
                "name"=>$request->post("name"),
                "guard_name"=>"admin"
            ]);

            //3. 给角色同步权限
            if ($pers){
                $role->syncPermissions($pers);
            }
            return redirect()->route('admin.role.index')->with("success","修改成功");

        }else{

            //获取所有权限
            $pers=Permission::all();

            return view('admin.role.edit',compact('role','pers'));
        }

    }

    public function del($id)
    {
        $role=Role::find($id);
        if($role->delete()){
            return redirect()->route('admin.role.index')->with("success","删除成功");
        }

    }

}
