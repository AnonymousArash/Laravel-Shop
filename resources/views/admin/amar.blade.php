@extends('layouts.admin')

@section('content')


 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

<?php

$Jdf=new \App\lib\Jdf();

?>


<div id="container" style="min-width: 310px; height: 400px; margin-top: 50px;"></div>
 <div style="width:100%;float:right;direction:rtl">





<table style="margin-right:20px;margin-top:50px;direction:rtl" id="amar_frosh">

   <tr>
   <td>آمار فروش امروز : </td>
   <td style="color:blue">
   <?php
   $a=DB::table('order')->where(['date'=>$Jdf->tr_num($Jdf->jdate('Y-n-j')),'payment_status'=>'پرداخت شده'])->sum('price');
   if($a>=0)
   {
   echo number_format($a=DB::table('order')->where(['date'=>$Jdf->tr_num($Jdf->jdate('Y-n-j')),'payment_status'=>'پرداخت شده'])->sum('price')) .' ریال';
   }
   else
   {
     echo '0';
   }
   ?>
   </td>
   </tr>


    <tr>
      <td>آمار فروش هفته جاری : </td>
      <td style="color:blue">
      <?php
      $b=$Jdf->tr_num($Jdf->jdate('N'));
      if($b==7)
      {
          $a=DB::table('order')->where(['date'=>$Jdf->tr_num($Jdf->jdate('Y-n-j')),'payment_status'=>'پرداخت شده'])->sum('price');
         if($a>=0)
         {
         echo number_format($a=DB::table('order')->where(['date'=>$Jdf->tr_num($Jdf->jdate('Y-n-j')),'payment_status'=>'پرداخت شده'])->sum('price')) .' ریال';
         }
         else
         {
           echo '0';
         }
      }
      else
      {
        $b=$b+1;
        $sum=0;
        for($i=0;$i<$b;$i++)
        {
           if($i==0)
           {
             $time=strtotime('today');
             $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
             $sum+=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->sum('price');
           }
           else
           {
             $string='-'.$i.' day';
             $time=strtotime($string);
             $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
             $sum+=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->sum('price');
           }
        }

        echo number_format($sum).' ریال';
      }
      ?>
      </td>
      </tr>




        <tr>
            <td>آمار فروش ماه جاری : </td>
            <td style="color:blue">
            <?php
            $b=$Jdf->tr_num($Jdf->jdate('j'));
            if($b==1)
            {
                $a=DB::table('order')->where(['date'=>$Jdf->tr_num($Jdf->jdate('Y-n-j')),'payment_status'=>'پرداخت شده'])->sum('price');
               if($a>=0)
               {
               echo number_format($a=DB::table('order')->where(['date'=>$Jdf->tr_num($Jdf->jdate('Y-n-j')),'payment_status'=>'پرداخت شده'])->sum('price')) .' ریال';
               }
               else
               {
                 echo '0';
               }
            }
            else
            {

              $sum=0;
              for($i=0;$i<$b;$i++)
              {
                 if($i==0)
                 {
                   $time=strtotime('today');
                   $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                   $sum+=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->sum('price');
                 }
                 else
                 {
                   $string='-'.$i.' day';
                   $time=strtotime($string);
                   $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                   $sum+=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->sum('price');
                 }
              }

              echo number_format($sum).' ریال';
            }
            ?>
            </td>
            </tr>

            <tr>
            <td>آمار فروش سال : </td>
            <td style="color:blue"><?php
            $c=$Jdf->jmktime(0,0,0,1,1,$Jdf->jdate('Y'));
            $sum=DB::table('order')->where('time','>',$c)->where(['payment_status'=>'پرداخت شده'])->sum('price');
            if($sum>=0)
            {
                echo number_format($sum).' ریال';
            }
            else
            {
               echo '0';
            }
            ?>
            </td>
            </tr>



             <tr>
                        <td>آمار کل فروش : </td>
                        <td style="color:blue"><?php
                        $sum=DB::table('order')->where(['payment_status'=>'پرداخت شده'])->sum('price');
                        if($sum>=0)
                        {
                            echo number_format($sum).' ریال';
                        }
                        else
                        {
                           echo '0';
                        }
                        ?>
                        </td>
             </tr>

</table>
</div>

<div style="clear:both"></div>

 </div>
<script>
var array=new Array;
</script>
 <?php
 $j=0;

     for($i=29;$i>=0;$i--)
     {
            if($i==0)
            {
                 $time=strtotime('today');
                 $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                 ?><script>array['<?= $j ?>']='<?= $c ?>';</script><?php
            }
            else
            {
                 $string='-'.$i.' day';
                 $time=strtotime($string);
                 $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                  ?><script>
                  array['<?= $j ?>']='<?= $c ?>';
                  </script><?php
            }

            $j++;
     }

     ?>


 @endsection

@section('footer')
<script type="text/javascript" src="{{ url('resources/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ url('resources/js/highcharts.js') }}"></script>
<script>

$(function () {
    $('#container').highcharts({
        title: {
            text: 'میزان درآمد 30 روز گذشته سایت',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        chart:
        {
          style:
          {
             fontFamily:'Yekan'
          }
        },
        xAxis: {
            categories:array
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix:' هزار ریال '
        },
        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'top',
            borderWidth: 0,
            y:30
        },
        series: [{
            name: 'میزان درآمد',
            data:[<?php
            for($i=29;$i>=0;$i--)
            {
              if($i==0)
              {
                $time=strtotime('today');
                $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                $sum=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->sum('price');
                echo str_replace('000','',$sum).',';
              }
              else
              {
                 $string='-'.$i.' day';
                 $time=strtotime($string);
                 $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                 $sum=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->sum('price');
                 echo str_replace('000','',$sum).',';
              }
            }
            ?>]
        }, {
            name: 'تعداد تراکنش',
            data: [
            <?php
                        for($i=29;$i>=0;$i--)
                        {
                          if($i==1)
                          {
                            $time=strtotime('today');
                            $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                            $count=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->count();
                           echo $count.',';
                          }
                          else
                          {
                             $string='-'.$i.' day';
                             $time=strtotime($string);
                             $c=$Jdf->tr_num($Jdf->jdate('Y-n-j',$time));
                              $count=DB::table('order')->where(['date'=>$c,'payment_status'=>'پرداخت شده'])->count();
                              echo $count.',';
                          }
                        }
                        ?>
            ],

            tooltip: {
                        valueSuffix:' بار '
                    }
        }]
    });
});
</script>
@endsection