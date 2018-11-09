@extends("admin.layouts.main")
@section("title","参与用户")
@section("content")
<h3>参与抽奖的用户:</h3>
    <table class="table table-bordered" >

        <tr>
            <th>用户id</th>
            <th>姓名</th>
        </tr>
        @foreach($mans as $man)
            <tr>
                <td>{{$man['id']}}</td>
                <td>{{$man['name']}}</td>


            </tr>
        @endforeach


    </table>
@endsection
