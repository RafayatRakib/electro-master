<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\UserRegistraisonJob;
use Illuminate\Http\Request;
use App\Mail\userRegistrationMail;
use App\Models\Address;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use Svg\Tag\Rect;

class UserController extends Controller
{
    public function userRegistration(){
        return view('frontend.dashboard.userRegistration');
    }//end method
    public function userRegistrationStore(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            // 'password' => 'required|min:6|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])/',
            'terms_and_Policy' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        $maildata =[
            'name' => $request->name,
            'email' => $request->email,
            'body' => '<p>Thank you for join us. Your account has been successfully created.</p> 
            <p>You can now log in and start using our services.</p>
            <p>If you did not create this account, please contact us immediately at [Contact Email].</p>
            <p>Thank you for choosing our platform!</p>'
        ];
        // Mail::to($request->email)->send(new userRegistrationMail($maildata));

        dispatch(new UserRegistraisonJob($maildata));

        return redirect(RouteServiceProvider::HOME);
    }//end method

    // add to cart https://www.youtube.com/watch?v=EvbVRDV-5CY

    
    public function userLogin(){
        return view('frontend.dashboard.userLogin');
    }//end method

    public function userLoginStore(LoginRequest $request){
        $back_route_name = session()->get('back_url');

        $request->authenticate();
        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        if($back_route_name){
            session()->flash('success','You are now login, please order or add to cart now');
            return redirect()->to($back_route_name);
        }

        if(Auth::user()->role === 'admin'){
         return redirect()->route('admin.dashboard');   
        }
        elseif(Auth::user()->role === 'user'){
            return redirect()->route('dashboard');   
        }
    }//end method

    public function logout(){
        $user = 0;
        if(Auth::user()->role == 'admin'){
            $user = 1;
        }elseif(Auth::user()->role == 'user'){
            $user = 2;
        }
        Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        if($user = 1){
            return redirect()->route('admin.login.index');
        }elseif($user=2){
            return redirect('/login');
        }
    }//end method

    public function addAddress(){
        // $a = Hash::make(123456789);
        // dd($a);
        $division = Division::where('status',1)->get();
        return view('frontend.address.add_address',compact('division'));
    }//end method

    public function getDistrict($id){
        $district = District::where('division_id',$id)->get();
        return response()->json(['district' => $district]);
    }//end method

    public function getUpazila($id){
        $upazila = Upazila::where('district_id',$id)->get();
        return response()->json(['upazila' => $upazila]);
    }//end method

    public function StoreAddress(Request $request){
        $request->validate([
            'name' => 'required',
            'mobile_number' => 'required|min:11',
            'address' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
        ]);
        // dd($request);
        $address = new Address();
        $address->name = $request->name;
        $address->mobile_number = $request->mobile_number;
        $address->user_id = Auth::id();
        $address->division_id = $request->division;
        $address->district_id = $request->district;
        $address->upazila_id = $request->upazila;
        $address->address = $request->address;
        if($request->address_lable){
            $address->address_type = $request->address_lable;
        }
       $address->save();
       session()->flash('success','Address added');
       return redirect()->route('user.address');
       
    }//end method

    public function addressEdit($id){
        $address = Address::findOrfail($id);
        $division = Division::all();
        return view('frontend.address.edit_address',compact('address','division'));
    }//end method

    public function UpdateAddress(Request $request){
        $request->validate([
            'name' => 'required',
            'mobile_number' => 'required|min:11',
            'address' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
        ]);
        // dd($request);
        $address = Address::findOrfail($request->id);
        if($request->name){   
            $address->name = $request->name;
        }
        if($request->mobile_number){
            $address->mobile_number = $request->mobile_number;
        }
        if($request->division){
            $address->division_id = $request->division;
        }
        if($request->district){
            $address->district_id = $request->district;
        }
        if($request->upazila){
            $address->upazila_id = $request->upazila;
        }
        if($request->address){
            $address->address = $request->address;
        }
        if($request->address_lable){
            $address->address_type = $request->address_lable;
        }
       $address->update();
       session()->flash('success','Address Updated');
       return redirect()->route('user.address');
    }//end method

    public function addresDelete(Request $request){
        Address::findOrFail($request->delete_id)->delete();
       session()->flash('success','Address deleted');
        return redirect()->back();
    }//end method








    public function addressStatus($id){
        $address = Address::findOrFail($id);
        if($address->status == 'active'){
            $address->status = 'inactive';
            $address->update();
            session()->flash('success','Inactived');
            return redirect()->back();
        }else{
            $address->status = 'active';
            $address->update();
            session()->flash('success','Actived');
            return redirect()->back();
        }
    }//end method






}
