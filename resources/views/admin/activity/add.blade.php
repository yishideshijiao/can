@extends("admin.layouts.main")
@section("title","新活动")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" placeholder="标题">
            </div>
        </div>


        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                //调整窗口大小
                ue.setHeight(400)
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>



        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
            <div class="col-sm-10">
                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain"></script>
            </div>
        </div>



        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-2">
                <input type="date" name="start_time" class="form-control" placeholder="开始时间">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-2">
                <input type="date" name="end_time" class="form-control" placeholder="结束时间">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">活动状态</label>
            <div class="col-sm-1">
                <input type="radio" name="status" value="-1"  >结束
            </div>
            <div class="col-sm-1">
                <input type="radio" name="status" value="0" checked >等待
            </div>
            <div class="col-sm-1">
                <input type="radio" name="status" value="1"  >开启
            </div>

        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>

@endsection
