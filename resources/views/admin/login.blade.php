<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>ورود به پنل مدیریت</title>
    <link href="<?= url('resources/css/admin.css') ?>" rel="stylesheet">
</head>
<body>



<div style="width:300px;margin:100px auto;direction:rtl;background:#ffffff">

<div style="width:250px;margin:auto">
<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                 {{ csrf_field() }}
          <table style="padding-top:20px;">
          <tr>
          <td colspan="2" style="color:red;font-size:13px;padding-right:10px;">@if ($errors->has('error_login'))
                                    <span class="help-block">
                                          {{ $errors->first('error_login') }}
                                    </span>
                                    @endif</td>
          </tr>
          <tr>
          <td><input type="text" name="username" class="input" value="{{ old('username') }}" placeholder="نام کاربری ... "></td>
          </tr>

          <tr>
          <td style="color:#ff0000;font-size:13px;">
          @if ($errors->has('username'))
          <span class="help-block">
                {{ $errors->first('username') }}
          </span>
          @endif
          </td>
          </tr>

          <tr>
          <td><input type="password" name="password" class="input" placeholder="کلمه عبور ... "></td>
          </tr>

          <tr>
                    <td style="color:#ff0000;font-size:13px;">
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
                          <td style="color:#ff0000;font-size:13px;">
                          @if ($errors->has('captcha'))
                                             <span class="help-block">
                                              {{ $errors->first('captcha') }}
                                             </span>
                          @endif
                          </td>
                          </tr>

                <tr>

          <tr>
          <td><input  style="" type="checkbox" name="remember"> <span style="font-size:13px;">مرا به خاطر بسپار</span></td>
          </tr>

          <tr>
          <td><input type="submit" style="margin-top:10px;margin-bottom:20px;padding-right:10px;padding-left:10px;padding-top:0px;padding-bottom:0px;" value="ورود" ></td>
          </tr>
          </table>
          </form>

</div>
</div>



</body>
</html>