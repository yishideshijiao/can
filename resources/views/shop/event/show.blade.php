@extends("admin.layouts.main")
@section("title","获奖列表")
@section("content")

    <table class="table table-bordered" >
        <a href="javascript:history.go(-1)" class="btn btn-info">返回</a>

        <tr>
            <th>获奖用户</th>
            <th>获奖奖品</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->user_id}}</td>
                <td>{{$user->name}}</td>


            </tr>
        @endforeach


    </table>
@endsection
