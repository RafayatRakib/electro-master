<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Review_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ReviewController extends Controller
{
    public function storeReview(Request $request){
       
        $request->validate([
            'rating' => 'required'
        ]);
        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $request->product_id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->save();
        
        $id = $review->id;
    
            if ($request->hasFile('review_img')) {
                $img = $request->file('review_img');
                foreach ($img as $file) {

    
                    // $file = $request->file($file);
                    $newName = Str::uuid() . '.' . $file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = public_path('uploads/review/' . $newName);
                    Image::make($file)->resize(400, 400)->save($path);
                    // Assuming photo is defined somewhere
                    $review_img = new Review_photo(); // Move inside the loop
                    $review_img->review_id = $id;
                    $review_img->review_photo = 'uploads/review/' . $newName;
                    $review_img->save();
                }
            }
        
        toast('Review added successfuly!','success');        
        
        return redirect()->back();

    }//end method


    public function ReviewEdit($id){
        $id = decrypt($id);
        $review = Review::findOrFail($id);
        $product = Product::findOrFail($review->product_id);
        return view('frontend.dashboard.rate_edit',compact('review','product'));
    }//end method

    public function updateReview(Request $request){
        $review = Review::findOrFail($request->review_id);
        if($request->comment){
            $review->comment = $request->comment;
        }
        if($request->rating){
            $review->rating = $request->rating;
        }
        $review->update();
        
        $id = $request->review_id;
    
            if ($request->hasFile('review_img')) {
                $review_image = Review_photo::where('review_id',$id)->get();
                foreach ($review_image as $item) {
                    @unlink($item->review_image); // Delete the file from storage
                    $item->delete(); // Delete the database record
                }
                $img = $request->file('review_img');
                foreach ($img as $file) {
                    // $file = $request->file($file);
                    $newName = Str::uuid() . '.' . $file->getClientOriginalExtension(); //uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = public_path('uploads/review/' . $newName);
                    Image::make($file)->resize(400, 400)->save($path);
                    // Assuming photo is defined somewhere
                    $review_img = new Review_photo(); // Move inside the loop
                    $review_img->review_id = $id;
                    $review_img->review_photo = 'uploads/review/' . $newName;
                    $review_img->save();
                }
            }
            toast('Review added successfuly!','success');        
        return redirect()->route('rate',encrypt($review->product_id));
    }//end method


    public function deleteReview($id){
        $id = decrypt($id); // Decrypt the ID first

        $reviewImage = Review_photo::where('review_id', $id)->get();
        
        foreach ($reviewImage as $item) {
            @unlink($item->review_photo); // Delete the file from storage
            $item->delete(); // Delete each associated review image
        }
        
        $review = Review::findOrFail($id);
        $review->delete(); // Delete the review itself

        toast('Review deleted successfuly!','success');

        return redirect()->back();

    }//end method






}
