@extends('layouts.admin')

@section('content')

<?php
use App\Category;
?>

 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

        <div class="content_title" style="width:100%;">
            <p style="margin-right:20px;padding-top:10px;">اطلاعات سفارش</p>
        </div>


      <table style="float:right;direction:rtl;margin-bottom:30px;" id="order_tbl" >
      <tr>
      <td><span>نام : </span> {{ $order->fname }}</td>
      <td><span>نام خانوادگی : </span> {{ $order->lname }}</td>
      <td><span>ایمیل : </span> {{ $order->email }}</td>
      <td><span>شماره موبایل : </span> {{ $order->mobile }}</td>
      </tr>
      <tr>

      </tr>


      <tr>
      <td><span>هزینه کل : </span> {{ number_format($order->total_price) }} ریال</td>
      <td><span>مبلغ واریزی : </span> {{ number_format($order->price) }} ریال</td>

       @if(!empty($order->zip_code))
     <td colspan="4"><span>کد پستی : </span> {{ $order->zip_code }}</td>
       @else
       <td></td>
       @endif
        <td></td>
      </tr>



      @if(!empty($order->address))

            <tr>
           <td colspan="4"><span>آدرس : </span> {{ $order->address }}</td>
            </tr>
      @endif


      </table>



<table class="tbl_list" id="tbl_list">
          <tr>
          <th>ردیف</th>
          <th>عنوان محصول</th>
          <th>هزینه</th>

         </tr>

      <?php

      $product_id=$order->product_id;
      $product_id=explode(',',$product_id);
      $i=0;
      foreach($product_id as $key=>$value)
      {
         if(!empty($value))
        {
        $i++;
      $product=\App\Product::where('id',$value)->first();
               ?>
               <tr>
               <td>{{ $i }}</td>
               <td>{{ $product->title }}</td>
               <td>{{ number_format($product->price) }} ریال</td>
               </tr>
               <?php
        }

      }

      ?>
</table>
      <div style="clear:both"></div>

 </div>

 @endsection


@section('footer')
<script>
document.getElementById('li_menu_order').style.backgroundColor='#f78e3f';
</script>
@endsection
