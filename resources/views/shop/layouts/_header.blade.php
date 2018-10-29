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
            <a class="navbar-brand" href="{{route("shop.index.index")}}">会员管理系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="#">充值</a></li>--}}
                {{--<li><a href="#">消费</a></li>--}}
                {{--<li><a href="#">消费记录显示</a></li>--}}
                {{--<li><a href="">套餐管理</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.menucategory.index")}}">菜品列表</a></li>
                        <li><a href="{{route("shop.menucategory.add")}}">添加菜品</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.menu.index")}}">菜品列表</a></li>
                        <li><a href="{{route("shop.menu.add")}}">添加菜品</a></li>
                    </ul>
                </li>                                                                                <li><a href="{{route("shop.activity.index")}}">活动一览</a></li>
            </ul>
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">

                @guest()
                <li><a href="{{route("shop.user.reg")}}">注册</a></li>
                <li><a href="{{route("shop.user.login")}}">登录</a></li>
                @endguest

                @auth()
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">操作 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">我的资料</a></li>
                        <li><a href="#">修改资料</a></li>
                        <li><a href="{{route("shop.user.change")}}">更换密码</a></li>
                        <li><a href="{{route("shop.user.logout")}}">注销登录</a></li>
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                    </ul>
                </li>
                    @endauth

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>