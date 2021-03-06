@extends("admin.layouts.main")
@section("title","添加")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员账号</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="管理员账号">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" placeholder="密码">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" placeholder="邮箱">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">角色</label>
            <div class="col-sm-10">
                @foreach($roles as $role)
                <input type="checkbox" name="role[]" value="{{$role->id}}">{{$role->name}}
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
