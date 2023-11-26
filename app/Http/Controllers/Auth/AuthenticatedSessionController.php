<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
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
        // // return redirect()->intended(RouteServiceProvider::HOME);

        // return redirect()->intended($url)->with($msg);



    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // $user = 0;
        if(Auth::user()->role === 'admin'){
            // $user = 1;
            $redirect = redirect()->route('admin.login.index');
        }elseif(Auth::user()->role === 'user'){
            // $user = 2;
            $redirect = redirect()->route('userLogin');
        }
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $redirect;
        // if($user = 1){
        //     return redirect()->route('admin.login.index');;
        // }elseif($user=2){
        //     return redirect()->route('login');
        // }
    }
}
