<?php

namespace App\Http\Controllers\Frontend;

use App\Admin;
use App\Country;
use App\Mail\SendOrderToSeller;
use App\Mail\SendOrderToUser;
use App\Models\Package;
use App\Models\ProductVariation;
use App\Models\Voucher;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use function GuzzleHttp\Promise\all;

class PayPalController extends Controller
{
    public function payment(Request $request)
    {
        //        dd($request->all());
        $request->validate([
            'months' => 'required|integer|min:1',
            'package_id' => 'required'
        ]);
        $package  = Package::find($request->package_id);
        $price = $package->total_price;
        if ($request->months >= 6 && $request->months < 12) {
            $price = ($package->total_price * $request->months) - (($package->total_price * $request->months * ($package->Months6 / 100)));
        } elseif ($request->months >= 12) {
            $price = ($package->total_price * $request->months) - (($package->total_price * $request->months * ($package->Months12 / 100)));
        } elseif ($request->months < 6) {
            $price = $package->total_price * $request->months;
        }
        // dd($price);

        $data = [];
        $data['items'][] = [
            'name' => $package->id,
            'desc' => $package->total_price . ' Per Month',
            'price' => $price,
        ];

        $data['invoice_id'] = 230;
        $data['invoice_description'] =  $request->months;
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $price;
        $data['package'] = $package->id;

        $provider = new ExpressCheckout;



        $response = $provider->setExpressCheckout($data, true);
        // dd($response);
        //
        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return redirect('/')->with('error', 'Your Payment Is Canceled.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        // dd($request);
        $response = PayPal::getProvider()->getExpressCheckoutDetails($request->token);
        $package = Package::find($response['L_NAME0']);
        $months = $response['PAYMENTREQUEST_0_DESC'];
        $price = $response['L_AMT0'];

        //        dd($voucher);
        $data = [];
        $data['items'][] = [
            'name' => $package->id,
            'desc' => $package->total_price . ' Per Month',
            'price' => $price,
        ];
        $user = auth()->user();
        $voucher = Voucher::Create([
            'type' => 'income',
            'amount' => $price,
            'paid_for' => $months . ' Months / ' . $package->packageTime->time . 'Min/' . $package->classes . 'Class Per Month',
            'user_id' => $user->id,
            //            'package_id' => $package->id
        ]);

        $data['invoice_id'] = $voucher->id + 10000;
        $data['invoice_description'] =  $request->months;

        //        $data['invoice_description'] = "Request #{$data['invoice_id']} Invoice";
        $data['total'] = $price;
        $provider = new ExpressCheckout;
        $PayerID = $request->PayerID;
        $response = $provider->getExpressCheckoutDetails($request->token);
        $response = $provider->doExpressCheckoutPayment($data, $request->token, $PayerID);

        $user->classes = $package->classes * $months;
        $user->paid = +$price;
        $user->save();
        $email = auth::user()->email;
        //send mail to all admins
        $admins = Admin::all();
        $adminsMail = [];
        foreach ($admins as $admin) {
            array_push($adminsMail, $admin->email);
        }
        Mail::to($email)->bcc($adminsMail)->send(new SendOrderToUser($voucher));
        //        $sellerProducts = $order->products->where('user_id', '!==', null);
        //        if ($sellerProducts->count() > 0){
        //            foreach ($sellerProducts as $product) {
        //                Mail::to($product->user->email)->send(new SendOrderToSeller($order, $product));
        //            }
        //        }
        return redirect('/')->with('success', 'Payment Completed successfully');
    }
}
