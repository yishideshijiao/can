@extends("admin.layouts.main")

@section("title","奖品添加")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">活动id</label>
            <div class="col-sm-10">

                <select name="event_id" id="" class="form-control">
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->title}}</option>
                    @endforeach
                </select>


                {{--<input type="text" class="form-control" name="event_id" value="{{old("event_id")}}">--}}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">奖品名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old("name")}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">奖品详情</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old("description")}}">
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label class="col-sm-2 control-label">中奖用户</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="text" class="form-control" name="user_id" value="{{old("user_id")}}">--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>


@endsection