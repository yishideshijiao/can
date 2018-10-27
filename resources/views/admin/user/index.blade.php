@extends("admin.layouts.main")
@section("title","商家分类列表")
@section("content")

    <a href="{{route("admin.user.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered" >

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
                <td>
                    @if($user->shop) {{$user->shop->shop_name}} @endif

                </td>
                <td>

                    <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('admin.user.del',$user->id)}}" class="btn btn-danger">删除</a>

                    @if(!$user->shop)
                    <a href="{{route('admin.jia.jia',$user->id)}}" class="btn btn-primary">添加店铺</a>
                    @endif


                </td>
            </tr>
        @endforeach


    </table>
    {{$users->links()}}
@endsection
