<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\userRegistrationMail;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\User;
use App\Models\ProductReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;

class UserDashboardController extends Controller
{
    public function dashboard(){
        $currency = Currency::where('status','active')->first();
        $order = Order::where('user_id', Auth::id())->latest('created_at')->limit(3)->get();
       return view('frontend.dashboard.dashboard',compact('order','currency')); 
    }//end method

    public function userAddress(){
        return view('frontend.dashboard.myaddress');
    }//end method

    public function my_return(){
        $currency = Currency::where('status','active')->first();
        $return = ProductReturn::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('frontend.dashboard.return.myreturn',compact('currency','return'));
    }//end method

    public function return_details($id){
        $id = decrypt($id);
        $return = ProductReturn::findOrFail($id);
        $orderItem = Order_item::where('order_id',$return->order_id)->where('product_id',$return->product_id)->where('user_id',Auth::id())->first();
        $currency = Currency::where('status','active')->first();
        return view('frontend.dashboard.return.returnDetails',compact('currency','return','orderItem'));

    }//end method

}
