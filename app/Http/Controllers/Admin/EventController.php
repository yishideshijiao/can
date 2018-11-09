<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(2);
//        dd($users);
        return view("admin.event.index", compact("events"));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $data=$this->validate($request, [
                "title" => "required",
                "content" => "required",
                "num" => "required",
                "end_time" => "required",
                "start_time" => "required",
                "prize_time" => "required",
                "is_prize" => "required",
            ]);
//dd($data);

            Event::create($data);
            return redirect()->route("admin.event.index")->with("success", "添加成功");
        } else {

            return view("admin.event.add");
        }
    }

    public function del($id)
    {
        $event=Event::find($id);
        if($event->delete()){
            return redirect()->route("admin.event.index");
        }
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $event = Event::find($id);
        if ($request->isMethod('post')) {
            //验证
            $data=$this->validate($request, [
                "title" => "required",
                "content" => "required",
                "num" => "required",
                "end_time" => "required",
                "prize_time" => "required",
                "is_prize" => "required",
                "start_time" => "required",
            ]);
//            dd($data);
            if ($event->update($data)) {
                return redirect()->route("admin.event.index");
            }
        } else {
            return view('admin.event.edit', compact( 'event'));
        }
    }

    public function look(Request $request,$id)
    {
        //得到参与该活动的所有人
        $peopers=EventUser::where("event_id",$id)->get();
        //得到人名
        $mans=[];
        foreach ($peopers as $k=>$peoper){
            $mans[$k]['id']=$peoper->user_id;
//得到用户名
            $mans[$k]['name']=User::find($peoper->user_id)->name;
        }
//        dd($mans);
        return view('admin.event.look',compact('mans'));
    }

    public function rand(Request $request,$id)
    {
        //得到参与该活动的所有人
        $peopers=EventUser::where("event_id",$id)->get();
        //得到人名
        $mans=[];
        foreach ($peopers as $k=>$peoper){
            $mans[]=$peoper->user_id;
//得到用户名
//            $mans[$k]['name']=User::find($peoper->user_id)->name;
        }
        //打乱用户id
        shuffle($mans);
        dd($mans);


        //得到所有奖品id
        $prizes=EventPrize::where("event_id",$id)->get()->toArray();
        $pins=[];
        foreach ($prizes as $prize){
            $pins[]=$prize['id'];
        }
//        dd($pins);

        //有几个用户参与抽奖
        $count=count($mans);
        $shu=array_rand($mans);
        $mans[$shu];
//        dd( $mans[$shu]);

        //根据用户随机几个奖品id
        $id=array_random($pins,$count);
        dd($id);




    }
}
