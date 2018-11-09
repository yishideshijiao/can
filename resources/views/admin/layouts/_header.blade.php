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

@foreach(\App\Models\Nav::where("pid",0)->get() as $k1=>$v1)

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$v1->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        @foreach(\App\Models\Nav::where("pid",$v1->id)->get() as $k2=>$v2)

                        <li><a href="{{route($v2->url)}}">{{$v2->name}}</a></li>

                            @endforeach

                    </ul>
                </li>
@endforeach


            </ul>
            <ul class="nav navbar-nav navbar-right">

                @guest("admin")
                
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