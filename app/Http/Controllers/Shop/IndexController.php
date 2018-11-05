<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    public function index()
    {

        //找到该登录的店铺
        $shopId = Auth::user()->shop->id;
//        dd($shopId);

        //订单量每日统计
        //SELECT DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums,SUM(total) FROM `orders` WHERE shop_id=3 GROUP BY date;
        $dans = Order::where("shop_id", $shopId)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();
//        dd($dans->toArray());

        $months = Order::where("shop_id", $shopId)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();
//        dd($months->toArray());


        //菜品销量
//        SELECT goods_name,SUM(amount) as count from order_goods where order_id in(43,45,46)  GROUP BY goods_id

        $cais = [];
        $orderIds = Order::where("shop_id", $shopId)->get();
        foreach ($orderIds as $orderId) {
            //获得订单详情的id集合
            $orders[] = $orderId->id;
            $cais[] = OrderGoods::where("order_id", $orderId->id)
                ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,SUM(amount) as count"))
                ->groupBy('date')
                ->get();
        }

//        dd($cais);
//为了菜品月份遍历
        $momCai = 0;
        foreach ($cais as $cai) {
            $momCai += $cai[0]['count'];
        }
//dd($momCai);
//菜品累计
        $moneyss = [];
        foreach ($orders as $order) {
            $moneyss[] = DB::table('order_goods')
                ->select(DB::raw('goods_id,amount,goods_price'))
                ->where('order_id', '=', $order)
//                ->groupBy('goods_id')
                ->get();
        }

//        dd($moneys);
        $s = [];
        //求出每样商品金额的集合
        foreach ($moneyss as $moneys) {
//    $s[]=$money->amount*$money->goods_price;
            foreach ($moneys as $money) {
                $s[] = $money->amount * $money->goods_price;
            }
        }
//运用函数求和
        $s = array_sum($s);
//dd($s);

        //整体统计

//订单量
        $danmss = Order::where("shop_id", $shopId)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums"))
            ->groupBy('date')
            ->get();
//        dd($danmss);

        $danm = Order::where("shop_id", $shopId)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,COUNT(*) as nums"))
            ->groupBy('date')
            ->get();
        $danm=$danm[0]->nums;



//菜品
        $bss = [];
        foreach ($orders as $order) {
            $bss[] = DB::table('order_goods')
                   ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums"))
                ->where('order_id', '=', $order)
                   ->groupBy('date')
                   ->get();
        }

        $bbs=[];
        foreach ($bss as $bs){
            foreach ($bs as $b){
                $bbs[] =$b->date.'有'.$b->nums.'单';
            }
        }
//        dd($bbs);



        $css = [];
        foreach ($orders as $order) {
            $css[] = DB::table('order_goods')
                ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,COUNT(*) as nums"))
                ->where('order_id', '=', $order)
                ->groupBy('date')
                ->get();
        }

        $cc=0;
        foreach ($css as $cs){
            foreach ($cs as $c){
                $cc +=$c->nums;
            }
        }
//        dd($cc);







        //判断是否有店铺
//        dd(Auth::user()->shop);
        if (Auth::user()->shop === null) {

            //跳转到添加商铺
            return redirect()->route("shop.index.add")->with("danger", "你还没有创建店铺");

        }
        return view("shop.index.index", compact('dans', 'months', 'cais', 'momCai', 'moneys', 's','danmss','danm','bbs','cc'))->with("danger", "你已有店铺");
    }

    public function add(Request $request)
    {
        $cates = ShopCategory::all();

        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);

            $data = $request->post();
            $data['shop_img'] = $request->file("img")->store("images");

            //自动绑定当前登录用户id
            $id = Auth::guard()->user()->id;
            $data["user_id"] = $id;

//            dd($data);
            Shop::create($data);
            return redirect()->route("shop.index.index")->with("success", "添加成功");
        } else {
            return view("shop.index.add", compact("cates"));
        }
    }
}
