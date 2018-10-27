@extends("shop.layouts.main")

@section("title","修改商品")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
    <table border="1" class="container-fluid">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <tr>
            <div class="form-group">
            <div class="col-sm-10">
                商品名称<input type="text" class="form-control"  name="goods_name" value="{{old("goods_name",$menu->goods_name)}}">
            </div>
            </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        图片<input type="file" name="img">
                        <img src="/{{$menu->goods_img}}" height="80px" alt="">
                    </div>
                </div>
            </tr>

            <div class="form-group">
                <div class="col-sm-10">
                    类型id<select name="cate_id" class="form-control">
                        @foreach($cates as $cate)
                            <option value="{{$cate->id}}" @if($menu->cate_id==$cate->id) selected @endif>{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        商品内容<input type="text" class="form-control" name="goods_content" value="{{old("goods_content",$menu->goods_content)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        标题<input type="text" class="form-control" name="title" value="{{old("title",$menu->title)}}">
                    </div>
                </div>
            </tr>



            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        评分<input type="number" class="form-control" name="rating" value="{{old("rating",$menu->rating)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        商品价格<input type="number" class="form-control" name="goods_price" value="{{old("goods_price",$menu->goods_price)}}">
                    </div>
                </div>
            </tr>


            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        销量<input type="number" class="form-control" name="month_sales" value="{{old("month_sales",$menu->month_sales)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        评分比率<input type="number" class="form-control" name="rating_count" value="{{old("rating_count",$menu->rating_count)}}">
                    </div>
                </div>
            </tr>



            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        好评数<input type="number" class="form-control" name="satisfy_count" value="{{old("satisfy_count",$menu->satisfy_count)}}">
                    </div>
                </div>
            </tr>

            <tr>
                <div class="form-group">
                    <div class="col-sm-3">
                        好评率<input type="number" class="form-control" name="satisfy_rate" value="{{old("satisfy_rate",$menu->satisfy_rate)}}">
                    </div>
                </div>
            </tr>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-3">
                    <button type="submit" class="btn btn-info" style="width: 200px;height: 50px">修改</button>
                </div>
            </div>
        </form>
    </table>


@endsection