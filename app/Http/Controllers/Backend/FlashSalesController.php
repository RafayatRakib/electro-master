<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSales;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\FlashSalesProduct;

class FlashSalesController extends Controller
{
    public function FlashSalesAll(){
        return view('backend.pages.flashSales.all');
    }//end method

    public function FlashSalesAdd(){
        return view('backend.pages.flashSales.index');
    }//end method

    public function store_flash_sale(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'flas_sales_name' => 'required|max:255',
            'bg_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_note' => 'required',
            'discount' => 'required|numeric',
            'discount_type' => 'required|in:cash,percentage',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:active,inactive',
            // Add validation rules for other fields as needed
        ]);


    $flasSales = new FlashSales();
    $isactive = FlashSales::where('status','active')->first();
    $flasSales->flas_sales_name = $request->flas_sales_name;

    if( $request->hasFile('bg_photo')){
        $file =  $request->file('bg_photo');
        $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/FlashSales/' . $newName);
        Image::make($file)->resize(1782,465)->save($path);
        $flasSales->bg_photo = 'uploads/FlashSales/'.$newName;
    }

    $flasSales->short_note = $request->short_note;
    $flasSales->discount = $request->discount;
    $flasSales->discount_type = $request->discount_type;
    $flasSales->start_time = $request->start_time;
    $flasSales->end_time = $request->end_time;
    if($isactive){
        $flasSales->status = 'inactive';
    }else{
        $flasSales->status = $request->status;
    }
    $flasSales->created_at = Carbon::now();
    $flasSales->save();
    if($isactive){
        toast('save succes but status inactived, becouse other item is acived','warning');
    }else{
        toast('save succes and status actived','success');
    }
    return redirect()->back();
    }//end method

    public function viewFlashSale($id){
        $flashSales = FlashSales::findOrFail($id);
        $currency = Currency::where('status','active')->first();
        return view('backend.pages.flashSales.preview',compact('flashSales','currency'));
    }//end method

    public function RemoveFromFlashSale($id){
        FlashSalesProduct::findOrFail($id)->delete();
        toast('Item deleted','success');
        return redirect()->back();
    }// end method

    public function editFlashSale($id){
        $flashSales = FlashSales::findOrFail($id);
        return view('backend.pages.flashSales.edit',compact('flashSales'));
    }//end method

    public function update_flash_sale(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'flas_sales_name' => 'max:255',
            'bg_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'short_note' => 'required',
            'discount' => 'numeric',
            'discount_type' => 'in:cash,percentage',
            'start_time' => 'date',
            'end_time' => 'date|after:start_time',
            'status' => 'in:active,inactive',
            // Add validation rules for other fields as needed
        ]);

        
    $flashSales = FlashSales::findOrFail(decrypt($request->id));
    $isactive = FlashSales::where('status','active')->first();

    if($request->flas_sales_name){
        $flashSales->flas_sales_name = $request->flas_sales_name;
    }

    if( $request->hasFile('bg_photo')){
        unlink($flashSales->bg_photo);
        $file =  $request->file('bg_photo');
        $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/FlashSales/' . $newName);
        Image::make($file)->resize(1782,465)->save($path);
        $flashSales->bg_photo = 'uploads/FlashSales/'.$newName;
    }
    if($request->short_note){
        $flashSales->short_note = $request->short_note;
    }
    if($request->discount){
        $flashSales->discount = $request->discount;
    }
    if($request->discount_type){
        $flashSales->discount_type = $request->discount_type;
    }
    if($request->start_time){
        $flashSales->start_time = $request->start_time;
    }
    if($request->flas_sales_name){
        $flashSales->end_time = $request->end_time;
    }
    if($request->status){
        if($isactive){
            $flashSales->status = 'inactive';
        }else{
            $flashSales->status = $request->status;
        }
    }
    $flashSales->updated_at = Carbon::now();
    $flashSales->update();
    
    if($isactive){
        toast('update succes but status inactived, becouse other item is acived','warning');
    }else{
        toast('update succes and status actived','success');
    }
    return redirect()->route('admin.flash.sales');

    }//end method




}
 