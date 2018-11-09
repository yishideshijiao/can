<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(2);
//        dd($users);
        //获得该用户所有活动的id

        return view("shop.event.index", compact("events"));
    }

    public function add(Request $request,$id)
    {

        //判断该用户是否已参加
        if (!$a=EventUser::where('event_id',$id)->first()){
            //得到抽奖活动id
            $data['event_id']=$id;
            //得到该商家用户id
            $data['user_id']=Auth::guard()->user()->id;
            //添加到中间表
            if (EventUser::create($data)){
                return redirect()->route("shop.event.index")->with("success","报名成功");
        }

        }else{
            return redirect()->back()->with("danger","你已参加该活动，无需重复参加");
        }
    }

    public function show($id)
    {

        //得到获奖用户id
        $users=EventPrize::where("event_id",$id)->get();
//        dd($user);
        return view("shop.event.show",compact("users"));

    }

}
