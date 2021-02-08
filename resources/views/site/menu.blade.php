@extends('layouts.site')

@section('content')

<div id="right_box">


@if(sizeof($Product)==0)


<div class="product_box">


<div class="product_text" style="text-align:center;padding-top:30px;padding-bottom:30px;font-size:13px;color:red">

<p>رکوری یافت نشد</p>

</div>



<div style="clear:both"></div>

</div>

@endif

@foreach($Product as $key=>$value)


<div class="product_box" <?php if($key>0) echo 'style="margin-top:20px;"' ?> >

<div class="product_box_title">

<p style="padding-right:15px;padding-top:5px;"><a href="{{ url('').'/'.$value->url }}">{{ $value->title }}</a></p>

</div>
<div class="line"></div>
<div class="product_img" style="max-width:500px;margin:30px auto"><img class="img" src="{{ url('upload').'/'.$value->img }}"></div>
<div class="product_text">
{!! get_content($value->content) !!}
</div>


<div class="more"><a href="{{ url('').'/'.$value->url }}">ادامه</a></div>
<div style="clear:both"></div>

</div>

@endforeach

<?php
function get_content($text)
{
  $more=strpos($text,'<!--more-->');
  return $more ? substr($text,0,$more) : $text;
}
?>

{{ $Product->render() }}

<div style="padding-top:40px;"></div>
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
                <p style="margin-right:20px;padding-top:5px;">جست و جو در سایت</p>
         </div>
         <div class="line" style="margin-top:5px;"></div>
         <div>


          <form class="form-horizontal" role="form" method="get" action="{{ url('/search') }}">

          <table>
          <tr>
          <td colspan="2" style="color:red;font-size:13px;padding-right:10px;">@if ($errors->has('error_login'))
                                    <span class="help-block">
                                          {{ $errors->first('error_login') }}
                                    </span>
                                    @endif</td>
          </tr>
          <tr>
          <td><input type="text" name="search_text" class="input"  placeholder="کلمه مورد نظر ..."></td>
          </tr>




          <tr>
          <td><input type="submit" style="margin-right:10px;margin-top:10px;margin-bottom:20px;" value="جست و جو" ></td>
          </tr>
          </table>
          </form>

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