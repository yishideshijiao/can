@extends("shop.layouts.main")
@section("title","商品分类列表")
@section("content")

    <a href="{{route("shop.menucategory.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>分类名</th>
            <th>描述</th>
            <th>选中</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>{{$cate->describe}}</td>
                <td>
                    @if($cate->is_selected==1) <i class="glyphicon glyphicon-ok" style="color: green"></i> @endif
                    @if($cate->is_selected==0) <i class="glyphicon glyphicon-remove" style="color: red"> @endif
                </td>

                <td>
                    <a href="{{route('shop.menucategory.edit',$cate->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('shop.menucategory.del',$cate->id)}}" class="btn btn-danger">删除</a>
                    <a href="{{route('shop.menucategory.show',$cate->id)}}" class="btn btn-info">查看菜品</a>


                </td>
            </tr>
        @endforeach


    </table>
    {{--{{$cates->links()}}--}}
@endsection
