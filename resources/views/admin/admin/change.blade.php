@extends("admin.layouts.main")
@section("title","更换密码")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">新密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" placeholder="新密码">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">确认</button>
            </div>
        </div>
    </form>

@endsection
