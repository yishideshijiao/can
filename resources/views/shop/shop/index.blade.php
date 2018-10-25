@extends("shop.layouts.main")
@section("title","商家信息列表")
@section("content")

    <a href="{{route("shop.shop.add")}}" class="btn btn-info">添加</a>
    <table class="table">

        <tr>
            <th>id</th>
            <th>分类id</th>
            <th>名称</th>
            <th>店铺图片</th>
            <th>状态</th>

            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->cate->name}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>
                    <img src="/{{$shop->shop_img}}" height="80px" alt="">
                </td>
                <td>
                    @if($shop->status==1 )
                        已上线
                    @endif

                    @if($shop->status==0 )
                        未审核
                    @endif

                    @if($shop->status==-1 )
                        禁止上线
                    @endif
                </td>

                <td>

                    <a href="{{route('shop.shop.edit',$shop->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('shop.shop.del',$shop->id)}}" class="btn btn-danger">删除</a>
                    @if($shop->status==0 ||$shop->status==-1 )
                        <a href="{{route('shop.shop.examine',$shop->id)}}" class="btn btn-primary">允许上线</a>
                    @endif


                </td>
            </tr>
        @endforeach


    </table>
    {{$shops->links()}}
@endsection
