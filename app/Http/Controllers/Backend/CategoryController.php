<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class CategoryController extends Controller
{

    public function AllCategory(){
        $cat =  Category::latest()->paginate(10);
        return view('backend.pages.category.all',compact('cat'));
    }//end method


    public function AddCategory(){
        return view('backend.pages.category.add');
    }//end method

    public function StoreCategory(Request $request){
        $request->validate([
            'category' => 'required|max:30',
            'category_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rules for image
        ], [
            'category.required' => 'The category field is required.',
            'category.max' => 'The category field must not exceed :max characters.',
            'category_photo.required' => 'The category photo field is required.',
            'category_photo.image' => 'The category photo must be an image.',
            'category_photo.mimes' => 'The category photo must be a file of type: :values.',
            'category_photo.max' => 'The category photo must not exceed :max kilobytes.',
        ]);
        
        $cat =  new Category();
        $cat->cat_name = $request->category;
        $cat->cat_slug = strtolower(str_replace(' ','-',$request->category));

        if($request->hasFile('category_photo')){
            $file =  $request->file('category_photo');
            $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/category/' . $newName);
            Image::make($file)->resize(150,150)->save($path);
            $cat->cat_photo = 'uploads/category/'.$newName;
        }
        $cat->created_at = Carbon::now();
        $cat->save();
        session()->flash('success','Category added successfuly!');
        return redirect()->route('admin.cat.all');
    }//end method


    public function CategoryStatus($id){
        $cat = Category::findOrFail($id);
        if ($cat->status == '1') {
            $cat->status = '0';
            $cat->update();
            session()->flash('error', 'Category status deactivated');
            return redirect()->back();
        } else {
            $cat->status = '1';
            $cat->update();
            session()->flash('success', 'Category status activated');
            return redirect()->back();
        }
    }//end method

    public function CategoryEdit($id){
        $cat = Category::findOrFail($id);
        return view('backend.pages.category.edit',compact('cat'));
    }//end method

    public function CategoryUpdate(Request $request){
        $id = $request->cat_id;
        $request->validate([
            'category' => 'required|max:30',
            'category_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rules for image
        ], [
            'category.required' => 'The category field is required.',
            'category.max' => 'The category field must not exceed :max characters.',
            'category_photo.required' => 'The category photo field is required.',
            'category_photo.image' => 'The category photo must be an image.',
            'category_photo.mimes' => 'The category photo must be a file of type: :values.',
            'category_photo.max' => 'The category photo must not exceed :max kilobytes.',
        ]);
        
        $cat =  Category::findOrFail($id);
        $cat->cat_name = $request->category;
        $cat->cat_slug = strtolower(str_replace(' ','-',$request->category));

        if($request->hasFile('category_photo')){
            @unlink(public_path($cat->cat_photo));
            $file =  $request->file('category_photo');
            $newName =  Str::uuid().'.'.$file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/category/' . $newName);
            Image::make($file)->resize(150,150)->save($path);
            $cat->cat_photo = 'uploads/category/'.$newName;
        }
        $cat->updated_at = Carbon::now();
        $cat->update();
        session()->flash('success','Category update successfuly!');
        return redirect()->route('admin.cat.all');
    }//end method

    public function CategoryDelete(Request $request){
        $id = $request->delete_id;
        $cat = Category::findOrFail($id);
        @unlink(public_path($cat->cat_photo));
        $cat->delete();
        session()->flash('error','Category delete successfuly!');
        return redirect()->route('admin.cat.all');
    }//end method

}
