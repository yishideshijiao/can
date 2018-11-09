<?php

namespace App\Http\Controllers\Api;

use App\Models\Adress;
use App\Models\Carts;
use App\Models\Member;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\Order_goods;
use App\Models\OrderGoods;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;


class OrderController extends BaseController
{
    public function add(Request $request)
    {
        //找出收货地址
        $adress = Adress::find($request->post('address_id'));
        //判断地址是否存在
        if ($adress == null) {
            return [
                "status" => "false",
                "message" => "地址不对"
            ];
        }
        //构造参数
        $data['provence'] = $adress->provence;
        $data['city'] = $adress->city;
        $data['area'] = $adress->area;
        $data['detail_address'] = $adress->detail_address;
        $data['tel'] = $adress->tel;
        $data['name'] = $adress->name;
//        dd($data);


        //赋值
        //用户id
        $data['user_id'] = $request->post('user_id');
        //找出购物车中商品
        $carts = Carts::where("user_id", $request->post('user_id'))->get();
        //从第一件商品找到菜类id
        $cateId = Menu::find($carts[0]->goods_id)->cate_id;
        //从菜类找到商品id
        $shopId = MenuCategory::find($cateId)->shop_id;
        $data['shop_id'] = $shopId;

        //生成订单号
        $data['sn'] = date("ymdHis");
        //设总额
        $total = 0;
        foreach ($carts as $k => $v) {
            $good = Menu::where('id', $v->goods_id)->first();
            //算总额
            $total += $v->amount * $good->goods_price;
        }
        $data['total'] = $total;
        $data['status'] = 0;

        //建订单
        $order = Order::create($data);

        //给商家用户发送邮件


        $ding=Order::where("user_id",$data['user_id'])->first();
        //得到订单商品id
        $pin=$ding->shop_id;
        //找到店铺
        $dian=Shop::where("id",$pin)->first();
//        dd($dian);
        //找到商家该用户
        $yong=$dian->user_id;
        //得到邮箱
        $you=User::where("id",$yong)->first()->email;
        $ming=User::where("id",$yong)->first()->name;
//        dd($you);
        //调用发邮件函数
        //$content = 'test';//邮件内容
        $shopName=$ming;
        $to = $you;//收件人
        $subject = $shopName.' 新订单通知';//邮件标题
        \Illuminate\Support\Facades\Mail::send(
            'admin.emails.order',//视图
            compact("shopName"),//传递给视图的参数
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );




//            添加订单商品
        foreach ($carts as $k1 => $v1) {
            //找出当前商品
            $good = Menu::find($v1->goods_id);
            //构造数据
            $dataGoods['order_id'] = $order->id;
            $dataGoods['goods_id'] = $v1->goods_id;
            $dataGoods['amount'] = $v1->amount;
            $dataGoods['goods_name'] = $good->goods_name;
            $dataGoods['goods_img'] = $good->goods_img;
            $dataGoods['goods_price'] = $good->goods_price;

            //数据入库
            OrderGoods::create($dataGoods);
        }
//            dd($dataGoods);
        //清空当前用户购物车
        Carts::where("user_id", $request->post('user_id'))->delete();
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

    }


    public function detail(Request $request)
    {
        $order = Order::find($request->input('id'));
        $data['id'] = $order->id;
        $data['order_code'] = $order->sn;
        $data['order_birth_time'] = (string)$order->created_at;
        $data['order_status'] = $order->order_status;
        $data['shop_id'] = $order->shop_id;
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['goods_list'] = $order->goods;
        return $data;
    }

    public function index(Request $request)
    {
        $orders = Order::where("user_id", $request->input('user_id'))->get();
//        dd($orders);
        $datas = [];
        foreach ($orders as $order) {
            $data['id'] = $order->id;
            $data['order_code'] = $order->sn;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] = $order->order_status;
            $data['shop_id'] = $order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->goods;
            $datas[] = $data;
        }
//        dd($data['goods_list']);
        return $datas;
    }



    public function pay(Request $request)
    {
        // 得到订单
        $order = Order::find($request->post('id'));
        $ding = Order::find($request->post('id'))->first()->user_id;
        //找到订餐会员
        $hui=Member::where("id",$ding)->first();
        //得到电话
        $tel=$hui->tel;
//        dd($tel);
        $name='您有新的点餐订单，谢谢支持。';


        //得到用户
        $member = Member::find($order->user_id);
//        dd($member);
        //判断钱够不够
        if ($order->total > $member->money) {
            return [
                'status' => 'false',
                "message" => "用户余额不够，请充值"
            ];
        }
        //否则扣钱
        $member->money = $member->money - $order->total;
        $member->save();
        //更改订单状态
        $order->status = 1;

        if($order->save()){

            //发短信通知用户
            $config = [
                'access_key' => env("ALIYUNU_ACCESS_ID"),//appID
                'access_secret' => env("ALIYUNU_ACCESS_KEY"),//appKey
                'sign_name' => '技术文章分享',//签名
            ];
            $sms = new AliSms();

            $response = $sms->sendSms($tel, 'SMS_150577180', ['name'=> $name], $config);


        }

        return [
            'status' => 'true',
            "message" => "支付成功"
        ];
    }



}
