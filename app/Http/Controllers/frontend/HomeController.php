<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactAndSocial;
use App\Models\Currency;
use App\Models\LogonAndName;
use App\Models\Multi_photo;
use App\Models\NewsLetter;
use App\Models\Order_item;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(){
        // $contact = ContactAndSocial::where('status', 'active')->first();
        // $currency =Currency::where('status','active')->get();
        // $logo =  LogonAndName::where('status','active')->first();

        $currencies = Cache::remember('currency', 30, function () {
            // Fetch currencies from the source (e.g., database, API)
            return Currency::where('status','active')->first(); // Replace this with your actual fetching logic
        });

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


    public function search(Request $request){
        // dd($request);

        $searchInput = $request->input('search_input');
        $categoryId = $request->input('search_category');
    
        $query = Product::query();
    
        if ($categoryId && $categoryId != 0) {
            $query->where('cat_id', $categoryId);
        }
    
        // if i use this method this way is this work:
        if ($searchInput) {
            $query->where(function ($q) use ($searchInput) {
                $q->where('product_name', 'like', '%' . $searchInput . '%')
                    ->orWhere('short_des', 'like', '%' . $searchInput . '%')
                    ->orWhere('long_des', 'like', '%' . $searchInput . '%')
                    ->orWhere('details', 'like', '%' . $searchInput . '%');
            });
        }
        $results = $query->get();
        // dd($results);

        $product = $results;
        $currency = Currency::where('status','active')->first();
        $cat = Category::where('status',1)->inRandomOrder()->limit(10)->get();
        $brand = Brand::where('status',1)->inRandomOrder()->limit(10)->get();
        $id = null;
        $request->session()->flash('search_input', $request->input('search_input'));
        return view('frontend.search',compact('product','currency','cat','brand','id'));
        

    }//end method

    // pages controller

    public function pages($slug){
        $page = Pages::where('slug',$slug)->where('status','active')->first();
        if($page){
            return view('frontend.pages.blank_pages',compact('page'));
        }else{
            return view('errors.404');

        }
    }//end method


   public function news_letter(Request $request){
    // dd($request);
    $request->validate([
        'news_letter' => 'required|email'
    ],
    [
        'news_letter.email' => "Insert a valid email"
    ]);
    // $d = request()->header('User-Agent');
    // $d =  $request->ip();
    // dd($d);
    $userEmail = User::where('email',$request->news_letter)->first();
    $newsLetter = NewsLetter::where('email',$request->news_letter)->first();
    if($userEmail || $newsLetter){
        toast('Email already exiest','warning');
        return redirect()->back();
    }else{
        $news_etter = new NewsLetter();
        $news_etter->email = $request->news_letter;
        $news_etter->ip = $request->ip();
        $news_etter->save();
        toast('Email saved to News letter, you can get update now','Success');
        return redirect()->back();
    }

   }//end method




}
