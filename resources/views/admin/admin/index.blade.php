@extends("admin.layouts.main")
@section("title","管理员列表")
@section("content")

    <a href="{{route("admin.admin.add")}}" class="btn btn-info">添加</a>
    <table class="table">

        <tr>
            <th>姓名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>

                <td>
                    <a href="{{route('admin.admin.edit',$admin->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('admin.admin.del',$admin->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>

@endsection
