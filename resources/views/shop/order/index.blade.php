@extends("shop.layouts.main")
@section("title","活动列表")
@section("content")



    <div class="row">
        <div class="col-md-12">
            <form class="form-inline pull-right" method="get">

                <div class="form-group">
                    <input type="text" class="form-control" name="keyword"  placeholder="请输入订单时间" value="{{request()->get('keyword')}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>商品</th>
            <th>订单号</th>
            <th>创建时间</th>
            <th>物流</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->shop->shop_name}}</td>
                <td>{{$order->sn}}</td>
                <td>{{$order->created_at}}</td>
                <td>
                    @if($order->status==-1) 已取消 @endif
                    @if($order->status==0) 代付款 @endif
                    @if($order->status==1) 待发货 @endif
                    @if($order->status==2) 待确认 @endif
                    @if($order->status==3) 完成 @endif
                </td>

                <td>
                    <a href="{{route('shop.order.show',$order->id)}}" class="btn btn-info">查看订单</a>
                    @if($order->status != -1)
                        <a href="{{route('shop.order.remove',$order->id)}}" class="btn btn-danger">取消订单</a>
                    @endif
                    @if($order->status ==1)
                    <a href="{{route('shop.order.go',$order->id)}}" class="btn btn-success">发货</a>
                        @endif

                </td>
            </tr>
        @endforeach

    </table>
    {{$orders->links()}}

@endsection
