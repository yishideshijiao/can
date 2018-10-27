@extends("shop.layouts.main")
@section("title","菜品列表")
@section("content")

    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>

    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>菜品名</th>
            <th>菜品图片</th>
            <th>价格</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->goods_name}}</td>
                <td>
                    <img src="/{{$cate->goods_img}}" height="80px" alt="">
                </td>
                <td>{{$cate->goods_price}}</td>

            </tr>
        @endforeach


    </table>
    {{--{{$cates->links()}}--}}
@endsection
