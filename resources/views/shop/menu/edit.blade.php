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

            {{--<tr>--}}
                {{--<div class="form-group">--}}
                    {{--<div class="col-sm-10">--}}
                        {{--图片<input type="file" name="img">--}}
                        {{--<img src="/{{$menu->goods_img}}" height="80px" alt="">--}}
                        {{--<img src="{{env("ALIYUN_OSS_URL").$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</tr>--}}

            <tr>
                <div class="form-group">
                    <div class="col-sm-10">
                        <label>图像</label>
                        <input type="hidden" name="goods_img" value="" id="logo">
                        <!--dom结构部分-->
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                        </div>

                        <img src="{{$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80" alt="">

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

@section("js")
    <script>
        // 图片上传demo
        jQuery(function () {
            var $ = jQuery,
                $list = $('#fileList'),
                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,

                // Web Uploader实例
                uploader;

            // 初始化Web Uploader
            uploader = WebUploader.create({

                // 自动上传。
                auto: true,

                formData: {
                    // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
                    _token:'{{csrf_token()}}'
                },


                // swf文件路径
                swf: '/webuploader/Uploader.swf',

                // 文件接收服务端。
                server: '{{route("shop.menu.upload")}}',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择文件，可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            // 当有文件添加进来的时候
            uploader.on('fileQueued', function (file) {
                var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                    ),
                    $img = $li.find('img');

                $list.html($li);

                // 创建缩略图
                uploader.makeThumb(file, function (error, src) {
                    if (error) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }

                    $img.attr('src', src);
                }, thumbnailWidth, thumbnailHeight);
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                    $percent = $li.find('.progress span');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<p class="progress"><span></span></p>')
                        .appendTo($li)
                        .find('span');
                }

                $percent.css('width', percentage * 100 + '%');
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on('uploadSuccess', function (file,data) {
                $('#' + file.id).addClass('upload-state-done');

                $("#logo").val(data.url);
            });

            // 文件上传失败，现实上传出错。
            uploader.on('uploadError', function (file) {
                var $li = $('#' + file.id),
                    $error = $li.find('div.error');

                // 避免重复创建
                if (!$error.length) {
                    $error = $('<div class="error"></div>').appendTo($li);
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').remove();
            });
        });
    </script>
@stop