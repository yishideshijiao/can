@extends("admin.layouts.main")
@section("title","角色列表")
@section("content")

    <a href="{{route("admin.role.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered" >

        <tr>
            <th>id</th>
            <th>角色</th>
            <th>已有权限</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>
                    {{str_replace(['[',']','"'],'', json_encode($role->permissions()->pluck('intro'),JSON_UNESCAPED_UNICODE))}}
                    {{--获得路由--}}
{{--                    {{str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}--}}
                </td>
                <td>

                    <a href="{{route('admin.role.edit',$role->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('admin.role.del',$role->id)}}" class="btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach


    </table>
    {{$roles->links()}}
@endsection
