@extends("admin.layouts.main")

@section("title","抽奖添加")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" value="{{old("title")}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">抽奖内容</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="content" value="{{old("content")}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">人数限制</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="num" value="{{old("num")}}">
            </div>
        </div>





        <div class="form-group">
            <label class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="start_time" value="{{old("start_time")}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="end_time" value="{{old("end_time")}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="prize_time" value="{{old("prize_time")}}">
            </div>
        </div>


        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">开奖</label>

            <div class="col-sm-1">
                <input type="radio" name="is_prize" value="0" checked >不开
            </div>
            <div class="col-sm-1">
                <input type="radio" name="is_prize" value="1"  >开
            </div>

        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>


@endsection