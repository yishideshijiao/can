@extends("admin.layouts.main")
@section("title","活动列表")
@section("content")



    <div class="row">
        <div class="col-md-12">
            <a href="{{route("admin.activity.add")}}" class="btn btn-info">添加</a>
            <form class="form-inline pull-right" method="get">

                <div class="form-group">
                    <select name="status" id="" class="form-control" >
                        <option value="">请选择状态</option>
                        <option value="1" >正在进行</option>
                        <option value="0" >还未开启</option>
                        <option value="-1" >往期活动</option>

                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="keyword"  placeholder="请输入活动名称" value="{{request()->get('keyword')}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">

        <tr>
            <th>标题</th>
            <th>内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($acts as $act)
            <tr>
                <td>{{$act->title}}</td>
                <td>{{$act->content}}</td>
                <td>{{$act->start_time}}</td>
                <td>{{$act->end_time}}</td>

                <td>
                    <a href="{{route('admin.activity.edit',$act->id)}}" class="btn btn-success">编辑</a>

                        <a href="{{route('admin.activity.del',$act->id)}}" class="btn btn-danger">删除</a>


                </td>
            </tr>
        @endforeach

    </table>
    {{$acts->appends($url)->links()}}

@endsection
