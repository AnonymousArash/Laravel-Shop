@extends('layouts.site')
@section('content')

<div style="width:100%;background:#ffffff">
<div style="padding-top:20px;"></div>

<p style="padding-right:20px;">از خرید شما سپاسگذاریم شماره تراکنش <?= $time ?></p>

<p style="color:#ff0000;padding-top:15px;padding-right:20px;">لینک محصولات خریداری شده</p>

@foreach($order as $key=>$value)


<a style="padding-right:20px;padding-top:10px;" href="{{ url('get_file?url=').$value['url'] }}">{{ $value['title'] }}</a><br>

@endforeach

<div style="padding-top:30px;"></div>
</div>

@endsection