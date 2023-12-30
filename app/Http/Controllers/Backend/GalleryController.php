<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function gallery(){
        return view('backend.pages.gallery.index');
    }//end method

    public function addImages(){
        return view('backend.pages.gallery.add');
    }//end method

    public function storeImage(Request $request){
        
            if($request->width || $request->height){
                $request->validate([
                    'images'=> 'required',
                    'width' => 'required',
                    'height' => 'required'
                ]);
            }else{
                $request->validate([
                    'images'=> 'required',
                ]);
            }
            

            if ($request->hasFile('images')) {
            $img = $request->file('images');
            foreach ($img as $file) {
                $newName = Str::uuid().'.'.$file->getClientOriginalExtension();
                $path = public_path('uploads/custom_images/'.$newName);
                
                // Resize and save the image
                if($request->width && $request->height){
                    Image::make($file)->resize($request->width, $request->height)->save($path);
                }else{
                    Image::make($file)->save($path);
                }
                
                // Assuming $productid is defined somewhere
              $gallery = new Gallery();
              $gallery->image_path = 'uploads/custom_images/'.$newName;
              $gallery->save();
            }
        }
        toast('Images uploaded','success');
        return redirect()->route('admin.all.image');




    }//end method


    public function deleteImage($path){
        $path = decrypt($path);
        Gallery::where('image_path',$path)->delete();
        toast('image deleted successfuly','success');
        session()->flash('custom_image');
        return redirect()->back();
    }//end method





}
