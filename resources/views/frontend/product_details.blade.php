@extends('frontend.master')
@section('title','Product Details')
@section('content')


<!-- SECTION -->
<div class="section">
   <!-- container -->
   <div class="container">
      @if (session()->get('success'))
      <div style="margin-top: 40px">
         <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
            <p style="margin: auto">{{session()->get('success')}}</p>
         </div>
      </div>
      @endif
      <!-- row -->
      <div class="row" >
         <!-- Product main img -->
         <div class="col-md-5 col-md-push-2">
            <div id="product-main-img">
               <div class="product-preview">
                  <img src="{{asset($product->product_photo)}}" alt="">
               </div>
               @foreach ($product_photo as $item)
               <div class="product-preview">
                  <img src="{{asset($item->multi_photo)}}" alt="">
               </div>
               @endforeach
            </div>
         </div>
         <!-- /Product main img -->
         <!-- Product thumb imgs -->
         <div class="col-md-2  col-md-pull-5">
            <div id="product-imgs">
               <div class="product-preview">
                  <img src="{{asset($product->product_photo)}}" alt="">
               </div>
               @foreach ($product_photo as $item)
               <div class="product-preview">
                  <img src="{{asset($item->multi_photo)}}" alt="">
               </div>
               @endforeach
            </div>
         </div>
         <!-- /Product thumb imgs -->
         <!-- Product details -->
         <div class="col-md-5">
            <div class="product-details">
               <h2 class="product-name"> {{$product->product_name}} </h2>
               <div>
                  <div class="product-rating">
                  @if ($totalRating>0)
                        @for ($i = 0; $i < round($totalRating/$totalPerson); $i++)                                           
                        <i class="fa fa-star"></i> 
                        @endfor
                        @for ($i = 0; $i < (5-round($totalRating/$totalPerson)); $i++)
                        <i class="fa fa-star-o empty"></i>
                        @endfor
                        @else
                        @for ($i = 0; $i < 5; $i++)
                        <i class="fa fa-star-o empty"></i>
                        @endfor
                        @endif
                  </div>
                  @if ($isPurches)
                  <a class="review-link" href="{{ route('rate',encrypt($product->id)) }}">{{$totalPerson}} Review(s) | Add your review</a>
                  @else
                  <strong>{{$totalPerson}} Review(s)</strong> | Purches this item then you can review it.
                  @endif
                      
                 

                      
                

               </div>
               <form action="{{route('addToCart')}}" method="post">
                  @csrf
                  @php
                  $currentUrl = url()->getRequest()->path();
                  @endphp
                  <input type="hidden" name="currentUrl" value="{{$currentUrl}}">
                  <input type="hidden" name="product_id" value="{{encrypt($product->id)}}">
                  <div>
                  @php
                      $flashSales = App\Models\FlashSalesProduct::where('product_id',$product->id)->first();                     
                  @endphp
                     @if ($flashSales)
                     @if ($flashSales->flashsale->discount_type=='cash')
                     <h3 class="product-price burned-text">{!!$currency->currency_symbol!!}{{number_format(($product->product_price-$flashSales->flashsale->discount > 0?$product->product_price-$flashSales->discount:$product->product_price),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($product->product_price, 2, '.', ',')}}</del></h3>
							    
                     @else
                         <h3 class="product-price burned-text">{!!$currency->currency_symbol!!}{{number_format(($product->product_price-($product->product_price*$flashSales->discount/100)),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($product->product_price, 2, '.', ',')}}</del></h3>
                     @endif
                        
                     @else
                        @if ($product->product_discount)
                        <h3 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($product->product_price-$product->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($product->product_price, 2, '.', ',')}}</del></h3>
                        @else
                        <h3 class="product-price">{!!$currency->currency_symbol!!}{{number_format($product->product_price, 2, '.', ',')}}</h3>
                        @endif

                     @endif


                     
                     @if ($product->qty >= 1)
                     <span class="product-available">In Stock</span>
                     @else
                     <span class="product-available"><del>Stock Out</del></span>                            
                     @endif
                  </div>
                  <p>{!!$product->short_des!!}</p>
                  <div class="product-options">
                     @if ($product->size)
                     <label>
                        Size
                        <select name="size" class="input-select">
                           @foreach (explode(',', $product->size) as $size)
                           <option value="{{ $size }}">{{ $size }}</option>
                           @endforeach
                        </select>
                     </label>
                     @endif
                     @if ($product->color)
                     <label>
                        Color
                        <select name="color" class="input-select">
                           @foreach (explode(',', $product->color) as $color)
                           <option value="{{ $color }}">{{ $color }}</option>
                           @endforeach
                        </select>
                     </label>
                     @endif
                  </div>
                  <div class="add-to-cart">
                     <div class="qty-label">
                        Qty
                        <div class="input-number">
                           <input type="number" name="qty" value="1" min="1">
                           <span class="qty-up">+</span>
                           <span class="qty-down">-</span>
                        </div>
                     </div>
                     @if ($product->qty >= 1)
                     <button type="submit"  class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                     @else
                     <button disabled class="btn add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Out Of Stock</button>
                     @endif
                  </div>
               </form>
               <ul class="product-btns">
                  <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                  {{-- 
                  <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                  --}}
               </ul>
               <ul class="product-links">
                  <li>Category:</li>
                  <li><a href="{{route('cat_wise.product',$product->id)}}"> {{$product->category->cat_name}} </a></li>
               </ul>
               <ul class="product-links">
                  <li>Share:</li>
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li><a href="#"><i class="fa fa-envelope"></i></a></li>
               </ul>
            </div>
         </div>
         <!-- /Product details -->
         <!-- Product tab -->
         <div class="col-md-12">
            <div id="product-tab">
               <!-- product tab nav -->
               <ul class="tab-nav">
                  <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                  <li><a data-toggle="tab" href="#tab2">Details</a></li>
                  <li><a data-toggle="tab" href="#tab3">Reviews ({{$totalPerson}})</a></li>
               </ul>
               <!-- /product tab nav -->
               <!-- product tab content -->
               <div class="tab-content">
                  <!-- tab1  -->
                  <div id="tab1" class="tab-pane fade in active">
                     <div class="row">
                        <div class="col-md-12">
                           <p> {!! $product->long_des !!} </p>
                        </div>
                     </div>
                  </div>
                  <!-- /tab1  -->
                  <!-- tab2  -->
                  <div id="tab2" class="tab-pane fade in">
                     <div class="row">
                        <div class="col-md-12">
                           <p> {!! $product->details !!} </p>
                        </div>
                     </div>
                  </div>
                  <!-- /tab2  -->
                  <!-- tab3  -->
                  <div id="tab3" class="tab-pane fade in">
                     <div class="row">
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
                                 @if ($totalRating>0)
                                     
                               
                                 <span> {{$totalRating/$totalPerson}} </span>
                                 <div class="rating-stars">
                                    @for ($i = 0; $i < round($totalRating/$totalPerson); $i++)                                           
                                    <i class="fa fa-star"></i> 
                                    @endfor
                                    @for ($i = 0; $i < (5-round($totalRating/$totalPerson)); $i++)
                                    <i class="fa fa-star-o empty"></i>
                                    @endfor
                                 </div>

                                 @else
                                 <span> 0 </span>
                                 <div class="rating-stars">
                                    @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star-o empty"></i>
                                    @endfor
                                 </div>
                                 @endif
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
                                       @if ($totalRating>0)
                                       <div style="width: {{($five / $totalReviews) * 100}}%;"></div>                                           
                                       @else
                                           
                                       @endif
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
                                       @if ($totalRating>0)
                                       
                                       <div style="width: {{($four / $totalReviews) * 100}}%;"></div>
                                       @else
                                           
                                       @endif

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
                                       @if ($totalRating>0)
                                           
                                       <div style="width: {{($three / $totalReviews) * 100}}%;"></div>
                                       @else
                                           
                                       @endif
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
                                       @if ($totalRating>0)
                                       <div style="width: {{($two / $totalReviews) * 100}}%;"></div>
                                      
                                       @else
                                           
                                       @endif
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
                                       @if ($totalRating>0)
                                       <div style="width: {{($one / $totalReviews) * 100}}%;"></div>
                                       
                                       @else
                                           
                                       @endif

                                    </div>
                                    <span class="sum">{{$one}}</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <!-- /Rating -->
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
                                          <a href="" onclick="return confirm('Are you sure to delete it?')" >Delete</a>
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
                        <!-- Review Form -->
                        @if (Auth::id())
                            
                        <div class="col-md-3">
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
                        @endif

                        <!-- /Review Form -->
                     </div>
                  </div>
                  <!-- /tab3  -->
               </div>
               <!-- /product tab content  -->
            </div>
         </div>
         <!-- /product tab -->
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->
<!-- Section -->
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <h3 class="title">Related Products</h3>
            </div>
         </div>
         <!-- product -->
         <div class="col-md-3 col-xs-6">
            @forelse ($cat_wise_product as $item)
            <div class="product">
               <div class="product-img">
                  <img src=" {{asset($item->product_photo)}} " alt="">
                  <div class="product-label">
                     @if ($item->product_discount)
                     <span class="sale">- {{round((100 * $item->product_discount) /$item->product_price)}} %</span>
                     <span class="new">NEW</span>
                     @else
                     <span class="new">NEW</span>
                     @endif
                  </div>
               </div>
               <div class="product-body">
                  <p class="product-category">{{$item->category->cat_name}}</p>
                  <h3 class="product-name"><a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,25,'...')}}</a></h3>
                  <a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">
                     @if ($item->product_discount)
                     <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                     @else
                     <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                     @endif
                  </a>
                  @php
                  $reviews = App\Models\Review::where('product_id', $item->id)->get();
                  $totalPerson = count($reviews);
                  $totalRating = $reviews->sum('rating');
                  $averageRating = $totalPerson > 0 ? round($totalRating / $totalPerson) : 0;
                  @endphp
                  <div class="product-rating">
                     @for ($i = 0; $i < $averageRating; $i++)
                     <i class="fa fa-star"></i>
                     @endfor
                     @for ($i = $averageRating; $i < 5; $i++)
                     <i class="fa fa-star-o empty"></i>
                     @endfor
                  </div>
                  <div class="product-btns">
                     <a class="add-to-wishlist p-3" href="{{route('add.wishlist',encrypt($item->id))}}"><i class="fa fa-heart-o"></i></a>
                     <a  href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}" class="quick-view p-3"><i class="fa fa-eye"></i>
                     </a>
                     <a  href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}" class="quick-view p-3"><i class="fa fa-shopping-cart"></i>
                     </a>
                  </div>
               </div>

            </div>
            @empty
            <h4>No data found</h4>
            @endforelse
         </div>


         <!-- /product -->
         <!-- product -->
         {{-- 
         <div class="col-md-3 col-xs-6">
            <div class="product">
               <div class="product-img">
                  <img src="./img/product02.png" alt="">
                  <div class="product-label">
                     <span class="new">NEW</span>
                  </div>
               </div>
               <div class="product-body">
                  <p class="product-category">Category</p>
                  <h3 class="product-name"><a href="#">product name goes here</a></h3>
                  <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                  <div class="product-rating">
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                  </div>
                  <div class="product-btns">
                     <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                     <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                     <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                  </div>
               </div>
               <div class="add-to-cart">
                  <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
               </div>
            </div>
         </div>
         --}}
         <!-- /product -->
         {{-- 
         <div class="clearfix visible-sm visible-xs"></div>
         --}}
         <!-- product -->
         {{-- 
         <div class="col-md-3 col-xs-6">
            <div class="product">
               <div class="product-img">
                  <img src="./img/product03.png" alt="">
               </div>
               <div class="product-body">
                  <p class="product-category">Category</p>
                  <h3 class="product-name"><a href="#">product name goes here</a></h3>
                  <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                  <div class="product-rating">
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star-o"></i>
                  </div>
                  <div class="product-btns">
                     <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                     <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                     <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                  </div>
               </div>
               <div class="add-to-cart">
                  <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
               </div>
            </div>
         </div>
         --}}
         <!-- /product -->
         <!-- product -->
         {{-- 
         <div class="col-md-3 col-xs-6">
            <div class="product">
               <div class="product-img">
                  <img src="./img/product04.png" alt="">
               </div>
               <div class="product-body">
                  <p class="product-category">Category</p>
                  <h3 class="product-name"><a href="#">product name goes here</a></h3>
                  <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                  <div class="product-rating">
                  </div>
                  <div class="product-btns">
                     <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                     <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                     <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                  </div>
               </div>
               <div class="add-to-cart">
                  <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
               </div>
            </div>
         </div>
         --}}
         <!-- /product -->
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div>
<!-- /Section -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script>
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   
   function addtocart(){
       alert('I am from cart');
   }//end metod 
   
   
   
   
   
</script>
@endsection