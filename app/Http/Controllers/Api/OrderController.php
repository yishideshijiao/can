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
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Symfony\Component\HttpFoundation\Response;

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

    public function wxPay(Request $request)
    {

        //订单ID
        $id =$request->get("id");
        //把订单找出来
        $orderModel = Order::find($id);
        //dd($id);
        //0.配置
        $options = config("wechat");
        //dd($options);
        $app = new Application($options);

        $payment = $app->payment;
        //1.生成订单

        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => '点餐平台',
            'detail'           => '点餐平台1',
            'out_trade_no'     => $orderModel->sn,
            'total_fee'        => $orderModel->total * 100, // 单位：分
            'notify_url'       => 'http://www.modalang5.cn/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//            'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];

        $order = new \EasyWeChat\Payment\Order($attributes);
//        //统一下单

        $result = $payment->prepare($order);
        //dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $codeUrl=$result->code_url;


            $qrCode = new QrCode($codeUrl);
//dd($qrCode->getContentType());
            //普通方法
            header('Content-Type: '.$qrCode->getContentType());
            exit($qrCode->writeString());


        }else{
            return $result;
        }
    }


    //微信异步通知
    public function ok()
    {
        //0.配置
        $options = config("wechat");
        //dd($options);
        $app = new Application($options);
        //1.回调
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            // $order = 查询订单($notify->out_trade_no);
            $order=Order::where("sn",$notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status==1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                //$order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;
    }

    public function status()
    {
        $id = \request()->get("id");

        $order = Order::find($id);

        return [
            "status"=>$order->status
        ];

    }



}
