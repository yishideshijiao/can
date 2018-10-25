@extends("admin.layouts.main")
@section("title","商家分类列表")
@section("content")

    <a href="{{route("admin.shopCate.add")}}" class="btn btn-info">添加</a>
    <table class="table">

        <tr>
            <th>id</th>
            <th>分类名</th>
            <th>图片</th>
            <th>状态</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>
                    <img src="/{{$cate->img}}" height="80px" alt="">
                </td>
                <td>{{$cate->status==1?'显示':'隐藏'}}</td>
                <td>{{$cate->sort}}</td>

                <td>
                    <a href="{{route('admin.shopCate.edit',$cate->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('admin.shopCate.del',$cate->id)}}" class="btn btn-danger">删除</a>


                </td>
            </tr>
        @endforeach


    </table>
    {{$cates->links()}}
@endsection
