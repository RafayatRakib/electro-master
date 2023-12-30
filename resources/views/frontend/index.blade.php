@extends('frontend.master')
@php
$site = App\Models\LogonAndName::where('status','active')->first();
$currency = App\Models\Currency::where('status','active')->first();
$timePeriod = App\Models\FlashSales::where('status','active')->first(); // Replace $id with the ID of the record you want
$startTime = $timePeriod->start_time;
$stopTime = $timePeriod->end_time;
@endphp
@section('title',$site->name.' - Home')
@section('content')
<!-- SECTION -->
<div class="section">
   <!-- container -->
   <div class="container">
      <div class="row">
         <!-- shop -->
         @php
         $category = App\Models\Order_item::inRandomOrder()->limit(3)->get();
         @endphp
         @foreach ($category as $item)
         <div class="col-md-4 col-xs-6">
            <a href="{{route('cat_wise.product',$item->product->category->cat_slug)}}">
               <div class="shop">
                  <div class="shop-img">
                     <img src="{{$item->product->product_photo}}" alt="">
                  </div>
                  <div class="shop-body">
                     <h3> {{$item->product->category->cat_name}} <br>Collection</h3>
            <a href="{{route('cat_wise.product',$item->product->category->cat_slug)}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            </div>
            </a>
         </div>
         @endforeach
         <!-- /shop -->
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->
<!-- SECTION -->
@if ($timePeriod->end_time > \Carbon\Carbon::now())          
<div id="hot-deal" style="background-image: url({{asset($timePeriod->bg_photo??'')}})" class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <!-- section title -->
         <div class="col-md-12">
            <div class="section-title">
               <h3 class="title my-3" style="margin-left: 43%">{{$timePeriod->flas_sales_name}}</h3>
               <div class="hot-deal" style="margin-top: 50px">
                  <ul class="hot-deal-countdown burned-text">
                     <li>
                        <div>
                           <h3 id="days">00</h3>
                           <span>Days</span>
                        </div>
                     </li>
                     <li>
                        <div>
                           <h3 id="hours">00</h3>
                           <span>Hours</span>
                        </div>
                     </li>
                     <li>
                        <div>
                           <h3 id="minutes">00</h3>
                           <span>Mins</span>
                        </div>
                     </li>
                     <li>
                        <div>
                           <h3 id="seconds">00</h3>
                           <span>Secs</span>
                        </div>
                     </li>
                  </ul>
                  <h2 class="text-uppercase">{{$timePeriod->short_note??'hot deal this week'}}</h2>
                  <p>This Collection Up to
                     <strong>
                     @if ($timePeriod->discount_type == 'cash')
                     {!!$currency->currency_symbol!!}{{$timePeriod->discount}}
                     @else
                     {{$timePeriod->discount}}%
                     @endif </strong> OFF
                  </p>
               </div>
            </div>
         </div>
         <!-- /section title -->
         <!-- Products tab & slick -->
         <div class="col-md-12">
            
         </div>
      </div>
      <!-- Products tab & slick -->
   </div>
   <!-- /row -->
   @endif
</div>
<!-- /container -->

<div class="section">
   <div class="container">
      <div class="row">
         <div class="products-tabs">
            <!-- tab -->
            <div id="tab1" class="tab-pane active">
               <div class="products-slick" data-nav="#slick-nav-1">
                  @php
                  $product = App\Models\FlashSalesProduct::inRandomOrder()->get();
                  
                  @endphp
                  @forelse ($product as $item)
                  <!-- product -->
                  <div class="product">
                     <div class="product-img">
                        <img src="{{$item->product->product_photo}}" alt="">
                        <div class="product-label">
                           @if ($item->flashsale->discount_type == 'cash')
                           <h1>f</h1>
                              @if ($item->product_discount)
                              <span class="sale">- {{round((100 * $item->discount) /$item->product_price)}} %</span>
                              <span class="new">NEW</span>
                              @else
                              <span class="new">NEW</span>
                              @endif
                           @else
                              {{-- @if ($item->product_discount) --}}
                              <span class="sale">- {{round($item->discount)}} %</span>
                              <span class="new">NEW</span>
                              {{-- @else
                              <span class="new">NEW</span>
                              @endif --}}
                           @endif 
                        </div>
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->product->category->cat_name}}</p>
                        <h3 class="product-name"><a href="{{url('/product/details/'.$item->product_id.'/'.$item->product->product_slug)}}">{{Str::limit($item->product->product_name,25,'...')}}</a></h3>
                        <a href="{{url('/product/details/'.$item->product_id.'/'.$item->product->product_slug)}}">
                           @if ($item->flashsale->discount_type == 'cash')
                           <h4 class="product-price burned-text ">
                              {!!$currency->currency_symbol!!}{{number_format(($item->product->product_price-$item->discount),2,'.',',')<= 0 ? $item->product->product_price : number_format(($item->product->product_price-$item->flashsale->discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product->product_price, 2, '.', ',')}}</del>
                           </h4>
                           @else
                           <h3 class="product-price burned-text">{!!$currency->currency_symbol!!}{{number_format(($item->product->product_price-($item->product->product_price*$item->discount/100)),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product->product_price, 2, '.', ',')}}</del></h3>
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
                           <a class="add-to-wishlist p-3" href="{{route('add.wishlist',encrypt($item->product_id))}}"><i class="fa fa-heart-o"></i></a>
                           <a  href="{{url('/product/details/'.$item->product_id.'/'.$item->product->product_slug)}}" class="quick-view p-3"><i class="fa fa-eye"></i>
                           </a>
                           <a  href="{{url('/product/details/'.$item->product_id.'/'.$item->product->product_slug)}}" class="quick-view p-3"><i class="fa fa-shopping-cart"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  @empty
                  <h4>No Record found</h4>
                  @endforelse
               </div>
               <div id="slick-nav-1" class="products-slick-nav"></div>
            </div>
         </div>
         <!-- /tab -->
      </div>
   </div>
</div>




</div>
<!-- /SECTION -->
{{-- category seection --}}
<div class="section">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title">
               <h3 class="title">Categories</h3>
            </div>
         </div>
         <div class="col-md-12">
            <div class="row">
               @php
               $categories = App\Models\Category::where('status',1)->inRandomOrder()->limit(12)->get();
               @endphp
               @forelse ($categories as $item)
               @php
               $total_item = App\Models\Product::where('cat_id',$item->id)->count();
               @endphp
               <div class="col-md-2 col-xs-3 my-3">
                  <div class="product" style="max-height: 400px !important">
                     <div class="product-img">
                        <img style="width: 75px" src="{{asset($item->cat_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <h3 class="product-name"><a href="{{route('cat_wise.product',$item->cat_slug)}}"> {{$item->cat_name}} </a></h3>
                        <h4 class="product-price"> {{$total_item}} items </h4>
                        <div class="product-rating">
                        </div>
                     </div>
                  </div>
               </div>
               @empty
               <h3>Categories not found or add here</h3>
               @endforelse
            </div>
         </div>
      </div>
   </div>
</div>
{{-- category seection --}}
<!-- SECTION -->
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <!-- section title -->
         <div class="col-md-12">
            <div class="section-title">
               <h3 class="title">New Products</h3>
               <div class="section-nav">
                  <ul class="section-tab-nav tab-nav">
                     @php
                     $cat2 = App\Models\Category::where('status', 1)->inRandomOrder()->limit(4)->get();
                     @endphp
                     @foreach ($cat2 as $item)
                     {{-- 
                     <li><a data-toggle="tab" href="#category{{$item->id}}"> {{$item->cat_name}} </a></li>
                     --}}
                     <li><a class="nav-link" id="nav-tab-two"  href="#category{{$item->id}}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">{{$item->cat_name}}</a></li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <!-- /section title -->
         <!-- Products tab & slick -->
         <div class="col-md-12">
            <div class="row">
               <div class="products-tabs">
                  <!-- tab -->
                  <div id="tab1" class="tab-pane active">
                     <div class="products-slick" data-nav="#slick-nav-1">
                        @php
                        $product = App\Models\Product::where('status',1)->inRandomOrder()->get();
                        $currency = App\Models\Currency::where('status','active')->first();
                        @endphp
                        @forelse ($product as $item)
                        <!-- product -->
                        <div class="product">
                           <div class="product-img">
                              <img src="{{$item->product_photo}}" alt="">
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
                           <!-- /product -->
                        </div>
                        @empty
                        <h4>No Record found</h4>
                        @endforelse
                     </div>
                     <div id="slick-nav-1" class="products-slick-nav"></div>
                  </div>
               </div>
               <!-- /tab -->
            </div>
         </div>
      </div>
      <!-- Products tab & slick -->
   </div>
   <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
<!-- HOT DEAL SECTION -->
{{-- <div id="hot-deal" class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-12">
            <div class="hot-deal">
               <ul class="hot-deal-countdown">
                  <li>
                     <div>
                        <h3>02</h3>
                        <span>Days</span>
                     </div>
                  </li>
                  <li>
                     <div>
                        <h3>10</h3>
                        <span>Hours</span>
                     </div>
                  </li>
                  <li>
                     <div>
                        <h3>34</h3>
                        <span>Mins</span>
                     </div>
                  </li>
                  <li>
                     <div>
                        <h3>60</h3>
                        <span>Secs</span>
                     </div>
                  </li>
               </ul>
               <h2 class="text-uppercase">hot deal this week</h2>
               <p>New Collection Up to 50% OFF</p>
               <a class="primary-btn cta-btn" href="#">Shop now</a>
            </div>
         </div>
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div> --}}
<!-- /HOT DEAL SECTION -->
<!-- SECTION -->
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <!-- section title -->
         <div class="col-md-12">
            <div class="section-title">
               <h3 class="title">Top selling</h3>
               <div class="section-nav">
                  <ul class="section-tab-nav tab-nav">
                     @php
                     $brand = App\Models\Brand::where('status', 1)->inRandomOrder()->limit(4)->get();
                     @endphp
                     @forelse ($brand as $item)
                     <li ><a data-toggle="tab" href="#tab2"> {{$item->brand_name}} </a></li>
                     @empty
                     <h4>No record found</h4>
                     @endforelse
                  </ul>
               </div>
            </div>
         </div>
         <!-- /section title -->
         <!-- Products tab & slick -->
         <div class="col-md-12">
            <div class="row">
               <div class="products-tabs">
                  <!-- tab -->
                  <div id="tab2" class="tab-pane fade in active">
                     <div class="products-slick" data-nav="#slick-nav-2">
                        @php
                        $product = App\Models\Product::where('status',1)->orderBy('brand_id','ASC')->inRandomOrder()->get();
                        $currency = App\Models\Currency::where('status','active')->first();
                        @endphp
                        @forelse ($product as $item)
                        <!-- product -->
                        <div class="product">
                           <div class="product-img">
                              <img src="{{$item->product_photo}}" alt="">
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
                           <!-- /product -->
                        </div>
                        @empty
                        <h4>No Record found</h4>
                        @endforelse
                  </div>
                  <div id="slick-nav-2" class="products-slick-nav"></div>
               </div>
               <!-- /tab -->
            </div>
         </div>
      </div>
      <!-- /Products tab & slick -->
   </div>
   <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
<!-- SECTION -->
<div class="section">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-4 col-xs-6">
            <div class="section-title">
               <h4 class="title">Special Offer</h4>
               <div class="section-nav">
                  <div id="slick-nav-3" class="products-slick-nav"></div>
               </div>
            </div>
            @php
            $specialOfferProducts = App\Models\Product::where('status', 'active')
            ->where('special_offer', 1)
            ->orderBy('created_at', 'desc')
            ->inRandomOrder()
            ->limit(3)
            ->get();
            $special_offerAsc = App\Models\Product::where('status','active')
            ->where('special_offer',1)
            ->orderBy('created_at', 'asc')
            ->inRandomOrder()
            ->limit(3)
            ->get();
            @endphp
            <div class="products-widget-slick" data-nav="#slick-nav-3">
               <div>
                  @foreach ($specialOfferProducts as $item)
                  <!-- product widget -->
                  <div class="product-widget">
                     <div class="product-img">
                        <img src="{{asset($item->product_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->category->cat_name}}</p>
                        <h3 class="product-name"><a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,30,'...')}}</a></h3>
                        @if ($item->product_discount)
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                        @else
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                        @endif
                     </div>
                  </div>
                  <!-- /product widget -->
                  @endforeach
               </div>
               <div>
                  @foreach ($special_offerAsc as $item)
                  <!-- product widget -->
                  <div class="product-widget">
                     <div class="product-img">
                        <img src="{{asset($item->product_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->category->cat_name}}</p>
                        <h3 class="product-name">
                        <a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,30,'...')}}</a>h3>
                        {{-- 
                        <h4 class="product-price">{!!$currency->currency_symbol!!} 980.00 <del class="product-old-price">$990.00</del></h4>
                        --}}
                        @if ($item->product_discount)
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                        @else
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                        @endif
                     </div>
                  </div>
                  <!-- /product widget -->
                  @endforeach
               </div>
            </div>
         </div>
         <div class="col-md-4 col-xs-6">
            <div class="section-title">
               <h4 class="title">Top selling</h4>
               <div class="section-nav">
                  <div id="slick-nav-4" class="products-slick-nav"></div>
               </div>
            </div>
            <div class="products-widget-slick" data-nav="#slick-nav-4">
               <div>
                  @php
                  $topSellingProducts1 = App\Models\Product::withCount(['orderItems as total_sold' => function ($query) {
                  $query->select(DB::raw('sum(qty)'));
                  }])
                  ->orderByDesc('total_sold')
                  ->take(3)
                  ->get();
                  $topSellingProducts2 = App\Models\Product::withCount(['orderItems as total_sold' => function ($query) {
                  $query->select(DB::raw('sum(qty)'));
                  }])
                  ->orderBy('total_sold')
                  ->take(3)
                  ->get();
                  // $topSellingProducts = App\Models\Product::withCount('order_items')->take(5)->get();
                  @endphp  
                  @foreach ($topSellingProducts1 as $item)
                  <!-- product widget -->
                  <div class="product-widget">
                     <div class="product-img">
                        <img src="{{asset($item->product_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->category->cat_name}}</p>
                        <h3 class="product-name"><a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,30,'...')}}</a></h3>
                        @if ($item->product_discount)
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                        @else
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                        @endif
                     </div>
                  </div>
                  <!-- /product widget -->
                  @endforeach
               </div>
               <div>
                  @foreach ($topSellingProducts2 as $item)
                  <!-- product widget -->
                  <div class="product-widget">
                     <div class="product-img">
                        <img src="{{asset($item->product_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->category->cat_name}}</p>
                        <h3 class="product-name"><a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,30,'...')}}</a></h3>
                        {{-- 
                        <h4 class="product-price">{!!$currency->currency_symbol!!} 980.00 <del class="product-old-price">$990.00</del></h4>
                        --}}
                        @if ($item->product_discount)
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                        @else
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                        @endif
                     </div>
                  </div>
                  <!-- /product widget -->
                  @endforeach
               </div>
            </div>
         </div>
         <div class="clearfix visible-sm visible-xs"></div>
         <div class="col-md-4 col-xs-6">
            <div class="section-title">
               <h4 class="title">New Product</h4>
               <div class="section-nav">
                  <div id="slick-nav-5" class="products-slick-nav"></div>
               </div>
            </div>
            @php
            $newProductsDes = App\Models\Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            $newProductsAsc = App\Models\Product::where('status', 'active')
            ->orderBy('created_at','desc')
            ->skip(3)
            ->take(3)
            ->get();
            @endphp
            <div class="products-widget-slick" data-nav="#slick-nav-5">
               <div>
                  @foreach ($newProductsDes as $item)
                  <!-- product widget -->
                  <div class="product-widget">
                     <div class="product-img">
                        <img src="{{asset($item->product_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->category->cat_name}}</p>
                        <h3 class="product-name"><a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,30,'...')}}</a></h3>
                        {{-- 
                        <h4 class="product-price">{!!$currency->currency_symbol!!} 980.00 <del class="product-old-price">$990.00</del></h4>
                        --}}
                        @if ($item->product_discount)
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                        @else
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                        @endif
                     </div>
                  </div>
                  <!-- /product widget -->
                  @endforeach
               </div>
               <div>
                  @foreach ($newProductsAsc as $item)
                  <!-- product widget -->
                  <div class="product-widget">
                     <div class="product-img">
                        <img src="{{asset($item->product_photo)}}" alt="">
                     </div>
                     <div class="product-body">
                        <p class="product-category">{{$item->category->cat_name}}</p>
                        <h3 class="product-name"><a href="{{url('/product/details/'.$item->id.'/'.$item->product_slug)}}">{{Str::limit($item->product_name,30,'...')}}</a></h3>
                        {{-- 
                        <h4 class="product-price">{!!$currency->currency_symbol!!} 980.00 <del class="product-old-price">$990.00</del></h4>
                        --}}
                        @if ($item->product_discount)
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format(($item->product_price-$item->product_discount),2,'.',',')}}<del class="product-old-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</del></h4>
                        @else
                        <h4 class="product-price">{!!$currency->currency_symbol!!}{{number_format($item->product_price, 2, '.', ',')}}</h4>
                        @endif
                     </div>
                  </div>
                  <!-- /product widget -->
                  @endforeach
               </div>
            </div>
         </div>
      </div>
      <!-- /row -->
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->
@section('script')
<script>
   $(document).ready(function() {
       var countDownDate = new Date("{{ $stopTime }}").getTime();
   
       var x = setInterval(function() {
           var now = new Date().getTime();
           var distance = countDownDate - now;
   
           var days = Math.floor(distance / (1000 * 60 * 60 * 24));
           var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
           var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
           var seconds = Math.floor((distance % (1000 * 60)) / 1000);
   
           $('#days').text(days.toString().padStart(2, '0'));
           $('#hours').text(hours.toString().padStart(2, '0'));
           $('#minutes').text(minutes.toString().padStart(2, '0'));
           $('#seconds').text(seconds.toString().padStart(2, '0'));
   
           if (distance < 0) {
               clearInterval(x);
               $('#days').text('00');
               $('#hours').text('00');
               $('#minutes').text('00');
               $('#seconds').text('00');
           }
       }, 1000);
   });
</script>
@endsection
@endsection