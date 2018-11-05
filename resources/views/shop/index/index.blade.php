@extends("shop.layouts.main")
@section("title","商家信息列表")
@section("content")



{{--  <a href="{{route("shop.index.index")}}" class="btn btn-info">我要加入店铺！</a>--}}
<a href="#" class="btn btn-info">订单量统计</a>
    <table class="table table-bordered">

            <tr>
                <th>按日统计</th>
                @foreach($dans as $dan)
                <td>{{$dan->date.'有'.$dan->nums.'单'}}</td>
                @endforeach
            </tr>
        <tr>
            <th>按月统计</th>
            @foreach($months as $month)
                <td>{{$month->date.'共'.$month->nums.'单'}}</td>
            @endforeach

        </tr>
        @foreach($months as $month)
            <th>{{'累计'.$month->money.'元'}}</th>
        @endforeach
        <tr>

        </tr>

    </table>

<a href="#" class="btn btn-info">菜品销量统计</a>
<table class="table table-bordered">

    <tr>
        <th>按日统计</th>
        @foreach($cais as $cai)
            <td> {{$cai[0]['date'].'有'.$cai[0]['count']}}样</td>
        @endforeach
    </tr>
    <tr>
        <th>按月统计</th>
            <td>{{$momCai.'单'}}</td>

    </tr>
    <th>累计{{$s}}元</th>
    <tr>

    </tr>
</table>


<a href="#" class="btn btn-info">订单量统计[按商家分别统计和整体统计]</a>
<table class="table table-bordered">

    <tr>
        <th>按日(整体统计)</th>
        @foreach($danmss as $danms)
            <td>{{$danms->date.'有'.$danms->nums}}单</td>
        @endforeach
    </tr>
    <tr>
        <th>按月(整体统计):{{$danm}}单</th>
    </tr>
</table>

<a href="#" class="btn btn-info">菜品销量统计[按商家分别统计和整体统计]</a>
<table class="table table-bordered">

    <tr>
        <th>按日(整体统计)</th>
        @foreach($bbs as $bb)
            <td>{{$bb}}</td>
            @endforeach
    </tr>
    <tr>
        <th>按月(整体统计):{{$cc}}单</th>
    </tr>
</table>




@endsection
