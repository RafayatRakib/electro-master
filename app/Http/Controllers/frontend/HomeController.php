<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactAndSocial;
use App\Models\Currency;
use App\Models\LogonAndName;
use App\Models\Multi_photo;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class HomeController extends Controller
{
    public function index(){
        // $contact = ContactAndSocial::where('status', 'active')->first();
        // $currency =Currency::where('status','active')->get();
        // $logo =  LogonAndName::where('status','active')->first();
        
        return view('frontend.index');
    }// end method

    public function productDetails($id,$slug){
        $product = Product::findOrFail($id);
        $cat_wise_product = Product::where('cat_id',$product->cat_id)->inRandomOrder()->limit(8)->get();
        $product_photo = Multi_photo::where('product_id',$id)->get();
        $currency = Currency::where('status','active')->first();
        $review = Review::where('product_id',$id)->get();
        $isPurches = Order_item::where('user_id',Auth::id())->where('product_id',$id)->first();

        $totalPerson = count($review);
        $totalRating = 0;
        foreach($review as $item){
            $totalRating+=$item->rating;
        }
        return view('frontend.product_details',compact('product','cat_wise_product','product_photo','currency','review','totalRating','totalPerson','isPurches'));
    }//end method



    public function cat_wiseProduct($cat_slug){
        // dd('cat wise product showing here');
        $category = Category::where('cat_slug',$cat_slug)->first();
        $product = Product::where('cat_id',$category->id)->paginate(21);
        $currency = Currency::where('status','active')->first();
        $cat = Category::where('status',1)->inRandomOrder()->limit(10)->get();
        $brand = Brand::where('status',1)->inRandomOrder()->limit(10)->get();
        $id = $category->id;
        return view('frontend.cat_wise_product.cat_wise_product',compact('category','product','currency','cat','brand','id'));
    }//end method

    public function rendering_cat_wiseProduct(Request $request){
        // dd('cat wise product showing here');
        $category = Category::findOrFail($request->cat_id);
        $product = Product::where('cat_id',$request->cat_id)->paginate(21);
        $id = $request->cat_id;
        // $currency = Currency::where('status','active')->first();
        // $cat = Category::where('status',1)->inRandomOrder()->limit(6)->get();
        // $brand = Brand::where('status',1)->inRandomOrder()->limit(6)->get();
        // return view('frontend.cat_wise_product',compact('category','product','currency','cat','brand','id'))->render();
        return view('frontend.cat_wise_product.cat_render_product',compact('product','category','id'))->render();

        // return response()->json($request->cat_id);
    }//end method


    public function cat_wiseProduct_search(Request $request){
        $product = Product::whereBetween('product_price',[$request->priceMin,$request->priceMax])->where('cat_id',$request->cat_id)->paginate(21);
        $category = Category::findOrFail($request->cat_id);
        $id = $request->cat_id;
        return view('frontend.cat_wise_product.cat_render_product',compact('product','category','id'))->render();

    }//end method 

    public function brand_wiseProduct_search(Request $request){
        $product = Product::where('cat_id',$request->cat_id)->where('brand_id',$request->brand_id)->paginate(21);
        $id = $request->cat_id;
        $category = Category::findOrFail($request->cat_id);
        return view('frontend.cat_wise_product.cat_render_product',compact('product','category','id'))->render();

    }//end method
}
