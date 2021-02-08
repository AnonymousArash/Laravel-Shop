<?php

namespace App\Http\Controllers;

use App\Address;
use App\Category;
use App\Comment;
use App\lib\Jdf;
use App\lib\mellat;
use App\Order;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Product;
use Illuminate\Support\Facades\Session;
use Response;
use Mail;

class SiteController extends Controller
{
    public function index()
    {
        $static=Product::orderBy('id','DESC')->where('state',3)->get()->toArray();
        $Product=Product::orderBy('id','DESC')->where('state',1)->paginate(10);
        return View('site.index',['Product'=>$Product,'static'=>$static]);
    }
    public function show($title)
    {
       $Product=Product::where('url',$title)->first();
       if($Product)
       {
           $Comment=Comment::where(['product_id'=>$Product->id,'state'=>1,'parent_id'=>0])->orderBy('id','DESC')->paginate(10);
           return View('site.show',['product'=>$Product,'Comment'=>$Comment]);
       }
       else
       {

         abort(404);
       }
    }
    public function addcart(Request $request)
    {
        if($request->has('product_id'))
        {
           $product_id=$request->get('product_id');
            if(Product::find($product_id))
            {
                if(Session::has('cart'))
                {
                    $array=Session::get('cart');
                    $array[$product_id]=1;
                    Session::put('cart',$array);

                }
                else
                {
                    $array=array();
                    $array[$product_id]=1;
                    Session::put('cart',$array);
                }

                return redirect('cart');
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    public function cart()
    {
        return View('site.cart');
    }
    public function comment(Requests\CommentRequest $request)
    {
        if($request->has('product_id'))
        {
            $product_id = $request->get('product_id');
            if (Product::find($product_id))
            {
                $Comment=new Comment($request->all());
                $Comment->state=0;
                $Comment->time=time();
                $Comment->save();
                return redirect()->back()->with('create','ok');
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    public function search(Request $request)
    {
        if($request->has('search_text'))
        {
            $text=$request->get('search_text');
            $Product=Product::orderBy('id','DESC')->where('title','LIKE','%'.$text.'%')->orWhere('content','LIKE','%'.$text.'%')->paginate(10);
            return View('site.search',['text'=>$text,'Product'=>$Product]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function menu($menu)
    {
       $cat=Category::where('ename',$menu)->first();
       if($cat)
       {
           $cat_product=DB::table('cat_product')->where('cat_id',$cat->id)->get();
           $array=array();
           foreach($cat_product as $key=>$value)
           {
               $array[$key]=$value->product_id;
           }
           $Product=DB::table('product')->orderBy('id','DESC')->whereIn('id',$array)->paginate(10);
           return View('site.menu',['Product'=>$Product]);

       }
        else
        {
            return View('404');
        }
    }
    public function zip_menu($menu,$zir_menu)
    {
        $cat=Category::where('ename',$menu)->first();
        if($cat)
        {
            $cat1=Category::where('ename',$zir_menu)->first();
            if($cat1)
            {
                if($cat->id==$cat1->parent_id)
                {
                    $cat_product=DB::table('cat_product')->where('cat_id',$cat1->id)->get();
                    $array=array();
                    foreach($cat_product as $key=>$value)
                    {
                        $array[$key]=$value->product_id;
                    }
                    $Product=DB::table('product')->orderBy('id','DESC')->whereIn('id',$array)->paginate(10);
                    return View('site.menu',['Product'=>$Product]);
                }
                else
                {
                    return View('404');
                }
            }
            else
            {
                return View('404');
            }
        }
        else
        {
            return View('404');
        }
    }
    public function del_cart(Request $request)
    {
       if($request->ajax())
       {
           $id=$request->get('id');
           if(array_key_exists($id,Session::get('cart')))
           {
               $array=Session::get('cart');
               unset($array[$id]);
               if(!empty($array))
               {
                   Session::put('cart',$array);
               }
               else
               {
                   Session::forget('cart');
               }

           }



if(empty(Session::get('cart')))
{
    ?><script>
    $("#order_box").hide()
</script><?php
}


           return View('site.ajaxcart');
       }

    }
    public function check_discounts(Request $request)
    {
        if($request->ajax())
        {
            $discounts=$request->get('discounts');
            $row=DB::table('discounts')->where('discounts_name',$discounts)->first();
            if($row)
            {

                Session::put('discounts',$row->discounts_value);
                return View('site.ajaxcart',['message'=>'کد تخفیف وارد شده صحیح می باشد']);
            }
            return View('site.ajaxcart',['message'=>'کد تخفیف وارد شده صحیح نمی باشد']);
        }

    }
    public function addorder(Requests\OrderRequest $request)
    {
        $Jdf=new Jdf();
        $date=$Jdf->tr_num($Jdf->jdate('Y-n-j'));
        $product_id=null;
        foreach(Session::get('cart') as $key=>$value)
        {
            $product_id.=$key.',';
        }
        $order=new Order($request->all());
        $order->date=$date;
        $order->time=time();
        $order->product_id=$product_id;
        $order->payment_status='معلق';
        $order->order_read='no';
        $order->price=Session::get('price');
        $order->total_price=Session::get('total_price');

        require_once 'app/lib/nusoap.php';

        $mellat=new mellat();
        $res=$mellat->pay(Session::get('price'));
        if($res)
        {
            $order->RefId=$res;
            if($order->save())
            {
                Session::forget('cart');
                Session::forget('price');
                Session::forget('total_price');
                return View('site.location',['res'=>$res]);
            }
            else
            {
                return View('site.location');
            }
        }
        else
        {
            return View('site.location');
        }

    }
    public function order(Request $request)
    {
        $RefId=$request->get('RefId');
        $ResCode=$request->get('ResCode');
        $SaleOrderId=$request->get('SaleOrderId');
        $SaleReferenceId=$request->get('SaleReferenceId');
        if($ResCode==0)
        {
            require_once 'app/lib/nusoap.php';
            $mellat=new mellat();
            if($mellat->Verify($SaleOrderId,$SaleReferenceId))
            {
                $order=Order::where('RefId',$RefId)->first();
                $order->saleReferenceId=$SaleReferenceId;
                $order->payment_status='پرداخت شده';
                $order->save();

                $product_id=$order->product_id;
                $product_id=explode(',',$product_id);
                $array=array();
                $time=time()+24*60*60;
                foreach($product_id as $key=>$value)
                {
                    if(!empty($value))
                    {
                        $product=Product::where('id',$value)->first();
                        $download=$product->download;
                        $string=md5($time.'/sdjfhsdjhg');
                        DB::table('download')->insert(['file'=>$download,'name'=>$string,'time'=>$time]);
                        $array[$key]=array('title'=>$product->title,'url'=>$string);
                    }
                }
              //  define('email',$order->email);
              //  define('name',$order->fname);
              //  Mail::send('auth/emails/link',['order'=>$array,'time'=>$order->time],function($message)
              //  {
                //    $message->to(email,name)->subject('ایده پردازان جوان');
              //  });

                return View('site.order',['order'=>$array,'time'=>$order->time]);
            }
            else
            {

            }
        }


    }
    public function get_file(Request $request)
    {
        if($request->has('url'))
        {
           $url=$request->get('url');
           $row=DB::table('download')->where('name',$url)->first();
            if($row)
            {
               if($row->time-time()>0)
               {
                   $file_path=$row->file;
                   return Response::download($file_path,'file.zip', [
                       'Content-Length: '. filesize($file_path)
                   ]);
               }
                else
                {

                }
            }
        }
    }


}
