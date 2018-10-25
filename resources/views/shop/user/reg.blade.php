@extends("shop.layouts.main")
@section("title","注册用户")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户账号</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="用户账号">
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
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">注册</button>
            </div>
        </div>
    </form>

@endsection
