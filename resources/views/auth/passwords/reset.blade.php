@extends('layouts.site')

@section('content')

<div id="right_box">


<div class="product_box" style="margin-top:20px;">

<div class="product_box_title">

<p style="padding-right:15px;padding-top:5px;">بازیابی کلمه عبور</p>

</div>
<div class="line"></div>
<div class="product_text">
<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
{{ csrf_field() }}
  <input type="hidden" name="token" value="{{ $token }}">
<table>


<tr>
<td style="padding-top:17px;">ایمیل : </td>
<td style="padding-right:15px;">
<input id="name" type="text" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="email" value="{{  $email or old('email') }}">
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;font-size:13px;">
@if ($errors->has('email'))
<span class="help-block">
{{ $errors->first('email') }}
</span>
@endif

@if(Session::has('status'))
<span class="help-block">
ایمیلی جهت بازیابی کلمه عبور برای شما ارسال شد
</span>
@endif
</td>
</tr>




<tr>
<td style="padding-top:17px;">کلمه عبور: </td>
<td style="padding-right:15px;">
<input id="name" type="password" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="password" >
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;font-size:13px;">
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
<input id="name" type="password" style="border:1px solid #eeeff1;font-size:13px;height:30px;width:250px;margin-top:20px;padding-right:5px;font-family:Yekan;margin-left:0px;" name="password_confirmation">
</td>
<td style="padding-right:20px;color:#ff0000;padding-top:17px;font-size:13px;">
@if ($errors->has('password_confirmation'))
<span class="help-block">
{{ $errors->first('password_confirmation') }}
</span>
@endif

</td>
</tr>

<tr>
<td colspan="3" style="padding-top:20px;">
<input type="submit" value="کلمه عبور جدید">
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
                <p style="margin-right:20px;padding-top:5px;">ورود به سایت</p>
         </div>
         <div class="line" style="margin-top:5px;"></div>
         <div>

         @if(!Auth::check())
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                 {{ csrf_field() }}
          <table>
          <tr>
          <td colspan="2" style="color:red;font-size:13px;padding-right:10px;">@if ($errors->has('error_login'))
                                    <span class="help-block">
                                          {{ $errors->first('error_login') }}
                                    </span>
                                    @endif</td>
          </tr>
          <tr>
          <td><input type="text" name="email" class="input" value="{{ old('email') }}" placeholder="ایمیل ... "></td>
          </tr>

          <tr>
          <td style="color:#ff0000;font-size:13px;padding-right:10px;">
          @if ($errors->has('email'))
          <span class="help-block">
                {{ $errors->first('email') }}
          </span>
          @endif
          </td>
          </tr>

          <tr>
          <td><input type="password" name="password" class="input" placeholder="کلمه عبور ... "></td>
          </tr>

          <tr>
                    <td style="color:#ff0000;font-size:13px;padding-right:10px;">
                    @if ($errors->has('password'))
                                       <span class="help-block">
                                        {{ $errors->first('password') }}
                                       </span>
                    @endif
                    </td>
                    </tr>

          <tr>
          <td>
          <div style="margin:10px auto;width:126px;">
          <img src="<?= url('Captcha') ?>">
          </div>
          </td>
          </tr>


       <tr>
                <td><input type="text" name="captcha" class="input" placeholder="تصویر امنیتی .."></td>
                </tr>

                <tr>
                          <td style="color:#ff0000;font-size:13px;padding-right:10px;">
                          @if ($errors->has('captcha'))
                                             <span class="help-block">
                                              {{ $errors->first('captcha') }}
                                             </span>
                          @endif
                          </td>
                          </tr>

                <tr>

          <tr>
          <td><input  style="margin-right:10px;" type="checkbox" name="remember"> <span style="font-size:13px;">مرا به خاطر بسپار</span></td>
          </tr>

          <tr>
          <td><input type="submit" style="margin-right:10px;margin-top:10px;margin-bottom:20px;" value="ورود" ></td>
          </tr>
          </table>
          </form>

          @else

         <p style="font-size:14px;padding-right:10px;padding-top:20px;padding-bottom:10px;">وارد شده با نام : <?= Auth::user()->name ?></p>
         <a style="color:#ff0000;padding-right:10px;" href="{{ url('logout') }}">خروج</a>
          <p style="padding-bottom:10px;"></p>
          @endif
         </div>

 </div>

<div class="menu_box" style="margin-top:20px;">
          <div class="menu_box_title">
                 <p style="margin-right:20px;padding-top:5px;">دسته بندی محصولات</p>
          </div>
          <div class="line" style="margin-top:5px;"></div>
          <div>


           <?php

           $cat=DB::table('category')->orderBy('id','DESC')->where('parent_id',0)->get();

           ?>
           <ul id="cat">
           @foreach($cat as $key=>$value)

            <li class="li-menu"><a href="{{ url('Category').'/'.$value->ename }}" style="color:#000000;">{{ $value->name }}</a>
            <ul>
               <?php
               $cat2=DB::table('category')->orderBy('id','DESC')->where('parent_id',$value->id)->get();
               ?>
               @foreach($cat2 as $key2=>$value2)
               <li class="children_li" ><a href="{{ url('Category').'/'.$value->ename.'/'.$value2->ename }}" style="color:#000000;">{{ $value2->name }}</a></li>
               @endforeach
            </ul>
            </li>
           @endforeach
          </ul>
          </div>

  </div>

</div>
@endsection
