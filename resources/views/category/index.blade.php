@extends('layouts.admin')

@section('content')

<?php
use App\Category;
?>

 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

        <div class="content_title" style="width:100%;">
            <p style="margin-right:20px;padding-top:10px;">مدیریت دسته بندی ها</p>
        </div>

        <table class="tbl_list" id="tbl_list">
                    <tr>
                        <th>ردیف</th>
                        <th>نام دسته</th>
                        <th>نام لاتین</th>
                        <th>عملیات</th>
                    </tr>

                    <?php
                    $i=0;
                    foreach($Category as $key=>$value)
                    {
                    $i++;
                       ?>
                       <tr>
                          <td><?= $i; ?></td>
                          <td><?= $value['name'] ?></td>
                          <td><?= $value['ename'] ?></td>
                          <td>
                          <a href="<?= url('admin/category').'/'.$value['id'].'/edit' ?>"><span class="update"></span></a>
                          <span onclick="del_row('<?=  $value['id'] ?>')" class="del"></span></td>

                       </tr>
                       <?php
                       $row=Category::where('parent_id',$value['id'])->get()->toArray();

                       foreach($row as $key1=>$value1)
                       {
                        $i++;
                                 ?>
                                    <tr>
                                      <td><?= $i; ?></td>
                                      <td>----<?= $value1['name'] ?></td>
                                      <td><?= $value1['ename'] ?></td>
                                      <td>
                                      <a href="<?= url('admin/category').'/'.$value1['id'].'/edit' ?>">
                                      <span class="update"></span></a>
                                      <span onclick="del_row('<?=  $value1['id'] ?>')" class="del"></span>
                                      </td>
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

<script type="text/javascript">

function del_row(id)
{
  <?php
         $token=Session::token();
   ?>
   var route='<?= url("admin/category")."/" ?>';
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

document.getElementById('li_menu_product').style.backgroundColor='#f78e3f';

document.getElementById('sub_product').style.display='block';

</script>

@endsection

