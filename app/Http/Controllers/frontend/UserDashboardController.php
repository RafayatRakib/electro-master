<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\userRegistrationMail;
use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
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



}
