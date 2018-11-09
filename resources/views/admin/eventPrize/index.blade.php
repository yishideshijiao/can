@extends("admin.layouts.main")
@section("title","奖品列表")
@section("content")

    <a href="{{route("admin.eventPrize.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered" >

        <tr>
            <th>活动</th>
            <th>活动名字</th>
            <th>获奖用户</th>
            <th>操作</th>
        </tr>
        @foreach($prizes as $prize)
            <tr>
                <td>{{$prize->event->id}}</td>
                <td>{{$prize->name}}</td>
                <td>{{$prize->user_id}}</td>

                <td>

                    <a href="{{route('admin.eventPrize.edit',$prize->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('admin.eventPrize.del',$prize->id)}}" class="btn btn-danger">删除</a>


                </td>
            </tr>
        @endforeach


    </table>
    {{$prizes->links()}}
@endsection
