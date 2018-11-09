@extends("shop.layouts.main")

@section("title","查看订单")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>订单号</th>
            <th>商品</th>
            <th>金额</th>
            <th>状态</th>
            <th>电话</th>
            <th>地址</th>
            <th>创建时间</th>

        </tr>
            <tr>
                <td>{{$show->id}}</td>
                <td>{{$show->name}}</td>
                <td>{{$show->sn}}</td>
                <td>{{$show->shop->shop_name}}</td>
                <td>{{$show->total}}</td>
                <td>
                    @if($show->status==-1) 已取消 @endif
                    @if($show->status==0) 代付款 @endif
                    @if($show->status==1) 待发货 @endif
                    @if($show->status==2) 待确认 @endif
                    @if($show->status==3) 完成 @endif
                </td>
                <td>{{$show->tel}}</td>
                <td>{{$show->provence}}{{$show->city}}{{$show->area}}</td>
                <td>{{$show->created_at}}</td>


            </tr>
    </table>



@endsection