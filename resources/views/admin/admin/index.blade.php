@extends("admin.layouts.main")
@section("title","管理员列表")
@section("content")

    <a href="{{route("admin.admin.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered">

        <tr>
            <th>姓名</th>
            <th>邮箱</th>
            {{--<th>权限</th>--}}
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                {{--<td>--}}
{{--                    {{str_replace(['[',']','"'],'', json_encode($role->permissions()->pluck('intro'),JSON_UNESCAPED_UNICODE))}}--}}
                {{--</td>--}}

                <td>
                    <a href="{{route('admin.admin.edit',$admin->id)}}" class="btn btn-success">编辑</a>

                    @if($admin->id !==\Illuminate\Support\Facades\Auth::guard('admin')->user()->id  )
                        <a href="{{route('admin.admin.del',$admin->id)}}" class="btn btn-danger">删除</a>
                    @endif

                </td>
            </tr>
        @endforeach

    </table>

@endsection
