@extends('frontend.master')
@section('title','Search')
@section('content')
    
<!-- BREADCRUMB -->
<div id="" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="{{url('/')}}">Home</a></li>
                    {{-- <li><a href="#">{{$category->cat_name}}</a></li> --}}
                    
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        
        {{-- <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <h3>{{strtoupper($category->cat_name)}}</h3>
            </div>
        </div> --}}
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Categories</h3>
                    <div class="checkbox-filter">
                        <div id="categoryContent">

                        @forelse ($cat as $key => $item)
                        @php
                            $pro = App\Models\Product::where('cat_id',$item->id)->count();
                        @endphp
                        <div class="input-checkbox">
                            <label data-category-id="{{$item->id}}" for="category-{{$key+1}}">
                                <span></span>
                                {{$item->cat_name}}
                                <small>({{$pro}})</small>
                            </label>
                        </div>
                        @empty
                            <h5>No Category found</h5>
                        @endforelse
                    </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Brand</h3>
                    <div class="checkbox-filter">
                        
                        <div id="brandContainer">
                            @forelse ($brand as $key => $item)
                                @php
                                    $pro = App\Models\Product::where('brand_id', $item->id)->count();
                                @endphp
                                <div class="input-checkbox">
                                    <label data-brand-id="{{$item->id}}" for="brand-{{$key+1}}">
                                        <span></span>
                                        {{$item->brand_name}}
                                        <small>({{$pro}})</small>
                                    </label>
                                </div>
                            @empty
                                <h5>No brand found</h5>
                            @endforelse
                        </div>
                        

                    </div>
                </div>
                <!-- /aside Widget -->

               <!-- aside Widget -->
               <div class="aside">
                <h3 class="aside-title">Price</h3>
                <div class="price-filter">
                    {{-- <div id="price-slider"></div> --}}
                    <div class="input-number price-min">
                        <input id="price-min" type="number" value="1" placeholder="min">
                        <span class="qty-up">+</span>
                        <span class="qty-down">-</span>
                    </div>
                    <span>-</span>
                    <div class="input-number price-max">
                        <input id="price-max" type="number" value="20000" placeholder="max" >
                        <span class="qty-up">+</span>
                        <span class="qty-down">-</span>
                    </div>
                </div>
            </div>
            {{-- <a onchange="handlePriceChange()">BTN</a> --}}

            <button style="margin-top: 10px" class="btn" id="handlePriceChange">Search</button>
            
                <!-- /aside Widget -->
           


                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Top selling</h3>
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product01.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>

                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product02.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>

                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product03.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->


            <!-- STORE -->
            <div id="store" class="col-md-9">

                <!-- /store top filter -->

                <!-- store products -->

                        @include('frontend.search_render')

                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<script src="{{asset('frontend/js/jquery.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(document).ready(function() {

        $('#handlePriceChange').on('click',function(){
           const priceMin = $('#price-min').val();
           const priceMax = $('#price-max').val();
           const cat_id = $('#cat_id').val();
           
        //    var selectedBrandIds = [];
        //     $("input[name='brand_checkbox']:checked").each(function() {
        //     selectedBrandIds.push($(this).data('brand-id'));
        //     });
            $.ajax({
                type: 'GET',
                url: "{{route('cat_wise.product.search')}}", 
                data: {
                    priceMin: priceMin,
                    priceMax: priceMax,
                    cat_id: cat_id,
                    // selectedBrandIds: selectedBrandIds
                },
                success: function (response) {
                    console.log(response);
                    $('#render_product').html(response);

                },
                error: function (error) {
                    console.error(error);
             
                }
            });
        });

        $("#brandContainer").on("click", "label", function() {
          var brandId = $(this).data("brand-id");
          brand(brandId);
          });
        function brand(id){

            var brand_id = id;
           const cat_id = $('#cat_id').val();

            $.ajax({
                type: 'GET',
                url: "{{route('brand_wise.product.search')}}", 
                data: {
                    brand_id:brand_id, cat_id: cat_id
                },
                success: function (response) {
                    // console.log(response);
                    $('#render_product').html(response);
                },
                error: function (error) {
                    console.error(error);
             
                }
            });
        }//end brand
        
        //category start
        $('#categoryContent').on('click','label',function(){
            var categoryID = $(this).data('category-id');
            // alert(categoryID);
            category(categoryID);
        })
        function category(id){
            var cat_id = id;
            $.ajax({
                type:'get',
                url:"{{route('rendering_cat_wiseProduct')}}",
                data:{cat_id:cat_id},
                success : function(response){
                    // console.log(response);
                    $('#render_product').html(response);
                },
                error:function(error){
                    console.log(error);
                }
            })
        }



    });


    </script>

@endsection