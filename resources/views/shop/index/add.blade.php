@extends("shop.layouts.main")

@section("title","添加商铺")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
    <table border="1" class="container-fluid">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <div class="col-sm-10">
                    店铺分类ID<select name="shop_category_id" class="form-control">
                        @foreach($cates as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        名称<input type="text" class="form-control" name="shop_name" value="{{old("shop_name")}}">
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        店铺图片<input type="file" name="img">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        店公告<input type="text" class="form-control" name="notice" value="{{old("notice")}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        优惠信息<input type="text" class="form-control" name="discount" value="{{old("discount")}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        评分：<input type="number" class="form-control" name="shop_rating" value="{{old("name")}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        起送金额：<input type="number" class="form-control" name="start_send" value="{{old("start_send")}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        配送费：<input type="number" class="form-control" name="send_cost" value="{{old("send_cost")}}">
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-sm-10">
                            品牌<input type="checkbox" name="brand" value="1">
                            准时<input type="checkbox" name="on_time" value="1">
                            蜂鸟 <input type="checkbox" name="fengniao" value="1">
                            保标记 <input type="checkbox" name="bao" value="1">
                            票标记 <input type="checkbox" name="piao" value="1">
                            准标记 <input type="checkbox" name="zhun" value="1">
                            准时 <input type="checkbox" name="on_time" value="1">
                        </div>
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="col-sm-10">

                        状态：<label class="radio-inline">
                            <input type="radio" name="status" value="1" checked> 显示
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0"> 隐藏
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" value="-1"> 禁止
                        </label>
                    </div>
                </div>
            </tr>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info" style="width: 200px;height: 50px">添加</button>
                </div>
            </div>
        </form>
    </table>


@endsection