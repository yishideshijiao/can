@extends("shop.layouts.main")

@section("title","修改商铺")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>
    <table border="1" class="container-fluid">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        店铺分类ID<input type="text" class="form-control" name="shop_category_id"
                                     value="{{old("shop_category_id",$shop->shop_category_id)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        名称<input type="text" class="form-control" name="shop_name"
                                 value="{{old("shop_name",$shop->shop_name)}}">
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        店铺图片<input type="file" name="img">
                        <img src="/{{$shop->shop_img}}" height="80px" alt="">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        店公告<input type="text" class="form-control" name="notice"
                                  value="{{old("notice",$shop->notice)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        优惠信息<input type="text" class="form-control" name="discount"
                                   value="{{old("discount",$shop->discount)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        评分：<input type="number" class="form-control" name="shop_rating"
                                  value="{{old("name",$shop->shop_rating)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        起送金额：<input type="number" class="form-control" name="start_send"
                                    value="{{old("start_send",$shop->start_send)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        配送费：<input type="number" class="form-control" name="send_cost"
                                   value="{{old("send_cost",$shop->send_cost)}}">
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        用户Id<input type="number" class="form-control" name="user_id"
                                   value="{{old("user_id",$shop->user_id)}}">
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-sm-10">
                            品牌<input type="checkbox" name="brand" value="1" @if($shop->brand==1) checked @endif>
                            准时<input type="checkbox" name="on_time" value="1" @if($shop->on_time==1) checked @endif>
                            蜂鸟 <input type="checkbox" name="fengniao" value="1" @if($shop->fengniao==1) checked @endif>
                            保标记 <input type="checkbox" name="bao" value="1" @if($shop->bao==1) checked @endif>
                            票标记 <input type="checkbox" name="piao" value="1" @if($shop->piao==1) checked @endif>
                            准标记 <input type="checkbox" name="zhun" value="1" @if($shop->zhun==1) checked @endif>
                            {{--准时 <input type="checkbox"   name="on_time" value="1" @if($shop->on_time==1) checked @endif>--}}
                        </div>
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="col-sm-10">

                        状态：<label class="radio-inline">
                            <input type="radio" name="status" value="1" @if($shop->status==1) checked @endif> 显示
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0" @if($shop->status==0) checked @endif> 隐藏
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" value="-1" @if($shop->status==-1) checked @endif> 禁止
                        </label>
                    </div>
                </div>
            </tr>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info" style="width: 200px;height: 50px">修改</button>
                </div>
            </div>
        </form>
    </table>


@endsection