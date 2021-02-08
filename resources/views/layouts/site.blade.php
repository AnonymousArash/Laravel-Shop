<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>آرش نریمانی</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('resources/css/site.css') }}" rel="stylesheet">
    <link href="{{ url('resources/css/responsive.css') }}" rel="stylesheet">
    @yield('header')
</head>
<body>

<div id="top_menu">

          <ul id="menu1">
          <li style="padding-left:20px;">sss</li>
          <li><a href="<?= url(''); ?>">صفحه اصلی</a></li>
          <li><a href="<?= url('about') ?>">درباره ما</a></li>
          <li><a href="<?= url('contact') ?>">تماس با ما</a></li>
          <li><a href="<?= url('terms'); ?>">مقررات سایت</a></li>
          <li><a href="<?= url('cart') ?>" style="color:#0f0;">سبد خرید</a></li>
          </ul>
</div>

<div id="content">

@yield('content')

</div>
@yield('footer')
<script type="text/javascript" src="{{ url('resources/js/jquery.js') }}"></script>
</body>
</html>