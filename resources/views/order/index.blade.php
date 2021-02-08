@extends('layouts.admin')

@section('content')

<?php
use App\Category;
?>

 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

        <div class="content_title" style="width:100%;">
            <p style="margin-right:20px;padding-top:10px;">مدیریت سفارشات</p>
        </div>
        @if(sizeof($order)>0)
        <table class="tbl_list" id="tbl_list">
                    <tr>
                        <th>ردیف</th>
                        <th>شماره تراکنش</th>
                        <th>زمان خرید</th>
                        <th>هزینه</th>
                        <th>وضعیت</th>
                        <th>حذف</th>
                    </tr>
                    <?php
                    $i=0;
                    ?>
                    @foreach($order as $key=>$value)
                      <?php $i++ ?>
                    <tr>
                    <td>{{ $i }}</td>
                    <td>
                    @if($value->order_read=='no')
                    <a href="{{ url('admin/order').'/'.$value->id }}" style="color:#ff0000">{{ $value->time }}</a></td>

                    @else
                    <a href="{{ url('admin/order').'/'.$value->id }}" style="color:#000000">{{ $value->time }}</a></td>

                    @endif
                    <td>
                    <?php
                    $jdf=new \App\lib\Jdf();
                    echo $jdf->jdate('l-Y/n/j-H:i:s',$value->time);
                    ?>
                    </td>
                    <td>
                    {{ $value->price }}
                    </td>
                    <td>
                    {{ $value->payment_status }}
                    </td>
                    <td><span onclick="del_row('<?=  $value['id'] ?>')" class="del"></span></td>

                    </tr>
                    @endforeach




        </table>

       {{ $order->render() }}

        @else

        <p style="padding-top:20px;padding-bottom:20px;text-align:center;color:red">رکوردی برای نمایش وجود ندارد</p>

        @endif

 <div style="clear:both"></div>

 </div>
@endsection

@section('footer')

<script type="text/javascript">

function del_row(id)
{
  <?php
         $token=Session::token();
   ?>
   var route='<?= url("admin/order")."/" ?>';
   if (!confirm("آیا از حذف این رکورد اطمینان دارید !"))
   return false;
   var form = document.createElement("form");
   form.setAttribute("method", "POST");
   form.setAttribute("action",route+id);
   var hiddenField1 = document.createElement("input");
   hiddenField1.setAttribute("name", "_method");
   hiddenField1.setAttribute("value",'DELETE');
   form.appendChild(hiddenField1);
   var hiddenField2 = document.createElement("input");
   hiddenField2.setAttribute("name", "_token");
   hiddenField2.setAttribute("value",'<?= $token ?>');
   form.appendChild(hiddenField2);
   document.body.appendChild(form);
   form.submit();
   document.body.removeChild(form);
}
document.getElementById('li_menu_order').style.backgroundColor='#f78e3f';
</script>

@endsection