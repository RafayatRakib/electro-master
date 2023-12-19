<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class WishlistController extends Controller
{
    public function wishlist(){
        return view('frontend.dashboard.wishlist.wishlist');
    }//end method

    public function addWishlist($id){
        $id = decrypt($id);
        $ifExist = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
        if(!$ifExist){
            $w = new Wishlist();
            $w->user_id = Auth::id();
            $w->product_id = $id;
            $w->created_at = Carbon::now();
            $w->save();
            
            // Alert::success('Prodcut add to wishlist');
            toast('Prodcut add to wishlist','warning');
            return redirect()->back();
        }else{
            // Alert::warning('Product already wishlist');
            toast('Product already wishlist','warning');
            return redirect()->back();        
        }

    }//end method
}
