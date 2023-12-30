<div class="row">
   <!-- product -->
   <div id="render_product">
<input type="hidden" name="cat_id" value="{{$id}}" id="cat_id">
<div style="margin-bottom: 5px!important">
   @if ($category->cat_name)
   <h1>{{strtoupper($category->cat_name)}}</h1>
   @endif
   <h4>
      {{-- {{ session()->get('search_input') }} --}}
   @if (!$category->cat_name)
       
      @if(isset($product) && $product->count() > 0)
      <p>{{ $product->count() }} items found for "<strong class="text-danger"> {{ session()->get('search_input') }} </strong>"</p>
      @else
      <p>No items found for " <strong class="text-danger"> {{ session()->get('search_input') }} </strong>"</p>
      @endif
   @else
   @endif

   
   </h4>
   <hr style="border-bottom: 1px solid #dbdbdb">
</div>
@forelse ($product as $item)
@php
        $currency = App\Models\Currency::where('status','active')->first();
    
@endphp
<div class="col-md-4 col-xs-6">
    <div class="product">
        <div class="product-img">
           <img src="{{asset($item->product_photo)}}" alt="">
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
</div>
@empty
      <h4>No items found</h4>
@endforelse

</div>
<!-- /product -->
</div>
<!-- /store products -->

<!-- store bottom filter -->
<div class="store-filter clearfix">
{{-- {{$product->links('vendor.pagination.frontend')}} --}}
</div>