<div class="row">
   <!-- product -->
   <div id="render_product">
<input type="hidden" name="cat_id" value="{{$id}}" id="cat_id">
<div style="margin-bottom: 5px!important">
   <h1>{{strtoupper($category->cat_name)}}</h1>
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
@empty
    <h3>No product found</h3>
@endforelse

</div>
<!-- /product -->
</div>
<!-- /store products -->

<!-- store bottom filter -->
<div class="store-filter clearfix">
{{$product->links('vendor.pagination.frontend')}}
</div>