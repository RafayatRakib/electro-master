@extends('backend.master')
@section('title', 'Edit Product')
@section('content')

<div class="container mt-5">
    <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="product_id" value="{{$product->id}}" >
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control @error('product_name')is-invalid @enderror"  id="product_name" placeholder="Machin" value="{{$product->product_name}}" aria-describedby="defaultFormControlHelp">
                        @error('product_name')  <strong class="text-danger"> {{$message}} </strong> @enderror
                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Product Size(*)</label>
                        <input type="text"  name="product_size" class="form-control @error('product_size') is-invalid @enderror"  id="product_size" value="{{$product->product_size}}" placeholder="Size Ex: M,L,XL,XXL" aria-describedby="defaultFormControlHelp" data-role="tagsinput">
                        @error('product_size')  <strong class="text-danger"> {{$message}} </strong> @enderror

                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Product Color(*)</label>
                        <input type="text" name="product_color" class="form-control @error('product_color')is-invalid @enderror" id="product_color" value="{{$product->product_color}}" placeholder="Color Ex: Red,Blue,Green" aria-describedby="defaultFormControlHelp" data-role="tagsinput">
                        @error('product_color')  <strong class="text-danger"> {{$message}} </strong> @enderror

                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Short Description</label>
                        <textarea name="short_des" id="summernote" class="form-control @error('short_des')is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{!! $product->short_des !!}</textarea>
                        @error('short_des')  <strong class="text-danger"> {{$message}} </strong> @enderror

                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Long Description</label>
                        <textarea name="long_des" id="summernote2" class="form-control @error('long_des')is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{!! $product->long_des !!}</textarea>
                        @error('long_des')  <strong class="text-danger"> {{$message}} </strong> @enderror
                    </div>

                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Details</label>
                        <textarea name="details" id="summernote3" class="form-control @error('details')is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{!! $product->details !!}</textarea>
                        @error('details')  <strong class="text-danger"> {{$message}} </strong> @enderror
                    </div>

                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Product Photo</label>
                        <input type="file" name="product_photo" class="form-control @error('product_photo') is-invalid @enderror" >
                        @error('product_photo')  <strong class="text-danger"> {{$message}} </strong> @enderror
                        <img src="{{asset($product->product_photo)}}" style="width: 100px" alt="">
                    </div>

                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Product Multi Photo(*)</label> <small>If you select multiple images, then previews photo are deleted</small>
                        <input type="file"  name="product_multi_photo[]" class="form-control @error('product_multi_photo') is-invalid @enderror" multiple>
                    
                        @php
                            $multi_photo = DB::table('multi_photos')->where('product_id',$product->id)->get();
                        @endphp
                        @foreach ($multi_photo as $item)
                        <img src="{{asset($item->multi_photo)}}" style="width: 100px" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="my-2">
                                <label for="defaultFormControlInput" class="form-label">Purchase price (*)</label>
                                <input type="text" name="purchase_price" class="form-control @error('purchase_price')is-invalid @enderror"  id="purchase_price" placeholder="Ex: 80" value="{{$product->purchase_price}}" aria-describedby="defaultFormControlHelp">
                            @error('purchase_price')  <strong class="text-danger"> {{$message}} </strong> @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="my-2">
                                <label for="defaultFormControlInput" class="form-label">Product Price</label>
                                <input type="text" name="product_price" class="form-control @error('product_price')is-invalid @enderror"  id="product_price" placeholder="0.00" value="{{$product->product_price}}" aria-describedby="defaultFormControlHelp">
                        @error('product_price')  <strong class="text-danger"> {{$message}} </strong> @enderror

                            </div>
                        </div>
                        <div class="col">
                            <div class="my-2">
                                <label for="defaultFormControlInput" class="form-label">Product QTY</label>
                                <input type="text" name="qty" class="form-control @error('qty')is-invalid @enderror"  id="qty" placeholder="Ex: {{$product->qty}}" aria-describedby="defaultFormControlHelp">
                                <div id="defaultFormControlHelp" class="form-text">
                                    Current QTY: <strong>{{$product->qty}}</strong>
                                  </div>
                                @error('qty')  <strong class="text-danger"> {{$message}} </strong> @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="my-2">
                                <label for="defaultFormControlInput" class="form-label">QTY Worning (*)</label>
                                <input type="text" name="qty_warning" class="form-control @error('qty_warning')is-invalid @enderror"  id="qty_warning" placeholder="Ex: 100" value="{{$product->qty_warning}}" aria-describedby="defaultFormControlHelp">
                            @error('qty_warning')  <strong class="text-danger"> {{$message}} </strong> @enderror

                            </div>
                        </div>
                    
                        <div class="col">
                            <div class="my-2">
                                <label for="defaultFormControlInput" class="form-label">Discount(*)</label>
                                <input type="text" name="product_discount"  class="form-control @error('product_discount')is-invalid @enderror" id="product_discount" placeholder="0.00" value="{{$product->product_discount}}" aria-describedby="defaultFormControlHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="my-2">
                                <label for="defaultFormControlInput" class="form-label">Product Code(*)</label>
                                <input type="text" class="form-control @error('product_code')is-invalid @enderror" name="product_code" id="product_code" disabled placeholder="Product Code" value="{{$product->product_code}}" aria-describedby="defaultFormControlHelp">
                                <div id="defaultFormControlHelp" class="form-text">
                                    If you not provide any code it will genarate autometicly
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                    <label for="defaultFormControlInput" class="form-label">Product Brand</label>

                    <select id="defaultSelect" name="brand" class="form-select @error('brand')is-invalid @enderror">
                        <option disabled >Select Brand</option>
                        @if ($product->brand_id == '0')
                        <option value="0">--No Brand</option>
                        @else
                        <option selected value="{{$product->brand_id}}"> --{{$product->brand->brand_name}} </option>
                        @endif
                        <option value="0">No Brand</option>
                        @foreach ($brand as $item)
                        <option value="{{$item->id}}">{{$item->brand_name}}</option>
                        @endforeach
                      </select>
                      @error('brand')  <strong class="text-danger"> {{$message}} </strong> @enderror

                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Product Category</label>
                        @php
                           $category = App\Models\Category::findOrFail($product->cat_id);
                        @endphp
                      <select id="defaultSelect" name="category" class="form-select @error('category')is-invalid @enderror">
                        <option disabled >Select Category</option>
                        <option  selected value="{{$category->id}}">--{{$category->cat_name}}</option>
                        @foreach ($cat as $item)
                        <option value="{{$item->id}}">{{$item->cat_name}}</option>
                        @endforeach
                    </select>
                    @error('category')  <strong class="text-danger"> {{$message}} </strong> @enderror

                </div>
                <div class="mt-5">
                    <p>*Optional</p>
                    <hr>
                </div>
                    <div class="row">
                        <div class="col">
                            <div class="my-2">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" {{$product->hot_deals == 1 ? 'checked' : ''}} name="hot_deals" type="checkbox" value="hot_deals" id="defaultCheck1">

                                    <label class="form-check-label" for="defaultCheck1"> Hot Deals </label>
                                  </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="my-2">
                                <div class="form-check mt-3">
                                    <input class="form-check-input"  {{$product->special_offer == 1 ? 'checked' : ''}} name="special_offer" type="checkbox" value="special_offer" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1"> Special Offer</label>
                                  </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="my-2">
                                <div class="form-check mt-3">
                                    <input class="form-check-input"  {{$product->featured == 1 ? 'checked' : ''}} name="featured" type="checkbox" value="featured" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1"> Featured </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5">
                        <button class="btn btn-primary" type="submit">Update Product</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection