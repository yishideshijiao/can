<?php

namespace App\Http\Controllers\Api;

use App\Models\Adress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdressController extends BaseController
{
    public function index()
    {
        $user_id=$_GET['user_id'];
        $adress=Adress::where("user_id",$user_id)->get();
//        dd($adress);
//        $adress = Adress::all();
//        dd($adress);

        foreach ($adress as $k=>$v){
            $adress[$k]=$v;
        }
        return $adress;

//dd($adress);

    }

    public function add(Request $request)
    {
        $data=$request->all();
        //判定健壮性
        $data = $this->validate($request, [
            "name" => "required|unique:adresses",
            "provence" => "required",
            "city" => "required",
            "area" => "required",
            "detail_address" => "required",
            "tel" => "required",
        ]);
//        dd($data);
        $data['user_id'] = $_POST['user_id'];

        Adress::create($data);
        $data = [
            "status" => "true",
            "message" => "添加成功"
        ];
        return $data;

    }

    public function edit(Request $request)
    {
        $id=$_POST['id'];
        $adress=Adress::find($id);
//        dd($adress);
        $data=$request->post();
        //判定健壮性
//        $data = $this->validate($request, [
//            "name" => "required|unique:adresses",
//            "provence" => "required",
//            "city" => "required",
//            "area" => "required",
//            "detail_address" => "required",
//            "tel" => "required",
//        ]);
//        dd($data);
        $adress->update($data);
        $data = [
            "status" => "true",
            "message" => "修改成功"
        ];
        return $data;

    }

    public function del(Request $request)
    {
//        return 11;
        $id=$_GET['id'];
//        dd($id);
        Adress::find($id);



    }
}
