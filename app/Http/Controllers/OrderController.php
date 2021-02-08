<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    public function index()
    {
        $order=Order::OrderBy('id','DESC')->paginate(10);
        return View('order.index',['order'=>$order]);
    }
    public function show($id)
    {
        $order=Order::find($id);
        $order->order_read='ok';
        $order->save();
        if($order)
        {
            return View('order.show',['order'=>$order]);
        }
        else
        {

        }
    }
    public function delete($id)
    {
        Order::find($id)->delete();
        return redirect()->back();
    }
}
