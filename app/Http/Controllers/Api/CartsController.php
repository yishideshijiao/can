<?php

namespace App\Http\Controllers\Api;

use App\Models\Carts;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartsController extends BaseController
{
    public function add(Request $request)
    {
        //清空当前用户购物车
        Carts::where("user_id", $request->post('user_id'))->delete();
//        dd($_POST);
        //接收参数
        $goods = $request->post('goodsList');
        $counts = $request->post('goodsCount');
//        dd($goods);
        foreach ($goods as $k => $good) {
            $data = [
                'user_id' => $request->post('user_id'),
                'goods_id' => $good,
                'amount' => $counts[$k]
            ];
//            dd($data);
            Carts::create($data);
        }
        return [
            "status"=> "true",
            "message"=> "添加成功"
        ];
    }

    public function show(Request $request)
    {
        $id=$request->post('user_id');
        $carts=Carts::where("user_id",$id)->get();
//        dd("过来了");
        //声明一个数组
        $goodsList=[];
        //声明总价
        $totalCost=0;
        //循环购物车
        foreach ($carts as $k=>$v){
            $good=Menu::where("id",$v->goods_id)->first([
                'id as goods_id','goods_name','goods_img','goods_price'
            ]);
            $good->amount=$v->amount;
            //总价
            $totalCost +=$good->amount * $good->goods_price;
            $goodsList[]=$good;
        }

//        dd($goodsList);
        return [
            'goods_list'=>$goodsList,
            'totalCost'=>$totalCost
        ];
    }



}
