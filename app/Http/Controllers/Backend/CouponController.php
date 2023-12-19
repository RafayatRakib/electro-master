<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function allCoupon(){
        // $coupons = DB::table('coupons')->paginate(10);
        $coupons = Coupon::latest()->paginate(10);
        return view('backend.pages.coupon.all',compact('coupons'));
    }// end method

    public function AddCoupon(){
        $cat = Category::where('status','1')->get();
        return view('backend.pages.coupon.add',compact('cat'));
    }// end method

    public function CouponStore(Request $request){
        // dd($request);
        $request->validate([
            'coupon' => 'required',
            'discount_type' =>'required',
            'discount' =>'required',
            'minimum_purchase' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'restrictions' => 'required',
            'created_at' => Carbon::now(),
        ]);


        DB::table('coupons')->insert([
            'coupon_code' => strtoupper($request->coupon),
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'minimum_purchase' => $request->minimum_purchase,
            'start_date' => $request->start_date,
            'end_date' =>  $request->end_date,
            'restrictions' => $request->restrictions,
        ]);

        session()->flash('success','Coupon added successfuly');
        toast('Coupon added succesfully','success');
        
        return redirect()->route('admin.all.coupon');
    }//end method


    public function couponEdit($id){
        $coupon = Coupon::findOrFail($id);
        $cat = Category::where('status','1')->get();
        return view('backend.pages.coupon.edit',compact('coupon','cat'));
    }//end method

    public function couponUpdate(Request $request){

        Coupon::findOrFail($request->id)->update([
            'coupon_code' => strtoupper($request->coupon),
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'minimum_purchase' => $request->minimum_purchase,
            'start_date' => $request->start_date,
            'end_date' =>  $request->end_date,
            'restrictions' => $request->restrictions,
        ]);
        session()->flash('success','Coupon update successfuly');
        return redirect()->route('admin.all.coupon');
    }//end method


    public function couponStatus($id){
        $coupon = Coupon::findOrfail($id);
        if($coupon->status == '1'){
            $coupon->status = 0;
            $coupon->update();
            session()->flash('error','Coupon deactived successfuly');
            return redirect()->route('admin.all.coupon');
        }else{
            $coupon->status = 1;
            $coupon->update();
            session()->flash('success','Coupon actived successfuly');
            return redirect()->route('admin.all.coupon');
        }
    }//end method


    public function couponDelete(Request $request){
        Coupon::findOrFail($request->delete_id)->delete();
        session()->flash('error','Coupon deleted successfuly');
        return redirect()->route('admin.all.coupon');
    }//end method




}
