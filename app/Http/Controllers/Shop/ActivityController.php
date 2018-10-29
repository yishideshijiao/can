<?php

namespace App\Http\Controllers\Shop;

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

        return view("shop.activity.index",compact("acts","url"));
    }

    public function show($id)
    {
        $show=Activity::find($id);
        return view("shop.activity.show",compact("show"));

    }
}
