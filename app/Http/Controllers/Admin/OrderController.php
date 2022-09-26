<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
   public function index(){

       $orders=Order::with('user')->paginate(15);

       return view('admin.order.index',compact('orders'));
   }
    public function review(Order $order)
    {
        return view('admin.order.review',compact('order'));
    }

    public function update(Order $order,Request $request)
    {
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success','Done');
    }


    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success','Done');
    }

}
