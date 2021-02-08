<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Validator;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    public function index()
    {
        $cat=Category::where('parent_id',0)->orderBy('id','DESC')->get()->toArray();
        return View('category.index',['Category'=>$cat]);
    }
    public function create()
    {
        $cat=['0'=>'لطفا یک دسته را انتخاب کنید']+Category::where('parent_id',0)->orderBy('id','DESC')->lists('name','id')->toArray();
        return View('category.create',['cat'=>$cat]);
    }
    public function store(CategoryRequest $request)
    {
        $Category=new Category($request->all());
        if($Category->save())
        {
            $url=url('admin/category').'/'.$Category->id.'/edit';
            return redirect($url);
        }

    }
    public function edit($id)
    {
        $model=Category::find($id);
        $cat=['0'=>'لطفا یک دسته را انتخاب کنید']+Category::where('parent_id',0)->orderBy('id','DESC')->lists('name','id')->toArray();

        return View('category.edit',['model'=>$model,'cat'=>$cat]);
    }
    public function update(CategoryRequest $request,$id)
    {
        $Category=Category::find($id);
        $Category->update($request->all());
        $url=url('admin/category').'/'.$Category->id.'/edit';
        return redirect($url);
    }
    public function destroy($id)
    {
       Category::where('parent_id',$id)->delete();
       Category::find($id)->delete();
        return redirect()->back();
    }
}
