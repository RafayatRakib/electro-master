<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function AllBrand(){
        $brand =  Brand::latest()->paginate(10);
        return view('backend.pages.brand.all',compact('brand'));
    }//end method


    public function AddBrand(){
        return view('backend.pages.brand.add');
    }//end method

    public function StoreBrand(Request $request){
        $request->validate([
            'brand' => 'required|max:30',
            'brand_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rules for image
        ], [
            'brand.required' => 'The brand field is required.',
            'brand.max' => 'The brand field must not exceed :max characters.',
            'brand_photo.required' => 'The brand photo field is required.',
            'brand_photo.image' => 'The brand photo must be an image.',
            'brand_photo.mimes' => 'The brand photo must be a file of type: :values.',
            'brand_photo.max' => 'The brand photo must not exceed :max kilobytes.',
        ]);
        
        $brand =  new Brand();
        $brand->brand_name = $request->brand;
        $brand->brand_slug = strtolower(str_replace(' ','-',$request->brand));

        if($request->hasFile('brand_photo')){
            $file =  $request->file('brand_photo');
            $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/brand/' . $newName);
            Image::make($file)->resize(150,150)->save($path);
            $brand->brand_photo = 'uploads/brand/'.$newName;
        }
        $brand->created_at = Carbon::now();
        $brand->save();
        session()->flash('success','Brand added successfuly!');
        return redirect()->route('admin.brand.all');
    }//end method 


    public function BrandStatus($id){
        $brand = Brand::findOrFail($id);
        if ($brand->status == '1') {
            $brand->status = '0';
            $brand->update();
            session()->flash('error', 'brand status deactivated');
            return redirect()->back();
        } else {
            $brand->status = '1';
            $brand->update();
            session()->flash('success', 'brand status activated');
            return redirect()->back();
        }
    }//end method

    public function BrandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.pages.brand.edit',compact('brand'));
    }//end method

    public function BrandUpdate(Request $request){
        $id = $request->brand_id;
        $request->validate([
            'brand' => 'required|max:30',
            'brand_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rules for image
        ], [
            'brand.required' => 'The brand field is required.',
            'brand.max' => 'The brand field must not exceed :max characters.',
            'brand_photo.required' => 'The brand photo field is required.',
            'brand_photo.image' => 'The brand photo must be an image.',
            'brand_photo.mimes' => 'The brand photo must be a file of type: :values.',
            'brand_photo.max' => 'The brand photo must not exceed :max kilobytes.',
        ]);
        
        $brand =  Brand::findOrFail($id);
        $brand->brand_name = $request->brand;
        $brand->brand_slug = strtolower(str_replace(' ','-',$request->brand));

        if($request->hasFile('brand_photo')){
            @unlink(public_path($brand->brand_photo));
            $file =  $request->file('brand_photo');
            $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/brand/' . $newName);
            Image::make($file)->resize(150,150)->save($path);
            $brand->brand_photo = 'uploads/brand/'.$newName;
        }
        $brand->updated_at = Carbon::now();
        $brand->update();
        session()->flash('success','Brand update successfuly!');
        return redirect()->route('admin.brand.all');
    }//end method

    public function BrandDelete(Request $request){
        $id = $request->delete_id;
        $brand = Brand::findOrFail($id);
        @unlink(public_path($brand->brand_photo));
        $brand->delete();
        session()->flash('error','Brand delete successfuly!');
        return redirect()->route('admin.brand.all');
    }//end method
}
