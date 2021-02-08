@extends('layouts.site')

@section('content')
<?php
$jdf=new \App\lib\Jdf();

$n=$product['View']+1;

DB::table('product')->where('id',$product['id'])->update(['View'=>$n]);

?>
<div style="width:100%;background:#ffffff">

   <form method="post" action="{{ url('cart') }}">
   {{ csrf_field() }}
   <input type="hidden" name="product_id" value="{{ $product['id'] }}">
   <div style="width:100%">
   <div style="padding-top:20px"></div>
   <div style="float:right;width:55%;margin-right:20px;"><img class="img2" src="{{ url('upload').'/'.$product['img'] }}"></div>
   <div style="float:right;margin-right:20px;">

   <ul>
        <li><span ><img  style="float:right;width:20px;margin-top:6px;" src="{{ url('resources/images/tick.png') }}"></span> <span style="padding-right:10px;color:#000000;">مدرس دوره : علی صدیقی</span></li><br>
        <li><span><img  style="float:right;width:20px;margin-top:5px;" src="{{ url('resources/images/tick.png') }}"></span> <span style="padding-right:10px;color:#000000;"> تعداد قسمت های دوره :  <span>{{ $product['number_files'] }}</span> </span></li><br>
        <li><span><img style="float:right;width:20px;margin-top:5px;" src="{{ url('resources/images/tick.png') }}"></span> <span style="margin-right:10px;color:#000000;"> مدت زمان کل دوره :  <span>{{ $product['files_time'] }}</span> </span></li><br>
         <li><span><img style="float:right;width:20px;margin-top:5px;" src="{{ url('resources/images/tick.png') }}"></span> <span style="margin-right:10px;color:#000000;"> حجم کل فایل های دوره : <span>{{ $product['files_size'] }}</span> </span></li>
   </ul>

   </div>

   <div style="float:right;margin-left:15px;margin-right:20px;margin-top:15px;text-align: justify;">
   {!! $product['content'] !!}
   </div>
   @if(!empty($product['price']))
    <div style="float:right;margin-left:15px;margin-right:20px;margin-top:15px;">
   <div style="padding: 10px;background:none repeat scroll 0% 0% #333;display: inline-table;color:#FFF;float:right;margin-right:10px;margin-bottom: 30px;">{{ number_format($product['price']) }} ریال</div>
 <input type="submit" name="add_product" style="background:none repeat scroll 0% 0% #FDFEFF;color:black;border:1px solid #D7DBDE;margin:10px;font-family:Yekan" value="افزودن به سبد خريد">
   </div>
   @endif

   <div style="clear:both"></div>

   </div>

  </form>
</div>


<div id="add_comment" style="width:100%;background:#ffffff;margin-top:10px;">

<p style="padding-right:30px;color:#ff0000;padding-top:15px;font-size:17px;">ارسال نظر</p>
<form method="post" action="{{ url('add_comment') }}">
<table>
 {{ csrf_field() }}
   <input type="hidden" name="product_id" value="{{ $product['id'] }}">
   <input type="hidden" name="parent_id" value="0" id="answer" />
 <tr>
 <td colspan="2"><p style="padding-right:30px;" id="answer_box">
 @if(Session::has('create'))
 {{ 'نظر شما با موفقيت ثبت و بعد از تاييد مدير سايت نمايش داده خواهد شد' }}
 @endif
 </p></td>
 </tr>
 <tr>
 <td><input value="{{ old('name') }}"  type="text" name="name" placeholder="نام" style="border:1px solid #eeeff1;font-size:13px;margin-right:30px;height:30px;width:300px;margin-top:20px;padding-right:15px;font-family:Yekan;margin-left:0px;" ></td>
 <td>
 @if($errors->has('name'))
 <span style="color:#ff0000;">{{ $errors->first('name') }}</span>
 @endif
 </td>
 </tr>

 <tr>
  <td><input type="text" name="email" value="{{ old('email') }}" placeholder="ايميل" style="border:1px solid #eeeff1;font-size:13px;margin-right:30px;height:30px;width:300px;margin-top:20px;padding-right:15px;font-family:Yekan" ></td>
  <td>
   @if($errors->has('email'))
   <span style="color:#ff0000">{{ $errors->first('email') }}</span>
   @endif
  </td>
  </tr>



    <tr>
        <td colspan="2"><textarea name="comment" style="border:1px solid #eeeff1;margin-right:30px;height:150px;resize:none;width:550px;font-size:13px;margin-top:20px;padding-right:15px;font-family:Yekan" placeholder="نظر شما">{{ old('comment') }}</textarea></td>
    </tr>

    <tr>
    <td colspan="2">@if($errors->has('comment'))
                       <span style="color:#ff0000;padding-right:30px;">{{ $errors->first('comment') }}</span>
                       @endif</td>
    </tr>


    <tr>
    <td colspan="2"><input type="submit" style="background:#62b965;border:1px solid #62b965;font-size:13px;font-family:Yekan;color:#ffffff;width:100px;margin-right:30px;margin-top:20px;margin-bottom:20px;" value="ثبت نظر"></td>
    </tr>
</table>
</form>


</div>

<div style="width:100%;background:#ffffff;margin-top:10px;">

 <p style="color:#ff0000;padding-right:30px;padding-top:20px;padding-bottom:20px;">نظرات کاربران سايت</p>

  @if(!empty($Comment))
         @foreach($Comment as $key=>$value)
         <div style="margin:auto;width:98%;box-shadow: 0 2px 3px rgba(0, 0, 0, 0.15);">
         <div style="height: 37px;line-height: 37px;background: #e8e9eb;padding: 0 15px;border-radius: 2px 2px 0 0;font-size:14px;"><span>ارسال شده توسط : </span> <span>{{ $value['name'] }}</span><span> - </span> {{ $jdf->jdate('Y/n/j',$value['time']) }}</div>

         <div style="color: #555555;background: #f5f6f7;padding: 17px 15px 23px;font-size:14px;line-height: 25px;">
         {!! nl2br(strip_tags($value['comment'])) !!}
         <?php
         $parent=\App\Comment::where(['parent_id'=>$value['id'],'state'=>1])->orderBy('id','DESC')->get()->toArray();
         ?>
         </div>
         @foreach($parent as $key1=>$value1)

         <div style="width:92%;margin:auto">

          <p style="font-size:14px;padding-top:15px;"><span>ارسال شده توسط : </span> <span>{{ $value1['name'] }}</span><span> - </span>{{ $jdf->jdate('Y/n/j',$value1['time']) }}</p>
         <div style="width:100%;margin-top:5px;border:1px solid #eeeff1;"></div>
          <div style="font-size:14px;padding-top:10px;padding-bottom:10px;">{!! nl2br(strip_tags($value1['comment'])) !!}</div>
         </div>
         @endforeach


         </div>
         <div style="width:98%;margin:auto"><p style="padding-right:10px;color:red;font-size:13px;padding-top:10px;cursor:pointer;padding-bottom:10px;" onclick="add_answer('<?= $value['id'] ?>','<?= $value['name'] ?>')">ارسال پاسخ به اين نظر</p></div>

         @endforeach

         <div style="width:100%;height:40px;background:#ffffff;padding-right:15px">{{ $Comment->render() }}</div>
  @else
  <p style="color:red;text-align:center;padding-top:0px;padding-bottom:50px;">تا کنون نظری بار این محصول ثبت نشده است</p>
  @endif



<div style="padding-top:20px;"></div>
</div>

@endsection

@section('footer')
<script>
add_answer=function(id,name)
{
  document.getElementById('answer').value=id;
   var msg='ارسال پاسخ به '+name;
   $("#answer_box").html(msg);
   window.location='#add_comment';
}
</script>
@endsection