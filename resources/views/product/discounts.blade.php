@extends('layouts/admin')

@section('content')

 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

        <div class="content_title" style="width:100%;">
            <p style="margin-right:20px;padding-top:10px;">افزودن کد تخفیف</p>
        </div>


          <form method="post" action="{{ url('admin/discounts') }}">
        {{ csrf_field() }}
          <table class="table">

            <tr>
                 <td style="width:100px;">کد تخفیف : </td>
                 <td><input type="text" name="discounts_name" class="input"></td>

            </tr>


            <tr>
                 <td style="width:100px;">مقدار تخفیف : </td>
                 <td><input type="text" name="discounts_value" class="input"></td>

            </tr>

            <tr>
            <td>وضعیت تخفیف : </td>
            <td><input @if(DB::table('setting')->where('option_name','Discounts')->first()->option_value=='Active') {{ 'checked="checked"' }} @endif  type="checkbox" name="Discounts"> <span style="font-size:13px;padding-right:5px;">فعال</span></td>
            </tr>


            <tr>
                            <td colspan="2">
                                <input type="submit" style="padding-top:0px;padding-bottom:0px;" value="ثبت">
                            </td>
             </tr>

        </table>
</form>




@if(sizeof($Discounts)>0)
        <table class="tbl_list" id="tbl_list">
                    <tr>
                        <th>ردیف</th>
                        <th>کد تخفیف</th>
                        <th>مقدار تخفیف</th>
                        <th>حذف</th>
                    </tr>
                    <?php
                    $i=0;
                    ?>
                    @foreach($Discounts as $key=>$value)
       <?php
                     $i++;
                    ?>
                    <tr>
<td>{{ $i }}</td>
                                      <td><?= $value['discounts_name'] ?></td>
                                      <td><?= $value['discounts_value'] ?></td>
                    <td>

                    <span onclick="del_row('<?=  $value['id'] ?>')" class="del"></span>
                     </td>
</tr>
                    @endforeach



        </table>
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
   var route='<?= url("admin/discounts")."/" ?>';
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

</script>

@endsection