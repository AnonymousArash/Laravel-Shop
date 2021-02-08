<p style="padding-right:0px;font-family:tahoma;direction:rtl;">از خرید شما سپاسگذاریم شماره تراکنش <?= $time ?></p>

<p style="color:#ff0000;padding-top:15px;padding-right:0px;font-family:tahoma;direction:rtl;">لینک محصولات خریداری شده</p>



@foreach($order as $key=>$value)


<a style="padding-right:0px;padding-top:10px;font-family:tahoma;direction:rtl;text-decoration:none;float:right" href="{{ url('get_file?url=').$value['url'] }}">{{ $value['title'] }}</a><br>

@endforeach
<br>
<p style="padding-right:0px;font-family:tahoma;direction:rtl;padding-top:20px;">شرکت ایده پردازان جوان آذربایجان</p>
