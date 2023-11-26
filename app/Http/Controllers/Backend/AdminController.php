<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function login(){
        return view('backend.pages.admin.login');
        // return view('backend.pages.dashboard');
    }//end method

    public function loginStore(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        

        if(Auth::user()->role === 'admin'){
         return redirect()->route('admin.dashboard');   
        }
        elseif(Auth::user()->role === 'user'){
            return redirect()->route('dashboard');   
        }
        
        // return redirect()->intended($url)->with($msg);
        // $url = '';
        // if($request->user()->role === 'admin'){
        //     $url = 'admin/dashboard';
        // }elseif($request->user()->role === 'user'){
        //     $url = 'dashboard';
        // }
        // $msg = [
        //     'message' => "Login successfuly!",
        //     'alert-type' => 'success',
        // ];
        // return redirect()->intended(RouteServiceProvider::HOME);

        // return redirect()->intended($url)->with($msg);
    }



    public function adminDashboard(){
        return view('backend.pages.dashboard');
    }//end method


}
