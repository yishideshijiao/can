<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends BaseController
{
    public function index()
    {
        $orders=Order::paginate(3);
//        dd($orders);
        return view('shop.order.index',compact('orders'));
    }

    public function show($id)
    {
        $show=Order::find($id);
//        dd($shows);
        return view('shop.order.show',compact('show'));
        
    }

    public function remove($id)
    {
        $order=Order::find($id);
        $order->status=-1;
        $order->save();
        return redirect()->route('shop.order.index');

    }

    public function go($id)
    {
        $order=Order::find($id);
        $order->status=2;
        $order->save();
        return redirect()->route('shop.order.index');

    }
    
    
    
}
