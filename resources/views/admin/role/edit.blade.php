@extends("admin.layouts.main")
@section("title","修改角色")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="名称" value="{{old("name",$role->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">权限</label>
            <div class="col-sm-10">
                @foreach($pers as $per)
                <input type="checkbox" name="pers[]"  value="{{$per->id}}"
                @if(4==$per->id) checked @endif
                >{{$per->intro}}
                    @endforeach
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">修改</button>
            </div>
        </div>
    </form>

@endsection
