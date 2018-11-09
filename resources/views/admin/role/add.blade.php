@extends("admin.layouts.main")
@section("title","添加角色")
@section("content")

    <a href="{{route("admin.role.index")}}" class="btn btn-default">角色列表</a>
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="名称">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">权限</label>
            <div class="col-sm-10">
                @foreach($pers as $per)
                <input type="checkbox" name="pers[]"  value="{{$per->id}}">{{$per->intro}}
                    @endforeach
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>

@endsection
