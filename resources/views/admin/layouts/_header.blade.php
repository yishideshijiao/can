<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("admin.admin.index")}}">会员管理系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="#">充值</a></li>--}}
                {{--<li><a href="#">消费</a></li>--}}
                {{--<li><a href="#">消费记录显示</a></li>--}}

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.admin.index")}}">管理员列表</a></li>--}}
                        {{--<li><a href="{{route("admin.admin.add")}}">添加管理员</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.user.index")}}">用户列表</a></li>
                        <li><a href="{{route("admin.user.add")}}">添加用户</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.shopCate.index")}}">分类列表</a></li>
                        <li><a href="{{route("admin.shopCate.add")}}">添加分类</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.shop.index")}}">店铺列表</a></li>
                        <li><a href="{{route("admin.shop.add")}}">添加店铺</a></li>
                    </ul>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">

                @guest("admin")
                <li><a href="#">注册</a></li>
                <li><a href="{{route("admin.admin.login")}}">登录</a></li>
                @endguest

                @auth("admin")
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">我的资料</a></li>
                        <li><a href="#">修改资料</a></li>
                        <li><a href="{{route("admin.admin.change")}}">更换密码</a></li>
                        <li><a href="{{route("admin.admin.logout")}}">注销登录</a></li>
                    </ul>
                </li>
                @endauth

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>