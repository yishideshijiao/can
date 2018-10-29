@extends("shop.layouts.main")
@section("title","商品信息列表")
@section("content")

    <div class="row">
        <div class="col-md-4">
            <a href="{{route("shop.menu.add")}}" class="btn btn-info">添加</a>
        </div>

        <div class="col-md-8">
            <form class="form-inline pull-right" method="get">

                <div class="form-group">
                    <select name="cate_id" id="" class="form-control" >
                        <option value="">请选择分类</option>
@foreach($leis as $lei)
                        <option value="{{$lei->id}}" @if($lei->id==request()->get("cate_id")) selected @endif >{{$lei->name}}</option>
@endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="goods_min"  placeholder="最低价" size="5" value="{{request()->get("goods_min")}}">
                </div>
                -
                <div class="form-group">
                    <input type="text" class="form-control"  name="goods_max" placeholder="最高价" size="5" value="{{request()->get("goods_max")}}">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="keyword"  placeholder="请输入商品名称" value="{{request()->get('keyword')}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>





    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>商品名称</th>
            <th>分类id</th>
            <th>图片</th>
            <th>价格</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->cate->name}}</td>
                {{--webupload图片--}}
                <td><img src="{{$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80" alt=""></td>
                {{--本机--}}
                    {{--<img src="/{{$menu->goods_img}}" height="80px" alt="">--}}
                {{--码云图片上传--}}
                {{--<td><img src="{{env("ALIYUN_OSS_URL").$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80"></td>--}}

                <td>{{$menu->goods_price}}</td>


                <td>

                    <a href="{{route('shop.menu.edit',$menu->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route('shop.menu.del',$menu->id)}}" class="btn btn-danger">删除</a>


                </td>
            </tr>
        @endforeach


    </table>
    {{$menus->appends($url)->links()}}
@endsection
