@extends("shop.layouts.main")
@section("title","会员列表")
@section("content")



    <div class="row">
        <div class="col-md-12">
            <form class="form-inline pull-right" method="get">

                <div class="form-group">
                    <input type="text" class="form-control" name="keyword"  placeholder="请输入会员姓名" value="{{request()->get('keyword')}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>余额</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->money}}</td>
                <td>
                    @if($member->status==1) 启用 @endif
                    @if($member->status==0) 禁用 @endif
                </td>
                <td>

                    <a href="{{route('shop.member.check',$member->id)}}" class="btn btn-info">查看</a>
                    @if($member->status==1) <a href="{{route('shop.member.forbidden',$member->id)}}" class="btn btn-danger">禁用</a>
                    @endif

                    @if($member->status==0) <a href="{{route('shop.member.useing',$member->id)}}" class="btn btn-success">启用</a>
                    @endif

                </td>
            </tr>
        @endforeach


    </table>
    {{$members->appends($url)->links()}}
@endsection
