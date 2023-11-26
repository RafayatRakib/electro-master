@extends('backend.master')

@section('title','Product Details')
@section('content')
<div class="container">
    <div class="mt-5">
        <div class="row">
            <div class="col-md-8 col-xl-8">
                <div class="card  p-3" style="height: 300px">
                    
                    <div class="title py-3 d-flex justify-content-between">
                        <h3>Product Details</h3>
                        <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">Edit</a>
                    </div>
                    <table>
                       <tbody class="table">
                        <tr>
                          <th> <strong>Product</strong> </th>
                          <th> <strong> {{$product->product_name}} </strong> </th>
                       </tr>
                       <tr>

                          <th> <strong>Category</strong> </th>
                          <th> <strong>{{$product->category->cat_name}}</strong> </th>
                       </tr>
                       <tr>
                          <th> <strong>Brand</strong> </th>
                          @if ($product->brand_id == '0')
                          <th> <strong class="text-danger"> No brand </strong> </th>
                              
                          @else
                          <th> <strong> {{$product->brand->brand_name}} </strong> </th>
                          @endif
                       </tr>
                       <tr>
                          <th> <strong>Code</strong> </th>
                          <th> <strong>{{$product->product_code}}</strong> </th>
                       </tr>
                       <tr>
                          <th> <strong>QTY</strong> </th>
                          <th> <strong>{{$product->qty}}</strong> </th>
                       </tr>
                       <tr>
                          <th> <strong>Purchase</strong> </th>
                          <th> <strong>{{$product->purchase_price}}</strong> </th>
                       </tr>
                       <tr>
                        <th> <strong>Price</strong> </th>
                        <th> <strong>{{$product->product_price}}</strong> </th>
                     </tr>
                       <tr>
                          <th> <strong>Discount</strong> </th>
                          <th> <strong>{{$product->product_discount}}</strong> </th>
                       </tr>
                       <tr>
                        <th> <strong>Status</strong> </th>
                        <th> <strong>{{$product->Status}}</strong> </th>
                     </tr>
                    </tbody>
                </table>
                 </div>
            
            </div>
            <div class="col-md-4 col-xl-4">
               <div class="card p-3">
                <div class="">
                    <h4>Product thumboline</h4>
                    <img src="{{asset($product->product_photo)}}" style="width: 70px">
                <hr>
                </div>
                <div class="">
                    @php
                        $images = App\Models\Multi_photo::where('product_id',$product->id)->get();
                    @endphp
                    <h5>Multipale images</h5>
                    @foreach ($images as $item)
                    <img src="{{asset($item->multi_photo)}}" style="width: 70px">
                        
                    @endforeach
                </div>
            </div>
                
            </div>
        </div>


    <div class="mt-5">
        <h2 class="">Product Details</h2>
        <div class="nav-align-top mb-4">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                Short Description
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                Logn Description
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                Details
              </button>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                {!! $product->short_des !!}
            </div>
            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                {!! $product->long_des !!}
            </div>
            <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                {!! $product->details !!}
            </div>
          </div>
        </div>
      </div>

    </div>
</div>


@endsection