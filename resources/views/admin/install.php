<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>نصب فروشگاه</title>
    <link href="<?= url('') ?>/resources/css/install.css" rel="stylesheet">
</head>
<body>
<div id="box">
    <p style="margin-right:40px;padding-top:30px;margin-left:40px;">نصب فروشگاه با موفقیت انجام شد لطفا اطلاعات زیر را جهت ورود به پنل مدیریت تکمیل کنید</p>
    <form method="post" action="<?= url('install/admin/create') ?>">
        <?= csrf_field() ?>
        <table id="install">

            <tr>
                <td>نام کاربری : </td>
                <td><input type="text" name="username" class="inputfiled" /></td>
            </tr>

            <tr>
                <td>کلمه عبور : </td>
                <td><input type="password" name="password" class="inputfiled" /></td>
            </tr>

            <tr>
                <td>ایمیل : </td>
                <td><input type="text" name="email" class="inputfiled" /></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" class="btn" value="ثبت" style="margin-right:0px;margin-bottom:20px">
                </td>

            </tr>
        </table>
    </form>
</div>
</body>
</html>