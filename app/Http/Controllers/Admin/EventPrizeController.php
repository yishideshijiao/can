<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends Controller
{
    public function index()
    {
        $prizes = EventPrize::paginate(4);
        //得到所有活动

//        dd($users);
        return view("admin.eventPrize.index", compact("prizes","events"));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $data=$this->validate($request, [
                "name" => "required",
                "description" => "required",
                "event_id" => "required",
            ]);
//dd($data);
            EventPrize::create($data);
            return redirect()->route("admin.eventPrize.index")->with("success", "添加成功");
        } else {
//得到所有活动
            $events=Event::all();

            return view("admin.eventPrize.add",compact('events'));
        }
    }

    public function del($id)
    {
        $prize=EventPrize::find($id);
        if($prize->delete()){
            return redirect()->route("admin.eventPrize.index");
        }
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $prize = EventPrize::find($id);
        if ($request->isMethod('post')) {
            //验证
            $data=$this->validate($request, [
                "name" => "required",
                "description" => "required",
                "user_id" => "required",
                "event_id" => "required",
            ]);
//            dd($data);
            if ($prize->update($data)) {
                return redirect()->route("admin.eventPrize.index");
            }
        } else {
            return view('admin.eventPrize.edit', compact('prize', 'shops'));
        }
    }
}
