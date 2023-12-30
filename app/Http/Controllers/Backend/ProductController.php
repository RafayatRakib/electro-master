<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSales;
use App\Models\FlashSalesProduct;
use App\Models\Inventory;
use App\Models\Multi_photo;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function allProduct(){

    //    $allProducts = DB::table('products')
    // ->orderByDesc('created_at')
    // ->paginate(20);



        $allProducts = Product::latest()->paginate(20);
        return view('backend.pages.product.all',compact('allProducts'));
    }//end method

    public function AddProduct(){   
        $cat = Category::where('status','1')->get();
        $brand = Brand::where('status','1')->get();
        return view('backend.pages.product.add',compact('cat','brand'));
    }//end method

    public function productStore(Request $request){
        $request->validate([
            'product_name' => 'required',
            // 'product_size' => 'required',
            // 'product_color' => 'required',purchase_price
            'short_des' => 'required',
            'long_des' => 'required',
            'details' => 'required',
            // 'purchase_price' => 'required',
            // 'product_price' => 'required|numeric|gt:purchase_price',
            'product_price' => 'required',
            'qty' => 'required|numeric',
            'qty_warning' => 'nullable|numeric|min:3',
            'product_photo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'brand' => 'required',
            'category' => 'required',
        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->cat_id = $request->category;
        $product->brand_id = $request->brand;
        $product->product_slug = strtolower(str_replace(' ','-',$request->product_name));
        if($request->product_size){
            $product->size = $request->product_size;
        }
        if($request->product_color){

            $product->color = $request->product_color;
        }
        $product->short_des = $request->short_des;
        $product->long_des = $request->long_des;
        $product->details = $request->details;
        if($request->purchase_price){
            $product->purchase_price = $request->purchase_price;
        }
        $product->product_price = $request->product_price;
        if($product->product_discount){
            $product->product_discount = $request->product_discount;
        }else{
            $product->product_discount = 0;
        }
        if($request->product_code){
            $product->product_code =    $request->product_code;
        }else{
            $product->product_code =   round(rand()* 0.00003);
        }
        $product->qty = $request->qty;
        if($request->qty_warning){
            $product->qty_warning = $request->qty_warning;
        }else{
            $product->qty_warning = 3;
        }
        $product->long_des = $request->long_des;
        if($request->hot_deals){
            $product->hot_deals = 1;
        }else{
            $product->hot_deals = 0;
        }

        if($request->special_offer){
            $product->special_offer =  1;
        }else{
            $product->special_offer = 0;
        }

        if($request->featured){
            $product->featured =  1;
        }else{
            $product->featured = 0;
        }

        if($request->hasFile('product_photo')){
            $file = $request->file('product_photo');
            $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/product/'.$newName);
            Image::make($file)->resize(600,600)->save($path);
            $product->product_photo = 'uploads/product/'.$newName;
        }
        $product->save();
        $productid = $product->id;
        $inventory =  new Inventory();
        $inventory->product_id = $productid;
        $inventory->qty =  $request->qty;
        $inventory->save();

        if ($request->hasFile('product_multi_photo')) {
            $img = $request->file('product_multi_photo');
            
            foreach ($img as $file) {
                $newName = Str::uuid().'.'.$file->getClientOriginalExtension();
                $path = public_path('uploads/multiple_images/'.$newName);
                
                // Resize and save the image
                Image::make($file)->resize(600, 600)->save($path);
                
                // Assuming $productid is defined somewhere
                Multi_photo::create([
                    'product_id' => $productid,
                    'multi_photo' => 'uploads/multiple_images/'.$newName, // Store relative path
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        if($request->flash_sales){
            if($request->flash_sales_discount < $request->flash_sales_discount2){
                session()->flash('success','Discount amount minimum '. $request->flash_sales_discount2);
                return redirect()->back();
            }
            $flash_sales = new FlashSalesProduct;
            $flash_sales->flash_sales_id = $request->flash_sales_id;
            $flash_sales->product_id = $productid;
            $flash_sales->discount = $request->flash_sales_discount;
            $flash_sales->created_at = Carbon::now();
            $flash_sales->save();
        }

        // session()->flash('success','Product added successfuly!');
        toast('Product added successfuly!','success');
        return redirect()->route('admin.all.product');
    }// end method


    public function productEdit($id){
        $product =  Product::findOrFail($id);
        $cat = Category::where('status','1')->get();
        $brand = Brand::where('status','1')->get();
        return view('backend.pages.product.edit',compact('cat','brand','product'));     
    }// end method

    public function productUpdate(Request $request){

        $request->validate([
            'product_name' => 'required',
            // 'product_size' => 'required',
            // 'product_color' => 'required',purchase_price
            'short_des' => 'required',
            'long_des' => 'required',
            'details' => 'required',
            // 'purchase_price' => 'required|numeric|st:purchase_price',
            // 'product_price' => 'required|numeric|gt:purchase_price',
            'product_price' => 'required',
            'qty' => 'nullable|numeric',
            'qty_warning' => 'nullable|numeric|min:3',
            'brand' => 'required',
            'category' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        if($request->product_name){
            $product->product_name = $request->product_name;
            $product->product_slug = strtolower(str_replace(' ','-',$request->product_name));
        }
        if($request->category){
            $product->cat_id = $request->category;
        }
        if($request->brand_id){
            $product->brand_id = $request->brand;
        }
        
        if($request->product_size){
            $product->size = $request->product_size;
        }
        if($request->product_color){

            $product->color = $request->product_color;
        }
        if($request->short_des){
            $product->short_des = $request->short_des;
        }
        if($request->long_des){
            $product->long_des = $request->long_des;
        }
        if($request->details){
            $product->details = $request->details;
        }
        if($request->product_price){
            $product->product_price = $request->product_price;
        $product->purchase_price = $request->purchase_price;
    }
    if($request->purchase_price){
    $product->purchase_price = $request->purchase_price;
}
        if($request->product_discount){

            $product->product_discount = $request->product_discount;
        }else{
            $product->product_discount = 0;
        }
        if($request->qty){
            $product->qty = $product->qty + $request->qty;

            $inventory =  new Inventory();
            $inventory->product_id = $product->id;
            $inventory->qty =  $request->qty;
            $inventory->save();
        }
        if($request->qty_warning){
            $product->qty_warning = $request->qty_warning;
        }
        if($request->long_des){
            $product->long_des = $request->long_des;
        }

        if($request->hot_deals){
            $product->hot_deals = 1;
        }else{
            $product->hot_deals = 0;
        }

        if($request->special_offer){
            $product->special_offer =  1;
        }else{
            $product->special_offer = 0;
        }

        if($request->featured){
            $product->featured =  1;
        }else{
            $product->featured = 0;
        }

        if($request->hasFile('product_photo')){
            @unlink($product->product_photo);
            $file = $request->file('product_photo');
            $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/product/'.$newName);
            Image::make($file)->resize(600,600)->save($path);
            $product->product_photo = 'uploads/product/'.$newName;
        }
        $product->update();
        if ($request->hasFile('product_multi_photo')) {
            $multiPhoto = Multi_photo::where('product_id',$request->product_id)->get();
            
            foreach ($multiPhoto as $item) {
                @unlink($item->multi_photo); // Delete the file from storage
                $item->delete(); // Delete the database record
            }
            
            
            $img = $request->file('product_multi_photo');
            foreach ($img as $file) {
                $newName = Str::uuid().'.'.$file->getClientOriginalExtension();
                $path = public_path('uploads/multiple_images/'.$newName);
                
                // Resize and save the image
                Image::make($file)->resize(600, 600)->save($path);
                
                // Assuming $productid is defined somewhere
                Multi_photo::create([
                    'product_id' => $request->product_id,
                    'multi_photo' => 'uploads/multiple_images/'.$newName, // Store relative path
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        if($request->flash_sales){
            if($request->flash_sales_discount < $request->flash_sales_discount2){
                session()->flash('success','Discount amount minimum'. $request->flash_sales_discount2);
                return redirect()->back();
            }
            $ifExiest = FlashSalesProduct::where('flash_sales_id',$request->flash_sales_id )->where('product_id',$request->product_id)->first();
            if(!$ifExiest){
                $flash_sales = new FlashSalesProduct;
                $flash_sales->flash_sales_id = $request->flash_sales_id;
                $flash_sales->product_id = $request->product_id;
                $flash_sales->discount = $request->flash_sales_discount;
                $flash_sales->created_at = Carbon::now();
                $flash_sales->save();
            }else{
                $ifExiest->discount = $request->flash_sales_discount;
                $ifExiest->update();
            }
        }

        // session()->flash('success','Product updated successfuly!');
        toast('Product updated successfuly!','success');
        return redirect()->route('admin.all.product');

    }//end method

    public function productStatus($id){
        $product = Product::findOrFail($id);
        if($product->status == '0'){
            $product->status = '1';
            $product->update();
            session()->flash('success', 'Product status activated');
            return redirect()->back();
        }else{
            $product->status = '0';
            $product->update();
            session()->flash('error', 'Product status deactivated');
            return redirect()->back();
        }
    }//end method

    public function productDelete(Request $request){
        dd('F');
        $id =  $request->delete_id;
        $product = Product::findOrFail($id);
        @unlink($product->product_photo);
        $multiPhoto = Multi_photo::where('product_id', $id)->get();
        foreach ($multiPhoto as $item) {
            @unlink($item->multi_photo); // Delete the file from storage
            $item->delete(); // Delete the database record
        }
        session()->flash('error', 'Product deleted successfuly');
        return redirect()->back();
    }//end method

    public function productView($id){
        $product = Product::findOrFail($id);
        return view('backend.pages.product.view',compact('product'));
    }// end method









}
