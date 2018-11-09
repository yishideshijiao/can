<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    public function index(Request $request)
    {
        $url=$request->query();
        //接受地址参数
        $keyword=$request->get("keyword");
        $query = Member::orderBy("id","desc");
        if($keyword !== null){
            $query->where("username","like","%{$keyword}%");
        }
        $members=$query->paginate(3);
        return view('shop.member.index',compact('members','url'));
    }

    public function forbidden($id)
    {
        $member=Member::find($id);
        $member->status=0;
        $member->save();
        return redirect()->route('shop.member.index');

    }

    public function useing($id)
    {
        $member=Member::find($id);
        $member->status=1;
        $member->save();
        return redirect()->route('shop.member.index');

    }


    public function check($id)
    {
        $member=Member::find($id);
        return view('shop.member.show',compact('member'));

    }
}
