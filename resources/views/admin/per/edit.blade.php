@extends("admin.layouts.main")
@section("title","修改权限")
@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">路由</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="路由" value="{{old("name",$per->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">简介</label>
            <div class="col-sm-10">
                <input type="text" name="intro" class="form-control" placeholder="简介" value="{{old("intro",$per->intro)}}">
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>

@endsection
