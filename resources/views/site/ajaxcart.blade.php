<div style="width:100%;background:#ffffff" id="show">
<div style="padding-top:20px;"></div>

@if(!empty(Session::get('cart')))

<table id="tbl_cart" style="padding-bottom:20px;">
   <tr>
   <th>ردیف</th>
   <th>عنوان محصول</th>
   <th>قیمت</th>
   <th>جذف</th>
   </tr>
   <?php
   $i=1;
    $total_price=0;
   ?>
   @foreach(Session::get('cart') as $key=>$value)

     <tr>
     <td>{{ $i }}</td>
     <td>{{ \App\Product::find($key)->title }}</td>
     <td>{{ number_format(\App\Product::find($key)->price) }} ریال</td>
     <td><img src="{{ url('resources/images/del.gif') }}" onclick="del('<?= $key ?>')"></td>
     </tr>
     <?php
       $total_price+=\App\Product::find($key)->price;
      $i++; ?>
   @endforeach

<?php
   Session::put('total_price',$total_price);
  if(!Session::has('discounts'))
      {
      Session::put('price',$total_price);
      }
      else
      {
        $price=$total_price-($total_price*Session::get('discounts'))/100;
            Session::put('price',$price);
      }
   ?>
</table>



<div id="order_price">
  <div style="width:90%;margin:auto;height:70px;border:1px solid #62b965">
    <span style="padding-right:20px;line-height:70px;">در صورتی که کد تخفیف دارید وارد نمایید</span>
    <span style="padding-right:10px;"><input name="discounts" id="discounts" type="text" style="border:1px solid #eeeff1;font-size:13px;margin-right:0px;height:25px;width:200px;margin-top:20px;font-family:Yekan;margin-left:0px;"></span>
    <span><input  type="button" onclick="check()" value="بررسی"  style="background:#62b965;border:1px solid #62b965;font-size:13px;font-family:Yekan;color:#ffffff;width:80px;margin-right:5px;height:27px;line-height:8px;padding:0px;"></span>
   <span style="color:red;font-size:13px;"><?php if(isset($message)) echo $message; ?></span>
  </div>


     <div style="width:90%;margin:auto;">
      <p style="padding-top:10px;"><span style="color:#ff0000">هزینه کل</span> : <span style="font-family:sans-serif"><?= number_format(Session::get('total_price')); ?></span> ریال</p>
      <p style="padding-top:10px;"><span style="color:#ff0000">هزینه قابل پرداخت</span> : <span style="font-family:sans-serif"><?= number_format(Session::get('price')); ?></span> ریال</p>

      </div>

</div>
@else

<p style="color:#ff0000;text-align:center;padding-top:20px;padding-bottom:30px;">سبد خرید شما خالی می باشد</p>

@endif
</div>
