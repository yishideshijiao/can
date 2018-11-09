@extends("shop.layouts.main")

@section("title","会员信息")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
    <table class="table table-bordered">

        <tr>
            <th>id</th>
            <th>姓名</th>
            <th>电话</th>
            <th>余额</th>
            <th>积分</th>
            <th>创建时间</th>
            <th>状态</th>

        </tr>
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->money}}</td>
                <td>{{$member->jifen}}</td>
                <td>{{$member->created_at}}</td>
                <td>
                    @if($member->status==1) 启用 @endif
                    @if($member->status==0) 禁用 @endif
                </td>
            </tr>
    </table>



@endsection