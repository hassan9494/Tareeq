<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\ProductVariation;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{

    public function index(){

        return view('frontend.'.setting('theme.site').'.freeTrial');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function freeDemo(Request $request)
    {
    //    dd($request);

        //validation
        $request->validate([
            // 'date' => 'required|date|after_or_equal:today',
            // 'time'=>'required',
            // 'product_id'=>'required', $table->string('name')->nullable();
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'age'=>'nullable',
            'gender'=>'nullable',
            'nationality'=>'nullable',
            'readArabic'=>'nullable',
            'whatsApp'=>'nullable',
            'knowUs'=>'nullable',
        ]);

        // $product = Product::find($request->product_id);
        $order =  new Order;
        $order->user_id = $request->input('user_id');
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->whatsApp = $request->input('whatsApp');
        $order->age = $request->input('age');
        $order->gender = $request->input('gender');
        $order->country = $request->input('country');
        $order->nationality = $request->input('nationality');
        $order->readArabic = $request->input('readArabic') ?? 'No';
        $order->course = $request->input('course');
        $order->knowUs = $request->input('knowUs');

        $order->save();
        // dd($order);
        return redirect('/')->with('success','Request Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frontend\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
