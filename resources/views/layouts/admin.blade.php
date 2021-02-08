<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پنل مدیریت</title>
    <link href="<?= url('resources/css/admin.css') ?>" rel="stylesheet">
</head>
<body>

<div id="admin_menu">

@include('layouts/admin_menu')

</div>

<div id="content">

@yield('content')

</div>

@yield('footer')

</body>
</html>