@extends("shop.layouts.main")

@section("title","用户")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old("name",$user->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" value="{{old("password",$user->password)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{old("email",$user->email)}}">
            </div>
        </div>


        {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">状态</label>--}}
        {{--<div class="col-sm-10">--}}
        {{--<label class="radio-inline">--}}
        {{--<input type="radio" name="status"  value="1" @if($user->status==1) checked @endif > 允许--}}
        {{--</label>--}}
        {{--<label class="radio-inline">--}}
        {{--<input type="radio" name="status" value="0" @if($user->status==0) checked @endif> 禁止--}}
        {{--</label>--}}
        {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <label class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-10">
                <select name="shop_id" class="form-control">
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>


@endsection