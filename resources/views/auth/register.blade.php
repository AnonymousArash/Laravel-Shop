@extends('layouts.site')

@section('content')

<div id="right_box">


<div class="product_box" style="margin-top:20px;">

<div class="product_box_title">

<p style="padding-right:15px;padding-top:5px;">ثبت نام در سایت</p>

</div>
<div class="line"></div>
<div class="product_text">
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
{{ csrf_field() }}
<table>


<tr>
<td style="padding-top:17px;">نام : </td>
<td style="padding-right:15px;">
<input id="name" type="text" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="name" value="{{ old('name') }}">
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;">
@if ($errors->has('name'))
<span class="help-block">
{{ $errors->first('name') }}
</span>
@endif
</td>
</tr>


<tr>
<td style="padding-top:17px;">نام خانوادگی : </td>
<td style="padding-right:15px;">
<input id="fname" type="text" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="fname" value="{{ old('fname') }}">
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;">
@if ($errors->has('fname'))
<span class="help-block">
{{ $errors->first('fname') }}
</span>
@endif
</td>
</tr>


<tr>
<td style="padding-top:17px;">ایمیل : </td>
<td style="padding-right:15px;">
<input id="fname" type="text" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="email" value="{{ old('email') }}">
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;">
@if ($errors->has('email'))
<span class="help-block">
{{ $errors->first('email') }}
</span>
@endif
</td>
</tr>


<tr>
<td style="padding-top:17px;">کلمه عبور : </td>
<td style="padding-right:15px;">
<input type="password" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="password" >
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;">
@if ($errors->has('password'))
<span class="help-block">
{{ $errors->first('password') }}
</span>
@endif
</td>
</tr>


<tr>
<td style="padding-top:17px;">تکرار کلمه عبور : </td>
<td style="padding-right:15px;">
<input type="password" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="password_confirmation" >
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;">
@if ($errors->has('password_confirmation'))
<span class="help-block">
{{ $errors->first('password_confirmation') }}
</span>
@endif
</td>
</tr>

<tr>
<td colspan="3">

</td>
</tr>


<tr>
<td colspan="3" style="padding-top:20px;">
<input type="submit" value="ثبت نام">
</td>
</tr>

</table>
</form>

</div>



<div style="clear:both;padding-top:40px;"></div>

</div>

</div>

<div id="left_box">

 <div class="menu_box">
         <div class="menu_box_title">
                <p style="margin-right:20px;padding-top:5px;">نماد اعتماد به سایت</p>
         </div>
         <div class="line" style="margin-top:5px;"></div>
         <div style="float:right">
         </div>

 </div>


</div>
@endsection
