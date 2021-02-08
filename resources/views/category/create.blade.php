@extends('layouts/admin')

@section('content')

 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

        <div class="content_title" style="width:100%;">
            <p style="margin-right:20px;padding-top:10px;">افزودن دسته جدید</p>
        </div>


          {!! Form::open(['url'=>'admin/category']) !!}
          <table class="table">

            <tr>
                <td style="width:150px;">نام دسته : </td>
                <td>{!! form::text('name',null,['class'=>'input']) !!}</td>
            </tr>

            <tr>
            <td></td>
            <td style="font-size:13px;color:red;padding-right:0px;">
            @if($errors->has('name'))
            {{ $errors->first('name') }}
            @endif
            </td>
            </tr>

            <tr>
                 <td style="width:150px;">نام لاتین دسته : </td>
                 <td>{!! form::text('ename',null,['class'=>'input']) !!}</td>
            </tr>

            <tr>
            <td></td>
            <td style="font-size:13px;color:red;padding-right:0px;">
 @if($errors->has('ename'))
            {{ $errors->first('ename') }}
            @endif
            </td>
            </tr>

            <tr>
                 <td style="width:150px;">انتخاب سر دسته : </td>
                 <td>{!! Form::select('parent_id',$cat,null,['class'=>'input','style'=>'margin-right:0px;']) !!}</td>
            </tr>

            <tr>
                            <td colspan="2">
                                <input type="submit" value="افزودن">
                            </td>
             </tr>

        </table>
        {!! Form::close() !!}
         <div style="clear:both"></div>

</div>

@endsection

@section('footer')
<script>
document.getElementById('li_menu_product').style.backgroundColor='#f78e3f';

document.getElementById('sub_product').style.display='block';
</script>
@endsection