<?php

namespace App\Http\Controllers;

use App\Discounts;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use DB;
class ProductController extends Controller
{

    public function index()
    {
        $Product=Product::orderBy('id','DESC')->paginate(10);
        return View('product.index',['Product'=>$Product]);
    }
    public function create()
    {
        return View('product.create');
    }
    public function store(Requests\ProductRequest $request)
    {
        $product=new Product($request->all());
        $title=str_replace('-','',$product->title);
        $product->url=preg_replace('/\s+/','-',$title);
        $product->date=time();
        if($request->hasFile('image'))
        {
            $File_Name=time().'.'.$request->file('image')->getClientOriginalExtension();
            if($request->file('image')->move('upload',$File_Name))
            {
                $product->img=$File_Name;
            }
        }
        if($product->save())
        {
            if($request->has('cat'))
            {
                foreach($request->get('cat') as $key=>$value)
                {
                    DB::table('cat_product')->insert(['product_id'=>$product->id,'cat_id'=>$value]);
                }
            }

            $url='admin/product/'.$product->id.'/edit';
            return redirect($url);
        }

    }
    public function edit($id)
    {
        $model=Product::find($id);
        return View('product.edit',['model'=>$model]);
    }
    public function update(Requests\ProductRequest $request,$id)
    {
        $product=Product::find($id);
        $title=str_replace('-','',$request->get('title'));
        $product->url=preg_replace('/\s+/','-',$title);


        if($request->hasFile('image'))
        {
            $File_Name=time().'.'.$request->file('image')->getClientOriginalExtension();
            if($request->file('image')->move('upload',$File_Name))
            {
                $product->img=$File_Name;
            }
        }
        if($product->update($request->all()))
        {
            $delete=DB::table('cat_product')->where('product_id',$product->id)->delete();
            if($request->has('cat'))
            {
                foreach($request->get('cat') as $key=>$value)
                {
                    DB::table('cat_product')->insert(['product_id'=>$product->id,'cat_id'=>$value]);
                }
            }

            $url='admin/product/'.$product->id.'/edit';
            return redirect($url);
        }
    }
    public function destroy($id)
    {
        DB::table('cat_product')->where('product_id',$id)->delete();
        Product::find($id)->delete();
        return redirect()->back();
    }
    public function get_discount_form()
    {
       $Discounts=Discounts::orderBy('id','DESC')->get()->toArray();
       return View('product.discounts',['Discounts'=>$Discounts]);
    }
    public function discounts(Request $request)
    {
        if(!empty($request->get('discounts_name')) && !empty($request->get('discounts_value')) )
        {
            $Discounts=Discounts::create($request->all());
        }

       if($request->has('Discounts'))
       {
           DB::table('setting')->where('option_name','Discounts')->update(['option_value'=>'Active']);
       }
       else
       {
           DB::table('setting')->where('option_name','Discounts')->update(['option_value'=>'InActive']);
       }

        return redirect()->back();
    }
    public function del_discounts($id)
    {
        DB::table('discounts')->where('id',$id)->delete();
        return redirect()->back();
    }
}
