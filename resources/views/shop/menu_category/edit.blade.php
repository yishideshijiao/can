@extends("shop.layouts.main")

@section("title","修改分类")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">类名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old("name",$cate->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="describe" value="{{old("describe",$cate->describe)}}">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">


                <label class="radio-inline">
                    <input type="radio" name="is_selected" value="1" @if($cate->is_selected==1) checked @endif> 选中
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_selected" value="0" @if($cate->is_selected==0) checked @endif> 无
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>


@endsection