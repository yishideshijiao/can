@extends("admin.layouts.main")
@section("title","抽奖活动列表")
@section("content")

    <a href="{{route("admin.event.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered" >

        <tr>
            <th>活动id</th>
            <th>名称</th>
            <th>开始时间</th>
            <th>奖励</th>
            <th>人限</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->start_time}}</td>
                <td>
                    @if($event->is_prize==1) <i class="glyphicon glyphicon-ok" style="color: green"></i> @endif
                    @if($event->is_prize==0) <i class="glyphicon glyphicon-remove" style="color: red"> @endif
                </td>
                <td>{{$event->num}}</td>

                <td>

                    <a href="{{route('admin.event.edit',$event->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('admin.event.del',$event->id)}}" class="btn btn-danger">删除</a>

                    <a href="{{route('admin.event.rand',$event->id)}}" class="btn btn-info">开始抽奖</a>

                    <a href="{{route('admin.event.look',$event->id)}}" class="btn btn-default">参与的用户</a>

                </td>
            </tr>
        @endforeach


    </table>
    {{$events->links()}}
@endsection
