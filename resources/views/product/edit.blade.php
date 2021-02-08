@extends('layouts/admin')

@section('content')

 <div  style="border: 1px solid #EBEBEB;width:85%;margin:50px auto;background:white">

        <div class="content_title" style="width:100%;">
            <p style="margin-right:20px;padding-top:10px;">ویرایش - <?= $model->title ?></p>
        </div>


         {!! Form::model($model,['method'=>'PUT','files'=>true,'route'=>['admin.product.update',$model['id']]]) !!}
          <table class="table">

            <tr>
                 <td style="width:100px;">عنوان محصول : </td>
                 <td>{!! Form::text('title',null,['class'=>'input','style'=>'width:80%']) !!}</td>
            </tr>

            <tr>
            <td></td>
            <td style="font-size:13px;color:red;padding-right:0px;">
            @if($errors->has('title'))
            {{ $errors->first('title') }}
            @endif
            </td>
            </tr>


            <tr>
              <td colspan="2">{!! Form::textarea('content',null,['class'=>'ckeditor','style'=>'width:93%']) !!}</td>
            </tr>


<tr>
            <td style="width:120px;">مدت زمان دوره : </td>
                <td>{!! Form::text('files_time',null,['class'=>'input','style'=>'width:250px;']) !!}</td>
            </tr>
<tr>
             <td style="width:120px;">حجم دوره : </td>
                 <td>{!! Form::text('files_size',null,['class'=>'input','style'=>'width:250px;']) !!}</td>
             </tr>
             <tr>
             <td style="width:140px;">تعداد قسمت های دوره : </td>
                 <td>{!! Form::text('number_files',null,['class'=>'input','style'=>'width:250px;']) !!}</td>
             </tr>
             <tr>
             <td style="width:140px;">هزینه دوره : </td>
                 <td>{!! Form::text('price',null,['class'=>'input','style'=>'width:250px;']) !!}</td>
             </tr>
           <tr>
           <td style="width:140px;">تصویر شاخص</td>
             <td>{!! Form::file('image',['style'=>'direction:ltr;width:250px;']) !!}</td>
           </tr>


           <tr>
                       <td></td>
                       <td style="font-size:13px;color:red;padding-right:0px;">
                       @if($errors->has('image'))
                       {{ $errors->first('image') }}
                       @endif
                       </td>
                       </tr>

            <tr>
                <td colspan="2">
                 <ul style="padding-top:15px;padding-bottom:15px;background-image: url('<?= url('resources/images/dotted.png') ?>');;width:90%;border-radius:5px;">
                 <?php
                 $cat1=\App\Category::where('parent_id',0)->get()->toArray();
                 ?>
                 @foreach($cat1 as $key=>$value)
                 <li class="li-menu">

                 <input @if(DB::table('cat_product')->where(['cat_id'=>$value['id'],'product_id'=>$model->id])->count()==1) {{ 'checked="checked"' }} @endif type="checkbox"   name="cat[]" value="<?= $value['id'] ?>"> <span><?= $value['name'] ?></span><ul>
                    <?php
                     $cat2=\App\Category::where('parent_id',$value['id'])->get()->toArray();
                    ?>
                    @foreach($cat2 as $key2=>$value2)

                    <li class="li-children"><input @if(DB::table('cat_product')->where(['cat_id'=>$value2['id'],'product_id'=>$model->id])->count()==1) {{ 'checked="checked"' }} @endif type="checkbox" name="cat[]" value="<?= $value2['id'] ?>">   <span><?= $value2['name'] ?></span>
                    </li>
                    @endforeach
                    </ul>
                 @endforeach
                 </ul>
                 </td>
            </tr>


<tr>
             <td colspan="2">لینک دانلود دوره</td>
             </tr>

             <tr>
             <td colspan="2">{!! Form::textarea('download',null,['style'=>'width:90%;text-align:left;']) !!}</td>
             </tr>


             <tr>
                          <td colspan="2">برچسب های دوره</td>
                          </tr>

                          <tr>
                          <td colspan="2">{!! Form::textarea('tag',null,['style'=>'width:90%']) !!}</td>
                          </tr>
            <tr>


            <tr>
                             <td style="width:150px;">وضعیت محصول : </td>
                             <?php
                             $cat=['1'=>'منتشر شده',
                             '2'=>'پیش نویس',
                             '3'=>'پست ثابت'
                             ];
                             ?>
                             <td>{!! Form::select('state',$cat,null,['class'=>'input','style'=>'margin-right:0px;']) !!}</td>
            </tr>

            @if(!empty($model->img))
            <tr>
            <td colspan="2">تصویر شاخص</td>
            </tr>
            <tr>
            <td colspan="2">
            <img src="{{ url('upload').'/'.$model->img }}" style="max-width:400px;">
            </td>
            </tr>
            @endif


            <tr>
                            <td colspan="2">
                                <input type="submit" value="ویرایش">
                            </td>
             </tr>

        </table>
        {!! Form::close() !!}
         <div style="clear:both"></div>

</div>

@endsection


@section('footer')

<script type="text/javascript" src="<?= url('resources/views/ckeditor/ckeditor.js') ?>"></script>
<script>
document.getElementById('li_menu_product').style.backgroundColor='#f78e3f';

document.getElementById('sub_product').style.display='block';
</script>
@endsection