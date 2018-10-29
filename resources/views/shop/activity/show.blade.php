@extends("shop.layouts.main")

@section("title","活动内容")

@section("content")
    <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
    <table class="table table-bordered">
        <tr>
            <th>内容</th>
        </tr>
            <tr>
                <td>{{$show->content}}</td>

            </tr>
    </table>



@endsection