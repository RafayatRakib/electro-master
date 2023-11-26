<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Order_item;
use App\Models\Product;

use Illuminate\Support\Carbon;


class paymentController extends Controller
{
    public function payment(){

        $tran_id = "test".rand(1111111,9999999);//unique transection id for every transection 

        $currency= "BDT"; //aamarPay support Two type of currency USD & BDT  

        $amount = "10";   //10 taka is the minimum amount for show card option in aamarPay payment gateway
        
        //For live Store Id & Signature Key please mail to support@aamarpay.com
        $store_id = "aamarpaytest"; 

        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183"; 

        $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "store_id": "'.$store_id.'",
            "tran_id": "'.$tran_id.'",
            "success_url": "'.route('success').'",
            "fail_url": "'.route('fail').'",
            "cancel_url": "'.route('cancel').'",
            "amount": "'.$amount.'",
            "currency": "'.$currency.'",
            "signature_key": "'.$signature_key.'",
            "desc": "Merchant Registration Payment",
            "cus_name": "Name",
            "cus_email": "payer@merchantcusomter.com",
            "cus_add1": "House B-158 Road 22",
            "cus_add2": "Mohakhali DOHS",
            "cus_city": "Dhaka",
            "cus_state": "Dhaka",
            "cus_postcode": "1206",
            "cus_country": "Bangladesh",
            "cus_phone": "+8801704",
            "type": "json"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        
        $responseObj = json_decode($response);

        if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

            $paymentUrl = $responseObj->payment_url;
            // dd($paymentUrl);
            return redirect()->away($paymentUrl);

        }else{
            echo $response;
        }



    }

    public function success(Request $request){
        // dd(session()->get('orderItem'));
        // dd($request);

        $cart = explode(", ", $request->opt_a);

        $address = Address::where('user_id',Auth::id())->first();
        // $address = Address::where('user_id',$request->cus_name)->first();
        $order = new Order();
        $order->user_id = Auth::id();
        $order->address_id = $address->id;
        $order->email = $address->email?? Auth::user()->email;
        // $order->email = $address->email?? Auth::user()->email;
        $order->payment_method = 'online';
        $order->payment_type = $request->card_type;
        $order->card_number = $request->card_number;
        $order->transaction_id = $request->mer_txnid;
        $order->currency = $request->currency;
        $order->total_amount = $request->amount;
        $order->total_discount = $request->opt_c??0;
        $order->delevarycharge = $request->opt_d??0;
        $order->order_number = 'ORD-' . str_pad(rand(0, 999999999), 8, '0', STR_PAD_LEFT);
        $order->invoice_no = 'INV-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $order->order_date = Carbon::now();
        $order->save();
        $orderID = $order->id;
        foreach($cart as $cart){
            $cartData = Cart::findOrFail($cart);
            $product = Product::findOrFail($cartData->product_id);

            $order = new Order_item();
            $order->order_id  = $orderID;
            $order->product_id = $cartData->product_id;
            $order->user_id = Auth::id();
            $order->color = $cartData->color??'';
            $order->size = $cartData->size??'';
            $order->qty = $cartData->qty;
            $order->price = $product->product_price;
            $order->discount = $product->product_discount??0;
            $order->save();
            $product->qty = $product->qty - $cartData->qty;
            $product->update();
            $cartData->delete();
        }
        dd('Order success');

        // $request_id= $request->mer_txnid;


    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }
}