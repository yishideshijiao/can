@extends("admin.layouts.main")

@section("title","修改分类")

@section("content")

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">类名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old("name",$cate->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">上传图片</label>
            <div class="col-sm-10">
                <input type="file" name="img">
                <img src="/{{$cate->img}}" height="80px" alt="">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">


                <label class="radio-inline">
                    <input type="radio" name="status" value="1" @if($cate->status==1) checked @endif> 显示
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0" @if($cate->status==0) checked @endif> 隐藏
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">排名</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="sort" value="{{old("sort",$cate->sort)}}">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>


@endsection