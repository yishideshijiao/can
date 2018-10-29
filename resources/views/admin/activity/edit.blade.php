@extends("admin.layouts.main")
@section("title","修改活动")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" placeholder="标题" value="{{old("title",$act->title)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
            <div class="col-sm-10">
                <textarea name="content" id="" cols="80" rows="10" placeholder="内容" >{{$act->content}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-2">
                <input type="date" name="start_time" class="form-control" placeholder="开始时间" value="{{$act->start_time}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-2">
                <input type="date" name="end_time" class="form-control" placeholder="结束时间" value="{{$act->end_time}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">活动状态</label>
            <div class="col-sm-1">
                <input type="radio" name="status" value="-1" @if($act->status==-1) checked @endif >结束
            </div>
            <div class="col-sm-1">
                <input type="radio" name="status" value="0" @if($act->status==0) checked @endif >等待
            </div>
            <div class="col-sm-1">
                <input type="radio" name="status" value="1"  @if($act->status==1) checked @endif>开启
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">修改</button>
            </div>
        </div>
    </form>

@endsection
