@extends("shop.layouts.main")
@section("title","商家分类列表")
@section("content")

    <a href="{{route("shop.user.add")}}" class="btn btn-info">添加</a>
    <table class="table">

        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->shop->shop_name}}</td>
                <td>

                    <a href="{{route('shop.user.edit',$user->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('shop.user.del',$user->id)}}" class="btn btn-danger">删除</a>

                    {{--@if($user->status==0)--}}
                    {{--<a href="{{route('shop.user.examine',$user->id)}}" class="btn btn-primary">允许上线</a>--}}
                    {{--@endif--}}


                </td>
            </tr>
        @endforeach


    </table>
    {{$users->links()}}
@endsection
