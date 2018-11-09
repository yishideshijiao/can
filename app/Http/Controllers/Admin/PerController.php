<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PerController extends Controller
{
    public function index()
    {
        $pers=Permission::paginate(3);
//        dd($pers);
        return view('admin.per.index',compact('pers'));
    }

    public function add(Request $request)
    {
        //声明一个空数组装所有路有名
        $urls=[];
        //得到路由
        $routes=Route::getRoutes();
//        dd($routes);
        //循环得到单个路由
        foreach ($routes as $route){
            //判断命名空间（后台的）
            if (isset($route->action["namespace"]) && $route->action["namespace"]=="App\Http\Controllers\Admin"){
                //取别名存到$urls中
                $urls[]=$route->action['as'];
            }
        }
        //从数据库取出已存在的
        $pers=Permission::pluck("name")->toArray();
        //排除已存在的路由
        $urls=array_diff($urls,$pers);

//        dd($urls);

        if ($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
//            dd($data);
            Permission::create($data);
        }
        return view('admin.per.add',compact('urls'));
    }

    public function del($id)
    {
        $per=Permission::find($id);
        if($per->delete()){
            return redirect()->route('admin.per.index')->with("success","删除成功");
        }

    }

    public function edit(Request $request,$id)
    {
        $per=Permission::find($id);
        if($request->isMethod('post')){
            $data=$request->post();
            if($per->update($data)){
                return redirect()->route('admin.per.index')->with("success","修改成功");
            }

        }else{
            return view('admin.per.edit',compact('per'));
        }

    }

}
