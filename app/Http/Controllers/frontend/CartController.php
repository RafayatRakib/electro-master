<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Jobs\OrderConfirmationJob;
use App\Mail\OrderConfirmationMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\ReturnReson;
use App\Models\Review;
use App\Models\Review_photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductReturn;
use App\Models\ReturnImages;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $url = $request->currentUrl;
        if(!Auth::user()){
            // dd($url);
            // if(session()->get('back_url') == $url){
            //     return redirect()->route('userLogin');
            // }else{
            //     session()->put('back_url',$url);
            //     return redirect()->route('userLogin');
            // }
            session()->put('back_url',$url);
            return redirect()->route('userLogin');
        }

        $rowId = decrypt($request->product_id); 

        if($request->color){
            $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $rowId)
            ->where('color', $request->color)
            ->first();

            if ($cart) {
                $cart->color = $request->color;
                if ($request->qty) {
                    $cart->qty += $request->qty;
                }
                $cart->update();
                $msg = 'Cart quantity updated';
            }else {
                // No matching cart item found, so create a new one
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->product_id = $rowId;
                $cart->qty = $request->qty;
                $cart->color = $request->color;
                $cart->save();
                $msg = 'New item added to the cart';
            }


        }elseif($request->size){
            $cart = Cart::where('user_id',Auth::id())
            ->where('product_id',$rowId)
            ->where('size',$request->size)
            ->first();

            if ($cart) {
                if ($request->qty) {
                    $cart->qty += $request->qty;
                }
                $cart->update();
                $msg = 'Cart quantity updated';
            }else {
                // No matching cart item found, so create a new one
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->product_id = $rowId;
                $cart->qty = $request->qty;
                $cart->size = $request->size;
                $cart->save();
                $msg = 'New item added to the cart';
            }
        }elseif($request->color && $request->size){
            $cart = Cart::where('user_id',Auth::id())
            ->where('product_id',$rowId)
            ->where('color',$request->color)
            ->where('size',$request->size)
            ->first();

            if ($cart) {
                if ($request->qty) {
                    $cart->qty += $request->qty;
                }
                $cart->update();
                $msg = 'Cart quantity updated';

            }else {
                // No matching cart item found, so create a new one
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->product_id = $rowId;
                $cart->qty = $request->qty;
                $cart->size = $request->size;
                $cart->color = $request->color;
                $cart->save();
                $msg = 'New item added to the cart';
            }
        }elseif(!$request->color && !$request->size){
            $cart = Cart::where('user_id',Auth::id())->where('product_id',$rowId)->first();
            if ($cart) {
                if ($request->qty) {
                    $cart->qty += $request->qty;
                }
                $cart->update();
                $msg = 'Cart quantity updated';

            }else {
                // No matching cart item found, so create a new one
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->product_id = $rowId;
                $cart->qty = $request->qty;
                $cart->save();
                $msg = 'New item added to the cart';
            }
        }
        else{
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $rowId;
        $cart->qty = $request->qty;
        if($request->color){
            $cart->color = $request->color;
        }
        if($request->size){
            $cart->size = $request->size;
        }
        $msg = 'New item added to the cart';
        $cart->save();
    }
    // if(session()->get('back_url')){
    //     session()->delete('back_url');
    // }
        session()->flash('success',$msg);
        return redirect()->back();
    }//end method

    public function mycart(){
        return view('frontend.dashboard.cart');
    }//end method

    public function get_cart_data(){
        $cart = Cart::where('user_id',Auth::id())->with('product')->latest()->get();
        $Cartitem = count($cart);
        $currency = Currency::where('status','active')->first();
        return response()->json(['cart'=> $cart, 'cartItem'=>$Cartitem,'currency'=>$currency]);
    }//end method

    public function cart_item_delete(Request $request){
        // $cart = Cart::findOrFail($request->id)->delete();
        return response()->json(['response'=> 'Item Removed']);
    }//end method

    // public function itemWisePrice(Request $request){

    //     $totalPrice = 0;
    //     $totalDlevery = 0;
    //     $totalDiscount = 0;
    //     foreach($request->id as $id){
    //         $cart = Cart::findOrFail($id);
    //         $product = Product::findOrFail($cart->product_id);
    //         $address = Address::where('status','active')->first();
    //         $value = $product->product->product_discount ? $product->product->product_price - $product->product->product_discount : $product->product->product_price; 
    //         $totalPrice += $value * $cart->qty; 
    //         $totalDlevery += $address->district->delivery_charge * $cart->qty;
    //         $totalDiscount += $product->product->product_discount? $product->product->product_discount * $cart->qty : 0;
    //     }


    //     return response()->json(['totalPrice'=>$totalPrice,'totalDlevery'=>$totalDlevery,'totalDiscount'=>$totalDiscount]);
    // }//end method


    public function itemWisePrice(Request $request){
        try {
            $totalAmount = 0;
            $totalDlevery = 0;
            $totalDiscount = 0;

            foreach ($request->id as $id) {
                $cart = Cart::findOrFail($id);
                $product = Product::findOrFail($cart->product_id);
                $address = Address::where('status', 'active')->first();
                $discount = $product->product_discount ?? 0;
                $price = $product->product_price - $discount;
                $totalAmount += $price * $cart->qty; 
                $totalDlevery += $address->district->delivery_charge * $cart->qty;
                $totalDiscount += $discount * $cart->qty;
            }
    
            return response()->json([
                'totalAmount' => $totalAmount,
                'totalDlevery' => $totalDlevery,
                'totalDiscount' => $totalDiscount,
                'currency' => Currency::where('status','active')->first()
            ]);
        } catch (\Exception $e) {
            // Handle errors, log them, and return an appropriate error response.
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
    
    public function checkout(Request $request){
        $request->validate([
            'payment' => 'required'
        ]);
        $totalAmount = $request->totalAmount;
        $totalDlevery = $request->totalDlevery;
        $cartData = $request->cartcheckbox;
        $payment = $request->payment;
        $totalDiscount = $request->totalDiscount;
        // dd($cartData);
        // $json = json_decode($cartData);
        $orderItem = [];
        foreach($cartData as $item){
            $product = Cart::findOrFail($item);
            $orderItem[] = $product->product_id;
            // $orderItem[] = $item;
        }
        // dd($orderItem);

        session()->put([
            
            'totalAmount' => $totalAmount,
            'totalDlevery' => $totalDlevery,
            'totalDiscount' => $totalDiscount,
            'cartData' => $cartData,
            'payment' => $payment,
            'orderItem' => $orderItem,
        ]);
        return view('frontend.dashboard.confirm_order',compact('totalAmount','totalDlevery','cartData','payment','totalDiscount'));

    }//end method


    public function order_confirmed(Request $request){

        // dd($request);
        if(session()->has('payment') && session()->get('payment') === 'cash'){
            // dd($d);
        
            $request->validate([
            'read_and_accept' => 'required'
        ], [
            'read_and_accept.required' => 'You must read and accept the terms.'
            ]);
        }
        $cart = session()->get('cartData');
        $address = Address::where('user_id',Auth::id())->first();
        $currency = Currency::where('status','active')->first();

        $order = new Order();
        $order->user_id = Auth::id();
        $order->address_id = $address->id;
        $order->email = $address->email?? Auth::user()->email;
        $order->phone = $address->mobile_number?? Auth::user()->phone;
        $order->payment_method = session()->get('payment');
        $order->payment_type = 'COD';
        $order->currency = $currency->currency;
        $order->total_amount = $request->totalAmount;
        $order->total_discount = $request->totalDiscount??0;
        $order->delevarycharge = $request->totalDlevery??0;
        $orderNumber = 'ORD-' . str_pad(rand(0, 999999999), 8, '0', STR_PAD_LEFT);
        $order->order_number = $orderNumber; 
        $order->order_number = 'ORD-' . str_pad(rand(0, 999999999), 8, '0', STR_PAD_LEFT);
        $order->invoice_no = 'INV-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $order->order_date = Carbon::now();
        $order->save();
        $orderID = $order->id;
        $orderID = 1;
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

        $maildata = [
            'email' => $address->email??Auth::user()->email,
            'totalAmount' => $request->amount,
            'orderNumber'=> $orderNumber,
            'orderDate' => Carbon::parse(Carbon::now())->format('d M Y'),
            'address' => $address->address.','.$address->upazila->upazila_name.','.$address->district->district_name,
            'customerName' => $address->name??Auth::user()->name,
            'payment' => $request->card_type??'Cash',
            'currency' => $currency->currency_symbol
        ];

        // Mail::to($maildata['email'])->send(new OrderConfirmationMail($maildata));

        dispatch(new OrderConfirmationJob($maildata));
        session()->flash('success','Order succesfully placed');
        return redirect()->route('dashboard');

    }//end method




    //amar pay payment start


    public function success(Request $request){
        // dd(session()->get('orderItem'));
        // dd($request);

        $cart = explode(",", $request->opt_a);

        // dd($cart);

        $address = Address::where('user_id',Auth::id())->first();
        $currency = Currency::where('status','active')->first();

        // $address = Address::where('user_id',$request->cus_name)->first();
        $order = new Order();
        $order->user_id = Auth::id();
        $order->address_id = $address->id;
        $order->email = $address->email?? Auth::user()->email;
        $order->phone = $address->mobile_number?? Auth::user()->phone;
        $order->payment_method = 'online';
        $order->payment_type = $request->card_type;
        $order->card_number = $request->card_number;
        $order->transaction_id = $request->mer_txnid;
        $order->currency = $request->currency;
        $order->total_amount = $request->amount;
        $order->total_discount = $request->opt_c??0;
        $order->delevarycharge = $request->opt_d??0;
        $orderNumber = 'ORD-' . str_pad(rand(0, 999999999), 8, '0', STR_PAD_LEFT);
        $order->order_number = $orderNumber; 
        $order->invoice_no = 'INV-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $order->order_date = Carbon::now();
        $order->save();
        $orderID = $order->id;

        foreach($cart as $cartID){
            $cartData = Cart::findOrFail($cartID);
            $product = Product::findOrFail($cartData->product_id);
        
            $orderItem = new Order_item();
            $orderItem->order_id  = $orderID;
            $orderItem->product_id = $cartData->product_id;
            $orderItem->user_id = Auth::id();
            $orderItem->color = $cartData->color??'';
            $orderItem->size = $cartData->size??'';
            $orderItem->qty = $cartData->qty;
            $orderItem->price = $product->product_price;
            $orderItem->discount = $product->product_discount??0;
            $orderItem->save();
            $product->qty = $product->qty - $cartData->qty;
            $product->update();
            $cartData->delete();
        }
        $maildata = [
            'email' => $address->email??Auth::user()->email,
            'totalAmount' => $request->amount,
            'orderNumber'=> $orderNumber,
            'orderDate' => Carbon::parse(Carbon::now())->format('d M Y'),
            'address' => $address->address.','.$address->upazila->upazila_name.','.$address->district->district_name,
            'customerName' => $address->name??Auth::user()->name,
            'payment' => $request->card_type,
            'currency' => $currency->currency_symbol
        ];
        // Mail::to($maildata['email'])->send(new OrderConfirmationMail($maildata));

        dispatch(new OrderConfirmationJob($maildata));

        session()->flash('success','Order succesfully placed');
        return redirect()->route('dashboard');
    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }

    //aamar pay payment end




    public function my_orders(){
        $order = Order::paginate(8);
        $currency = Currency::where('status','active')->first();
        return view('frontend.dashboard.order',compact('order','currency'));
    }//end method


    public function order_details($id){
        $id = decrypt($id);
        
        $order = Order::findOrFail($id);
        $orderItem = Order_item::where('order_id',$id)->get();
        $currency = Currency::where('status','active')->first();
        $totalItem = 0;
        foreach ($orderItem as $value) {
          $totalItem += 1;
        }
        // dd($orderItem);
        return view('frontend.dashboard.order_details',compact('order','orderItem','currency','totalItem'));
    }//end method


    public function RatingProduct($id) {
       $id = decrypt($id);
       $product = Product::findOrFail($id);
       $review = Review::where('product_id',$id)->latest()->paginate(15);
       return view('frontend.dashboard.rate',compact('product','review'));
    }//end method

    public function orderReturn($oid,$pid){
        // dd(decrypt($pid),decrypt($oid));
        $product = Product::findOrFail(decrypt($pid));
        $order = Order::findOrFail(decrypt($oid));
        $returnReson = ReturnReson::where('status','active')->get();
        return view('frontend.dashboard.return',compact('product','order','returnReson'));

    }//end method

    public function submitReturn(Request $request){
        $request->validate([
            'returnReason'=> 'required',
            // 'comments'=> 'required',
            'return_images'=> 'required',
        ]);

        $return = new ProductReturn();
        $return->user_id = Auth::id();
        $return->order_id = $request->order_id;
        $return->product_id = $request->product_id;
        $return->return_reson_id = $request->returnReason;
        $return->user_note = $request->comments??null;
        $return->process_date = Carbon::now();
        $return->status = 'process';
        $return->save();
        $return_id = $return->id;

        if ($request->hasFile('return_images')) {
            $imgs = $request->file('return_images');
            foreach ($imgs as $file) {
                if ($file->isValid()) {
                    $newName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = public_path('uploads/return/' . $newName);
                    try {
                        // Resize and save the image
                        Image::make($file)->resize(600, 400)->save($path);
        
                        // Save the image path to the database
                        $return_images = new ReturnImages();
                        $return_images->return_id = $return_id;
                        $return_images->return_images = 'uploads/return/' . $newName;
                        $return_images->save();
                    } catch (\Exception $e) {
                        // Handle any exceptions or errors during the process
                        // Log or display an error message
                        return $e->getMessage();
                    }
                } else {
                    // Handle invalid files, if any
                    session()->flash('success','Invalid file uploaded.!');
                    return redirect()->back();
                }
            }
        
        
        }
        session()->flash('success','Return request added successfuly!');
        return redirect()->back();

    }//end method




}
