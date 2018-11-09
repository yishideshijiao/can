@extends("admin.layouts.main")
@section("title","添加权限")
@section("content")
    <a href="{{route("admin.per.index")}}" class="btn btn-default">返回</a>
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">路由</label>
            <div class="col-sm-10">

                <select name="name" id="" class="form-control">
                    @foreach($urls as $url)
                    <option value="{{$url}}">{{$url}}</option>
                        @endforeach
                </select>

                {{--<input type="text" name="name" class="form-control" placeholder="路由">--}}
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">简介</label>
            <div class="col-sm-10">
                <input type="text" name="intro" class="form-control" placeholder="简介">
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>

@endsection
