@extends('frontend.master')
@section('title','Reting product')
@section('content')

@if (session()->get('success'))
<div style="margin-bottom: 40px">
   <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
      <p style="margin: auto">{{session()->get('success')}}</p>
   </div>
</div>
@endif
<div class="row">
   <div class="col-md-6">
      <img width="250px" src="{{asset($product->product_photo)}}" alt="" srcset="">
      <h4 style="margin-top: 40px"><a href="{{url('/product/details/'.$product->id.'/'.$product->product_slug)}}">{{$product->product_name}}</a></h4>
   </div>
   <!-- Review Form -->
   <div class="col-md-6">
      <div id="review-form">
         <form class="review-form" method="post" action="{{route('store.review')}}" enctype="multipart/form-data">
            @csrf
            <p>Dear <strong>{{Auth::user()->name}}</strong>, <br> write your experience in your comment box bleow adn give rating.</p>
            <textarea class="input" name="comment" placeholder="Your Review (Optional)"></textarea>
            <input class="input" type="file" multiple name="review_img[]" placeholder="Optional">
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <div class="input-rating">
               <span>Your Rating: </span>
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
   <!-- Product tab -->
   <div class="col-md-12">
      <div id="product-tab">
         <!-- product tab nav -->
         <ul class="tab-nav">
            <li class="active"><a data-toggle="tab" href="#tab3" aria-expanded="true">Reviews ({{count($review)}})</a></li>
         </ul>
         <!-- /product tab nav -->
         <!-- product tab content -->
         <div class="tab-content">
            <!-- tab3  -->
            <div id="tab3" class="tab-pane fade in active">
               <div class="row">
                  <!-- Review Form -->
                  <div class="col-md-3">
                     <h1>related product herer</h1>
                  </div>
                  <!-- /Review Form -->
                  <!-- Reviews -->
                  <div class="col-md-6">
                     <div id="reviews">
                        @php
                        $totalRating = 0;
                        $totalPerson = count($review);
                        $five = 0;
                        $four = 0;
                        $three = 0;
                        $two = 0;
                        $one = 0;
                        @endphp
                        <ul class="reviews">
                           @foreach ($review as $item)
                           @php
                           $totalRating+=$item->rating;
                           $review_img = App\Models\Review_photo::where('review_id',$item->id)->get();
                           $user = App\Models\User::findOrFail($item->user_id);
                           @endphp
                           <li>
                              <div class="review-heading">
                                 <h5 class="name">{{$user->name}}</h5>
                                 <p class="date">{{Carbon\Carbon::parse()->format("d M Y, h:m A")}}</p>
                                 <div class="review-rating">
                                    @for ($i = 0; $i < $item->rating; $i++)                                           
                                    <i class="fa fa-star"></i> 
                                    @endfor
                                    @for ($i = 0; $i < (5-$item->rating); $i++)
                                    <i class="fa fa-star-o empty"></i>
                                    @endfor
                              </div>
                           </div>

                                 <div>
                                    <a href="{{ route('edit.review', encrypt($item->id)) }}">Edit</a>
                                    <a href="{{route('delete.review', encrypt($item->id))}}" class="delete-review" >Delete</a>
                                   
                                 </div>
                              </li>
                           <li>
                              <div class="review-heading">
                                 <!-- Existing review heading content -->
                              </div>
                              <div class="review-body">
                                 <p>{{$item->comment}}</p>
                                 <div class="image-container">
                                    @foreach ($review_img as $item)
                                    <img class="zoom-image" style="width: 80px" src="{{ asset($item->review_photo) }}" alt="">
                                    @endforeach 
                                 </div>
                              </div>
                           
                           </li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
                  <!-- /Reviews -->
                  @php
                  $five = App\Models\Review::where('product_id',$product->id)->where('rating',5)->count();
                  $four = App\Models\Review::where('product_id',$product->id)->where('rating',4)->count();
                  $three = App\Models\Review::where('product_id',$product->id)->where('rating',3)->count();
                  $two = App\Models\Review::where('product_id',$product->id)->where('rating',2)->count();
                  $one = App\Models\Review::where('product_id',$product->id)->where('rating',1)->count();
                  $totalReviews = $five+$four+$three+$two+$one;
                  @endphp
                  <!-- Rating -->
                  <div class="col-md-3">
                     <div id="rating">
                        <div class="rating-avg">
                           <span> {{round($totalRating/$totalPerson,1)}} </span>
                           <div class="rating-stars">
                              @for ($i = 0; $i < round($totalRating/$totalPerson); $i++)                                           
                              <i class="fa fa-star"></i> 
                              @endfor
                              @for ($i = 0; $i < (5-round($totalRating/$totalPerson)); $i++)
                              <i class="fa fa-star-o empty"></i>
                              @endfor
                           </div>
                        </div>
                        <ul class="rating">
                           <li>
                              <div class="rating-stars">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                              </div>
                              <div class="rating-progress">
                                 <div style="width: {{($five / $totalReviews) * 100}}%;"></div>
                              </div>
                              <span class="sum">{{$five}}</span>
                           </li>
                           <li>
                              <div class="rating-stars">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="rating-progress">
                                 <div style="width: {{($four / $totalReviews) * 100}}%;"></div>
                              </div>
                              <span class="sum">{{$four}}</span>
                           </li>
                           <li>
                              <div class="rating-stars">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="rating-progress">
                                 <div style="width: {{($three / $totalReviews) * 100}}%;"></div>
                              </div>
                              <span class="sum">{{$three}}</span>
                           </li>
                           <li>
                              <div class="rating-stars">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="rating-progress">
                                 <div style="width: {{($two / $totalReviews) * 100}}%;"></div>
                              </div>
                              <span class="sum">{{$two}}</span>
                           </li>
                           <li>
                              <div class="rating-stars">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="rating-progress">
                                 <div style="width: {{($one / $totalReviews) * 100}}%;"></div>
                              </div>
                              <span class="sum">{{$one}}</span>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <!-- /Rating -->
                  {{ $review->links('vendor.pagination.custom') }}
               </div>
            </div>
            <!-- /tab3  -->
         </div>
         <!-- /product tab content  -->
      </div>
   </div>
   <!-- /product tab -->
</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}



@section('script')

<script>
   $(document).ready(function() {
      $('.delete-review').on('click', function(e) {
         e.preventDefault(); // Prevent the default action of following the link
         
         var deleteUrl = $(this).attr('href');
         
         if (confirm('Are you sure to delete it?')) {
            // User confirmed deletion, proceed to the delete URL
                window.location.href = deleteUrl;
               } else {
                  // User canceled deletion, do nothing
               }
            });
         });
      </script>
@endsection


@endsection