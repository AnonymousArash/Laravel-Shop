<?php
ob_start();

class install
{
    public static function getView()
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>نصب فروشگاه</title>
            <link href="resources/css/install.css" rel="stylesheet">
        </head>
        <body>
        <div id="box">
            <?php self::content(); ?>
        </div>
        </body>
        </html>
    <?php
    }
    public static function content()
    {
        if(isset($_GET['setup']))
        {
            switch ($_GET['setup']) {
                case 1:
                    self::connect();
                    break;
                case 'connect':
                    self::check_connect();
                    break;
                case '2':
                    self::get_install();
                    break;

                case '3':
                    self::install_db();
                    break;

                case 'admin':
                    self::admin();
                    break;

                case 'create':
                    self::create();
                    break;

                case 'finish':
                    self::finish();
                    break;
            }
        }
        else
        {
            return self::index();
        }
    }
    public static function index()
    {
        ?>
        <p style="margin-right:30px;padding-top:30px;font-family:BYekan;">نصب فروشگاه فایل</p>
        <p style="margin-right:30px;padding-top:10px;">پیش از آغاز ما به اطلاعات پایگاه‌داده‌ی شما احتیاج داریم. شما باید جهت شروع کار موارد زیر را بدانید.</p>
        <p style="margin-right:30px;padding-top:10px;">1.نام پایگاه‌داده</p>
        <p style="margin-right:30px;padding-top:10px;">2.نام‌کاربری پایگاه‌داده</p>
        <p style="margin-right:30px;padding-top:10px;">3.رمز پایگاه‌داده</p>
        <p style="margin-right:30px;padding-top:10px;">4.میزبان پایگاه‌داده</p>
        <p style="margin-right:30px;padding-top:10px;">موارد ذکر شده توسط میزبان شما ارائه می‌شوند. اگر اطلاعات ذکر شده  را ندارید بهتر است پیش از ادامه‌ی کار با مدیر سرویس میزبانی خود تماس بگیرید.</p>
        <div style="background:#f1f1f1;width:90px;text-align:center;height:30px;line-height:30px;margin-right:30px;margin-top:20px;"><a href="install.php?setup=1">ادامه نصب</a></div>
        <div style="padding-top:20px;"></div>
    <?php
    }

    public static function connect()
    {
        ?>
        <p style="margin-right:40px;padding-top:30px;margin-left:40px;">در بخش پایین باید اطلاعات اتصال به پایگاه‌داده‌ی خود را وارد کنید. اگر درباره‌ی اطلاعات زیر مطمئن نیستید با مدیر سرویس میزبانی خود تماس بگیرید.</p>
        <form method="post" action="install.php?setup=connect">
            <table id="install">
                <tr>
                    <td>میزبان پایگاه‌داده : </td>
                    <td><input type="text" name="host" class="inputfiled" /></td>
                </tr>

                <tr>
                    <td>نام کاربری : </td>
                    <td><input type="text" name="username" class="inputfiled" /></td>
                </tr>

                <tr>
                    <td>کلمه عبور : </td>
                    <td><input type="password" name="password" class="inputfiled" /></td>
                </tr>

                <tr>
                    <td>نام پایگاه‌داده : </td>
                    <td><input type="text" name="database" class="inputfiled" /></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn" value="ادامه نصب" style="margin-right:0px;margin-bottom:20px">
                    </td>

                </tr>
            </table>
        </form>
    <?php
    }


    public static function check_connect()
    {
        if(isset($_POST['host']))
        {
            $host         = $_POST['host'];
            $username     = $_POST['username'];
            $password     = $_POST['password'];
            $database     = $_POST['database'];
            if(empty($host) or empty($username) or empty($database))
            {
                ?>
                <p style="margin-right:40px;padding-top:30px;margin-left:40px;">در بخش پایین باید اطلاعات اتصال به پایگاه‌داده‌ی خود را وارد کنید. اگر درباره‌ی اطلاعات زیر مطمئن نیستید با مدیر سرویس میزبانی خود تماس بگیرید.</p>
                <form method="post" action="install.php?setup=connect">
                <table id="install">
                    <tr>
                        <td>میزبان پایگاه‌داده : </td>
                        <td><input type="text" name="host" class="inputfiled" /></td>
                        <td style="color:red;"><?php if(empty($host)) echo 'لطفا میزبان پایگاه‌داده خود را وارد نمایید' ?></td>
                    </tr>

                    <tr>
                        <td>نام کاربری : </td>
                        <td><input type="text" name="username" class="inputfiled" /></td>
                        <td style="color:red;"><?php if(empty($username)) echo 'لطفا نام کاربری  پایگاه‌داده را وارد نمایید' ?></td>

                    </tr>

                    <tr>
                        <td>کلمه عبور : </td>
                        <td><input type="password" name="password" class="inputfiled" /></td>
                    </tr>

                    <tr>
                        <td>نام پایگاه‌داده : </td>
                        <td><input type="text" name="database" class="inputfiled" /></td>
                        <td style="color:red;"><?php if(empty($database)) echo 'لطفا نام پایگاه‌داده  پایگاه‌داده را وارد نمایید' ?></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn" value="ادامه نصب" style="margin-right:0px;margin-bottom:20px">
                        </td>

                    </tr>
                </table>
                </form><?php
            }
            else
            {
                if(self::check_pdo($host,$username,$password,$database))
                {
                    $configFile ='config/db.php';


                    $content = "<" . "?php \n\nreturn [ \n";
                    $content.="'driver'=>'mysql',\n";
                    $content.="'host'=>'".$host."',\n";
                    $content.="'database'=>'".$database."',\n";
                    $content.="'username'=>'".$username."',\n";
                    $content.="'password'=>'".$password."',\n";
                    $content.="'charset'=>'utf8',\n";
                    $content.="'collation'=>'utf8_unicode_ci',\n";
                    $content.="'prefix'=>'',\n";
                    $content.="'strict'=>false,\n";
                    $content.="'engine'=>null,\n";
                    $content .= "]; ?" . ">";
                    if(file_put_contents($configFile, $content))
                    {
                        header('Location:install.php?setup=2');
                    }
                }
                else
                {
                    ?>
                    <p style="margin-right:40px;padding-top:30px;margin-left:40px;">در بخش پایین باید اطلاعات اتصال به پایگاه‌داده‌ی خود را وارد کنید. اگر درباره‌ی اطلاعات زیر مطمئن نیستید با مدیر سرویس میزبانی خود تماس بگیرید.</p>
                    <form method="post" action="install.php?setup=connect">
                        <table id="install">
                            <tr>
                                <td>میزبان پایگاه‌داده : </td>
                                <td><input type="text" name="host" class="inputfiled" /></td>
                            </tr>

                            <tr>
                                <td>نام کاربری : </td>
                                <td><input type="text" name="username" class="inputfiled" /></td>
                            </tr>

                            <tr>
                                <td>کلمه عبور : </td>
                                <td><input type="password" name="password" class="inputfiled" /></td>
                            </tr>

                            <tr>
                                <td>نام پایگاه‌داده : </td>
                                <td><input type="text" name="database" class="inputfiled" /></td>
                            </tr>

                            <tr>
                                <td >
                                    <input type="submit" class="btn" value="ادامه نصب" style="margin-right:0px;margin-bottom:20px">
                                </td>
                                <td style="color:red;padding-right:90px;">اتصال به پایگاه داده امکان پذیر نمی باشد</td>

                            </tr>
                        </table>
                    </form>
                <?php
                }
            }
        }
        else
        {
            header("Location:install.php?setup=1");
        }

    }
    public static function check_pdo($host,$username,$password,$database)
    {
        try
        {
            @$db=new PDO("mysql:host=$host;dbname=$database",$username,$password);
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }
    public static function get_install()
    {
        ?>
        <p style="margin-right:40px;padding-top:30px;margin-left:40px;">خب، رفیق! دیگه تو این مرحله از نصب کار شما انجام شد و وردپرس میتونه با پایگاه‌داده ارتباط برقرار کنه، اگه آماده‌ای ,</p>
        <p style="margin-right:40px;padding-top:30px;margin-left:40px;">وقتش شده که…</p>
        <p style="background: #F1F1F1 none repeat scroll 0% 0%;width: 90px;text-align: center;height: 30px;line-height: 30px;margin-right: 40px;margin-top: 20px;font-family: Yekan;border: 1px solid #F1F1F1;font-size: 16px;"><a href="install.php?setup=3">اجرای نصب</a></p>
        <p style="padding-bottom:20px;"></p>
    <?php
    }
    public static function install_db()
    {
        $array=array_merge(
            require __DIR__.'/config/db.php'
        );
        $dsn="mysql:host=".$array['host'].';dbname='.$array['database'];
        $db = new PDO($dsn,$array['username'],$array['password']);

        $sql = file_get_contents('shop.sql');
        $qr = $db->exec($sql);
        unlink('install.php');
        header('Location:install/admin');

    }
}

install::getView();