<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    public function index(Request $request)
    {
        $url=$request->query();
        //接收地址参数
        $status=$request->get("status");
        $keyword=$request->get("keyword");
//        dd($keyword);


        $query=Activity::orderBy("id");
//        dd($url);

        if($keyword != null){
            $query->where("title","like","%{$keyword}%");
        }

        if($status !=null){
            $query->where("status",$status);
        }

        $acts=$query->paginate(4);

        return view("admin.activity.index",compact("acts","url"));

    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "title" => "required",
                "content" => "required",
                "start_time" => "required",
                "end_time" => "required",
            ]);
            $data=$request->post();
//            dd($data);
            Activity::create($data);
            return redirect()->route("admin.activity.index")->with("success", "添加成功");
        } else {
            return view("admin.activity.add");
        }
    }

    public function del($id)
    {
        $admin = Activity::find($id);

        if ($admin->delete()) {
            return redirect()->route("admin.activity.index");
        }

    }

    public function edit(Request $request, $id)
    {
        $act = Activity::find($id);
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                "title" => "required",
                "content" => "required",
                "start_time" => "required",
                "end_time" => "required",
            ]);
            $data = $request->post();
//            dd($data);
            if ($act->update($data)) {
                return redirect()->route("admin.activity.index");
            }
        } else {

            return view('admin.activity.edit', compact('act'));
        }
    }
}
