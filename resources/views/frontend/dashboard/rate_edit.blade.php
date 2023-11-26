@extends('frontend.master')
@section('content')
@section('title','Edit Review')

<div class="d-felx justify-content-center">
   <!-- Review Form -->
    <div id="review-form">
       <form class="review-form" method="post" action="{{route('update.review')}}" enctype="multipart/form-data">
          @csrf
          <p>Dear <strong>{{Auth::user()->name}}</strong>, <br> write your experience in your comment box bleow adn give rating.</p>
          <textarea class="input" name="comment" placeholder="Your Review (Optional)" >{{$review->comment}}</textarea>
          <small><strong>Note: </strong>If you select any photo, then previus photo are deleted...</small>
          <input class="input" type="file" multiple name="review_img[]" placeholder="Optional">
          <input type="hidden" name="review_id" value="{{$review->id}}">
          <div class="input-rating">
            <span>Your Current Rating: </span>
            <div class="review-rating">
                @for ($i = 0; $i < $review->rating; $i++)                                           
                <i class="fa fa-star"></i> 
                @endfor
                @for ($i = 0; $i < (5-$review->rating); $i++)
                <i class="fa fa-star-o empty"></i>
                @endfor
             </div>

             <span>Change Your Rating: </span>
             <div class="stars">
                <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
             </div>
          </div>
          <div>
             @error('rating') <strong class="text-danger">{{$message}}</strong> @enderror 
          </div>
          <button class="primary-btn">Submit</button>
       </form>
    </div>
</div>
    <!-- /Review Form -->



    
@endsection