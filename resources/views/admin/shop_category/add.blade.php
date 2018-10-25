@extends("admin.layouts.main")

@section("title","添加分类")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">类名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old("name")}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">上传图片</label>
            <div class="col-sm-10">
                <input type="file" name="img">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">


                <label class="radio-inline">
                    <input type="radio" name="status" value="1" checked> 显示
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0"> 隐藏
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">排名</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="sort" value="{{old("sort")}}">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>


@endsection