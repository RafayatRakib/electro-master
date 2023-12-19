<?php
namespace App\helpers;

use App\Models\Review;

 function rating($pid){

    $totalRating = 0;

    $review = Review::where('product_id',$pid)->get();
    $totalPerson = count($review);
    foreach ($review as $reviews) {
        $totalRating+=$reviews->rating;
    }
    $averageRating = round($totalRating / 5);
    //end avg rating

    $five = Review::where('product_id',$pid->id)->where('rating',5)->count();
    $four = Review::where('product_id',$pid->id)->where('rating',4)->count();
    $three = Review::where('product_id',$pid->id)->where('rating',3)->count();
    $two = Review::where('product_id',$pid->id)->where('rating',2)->count();
    $one = Review::where('product_id',$pid->id)->where('rating',1)->count();
    $totalReviews = $five+$four+$three+$two+$one;
    

    return [$review,$totalPerson,$averageRating,$totalReviews,$five,$four,$three,$two,$one];
}