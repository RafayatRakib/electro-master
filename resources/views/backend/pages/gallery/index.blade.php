@extends('backend.master')
@section('title','Image Gallery')
@section('content')
@php
// Fetching images from different tables
$customPhoto = App\Models\Gallery::orderBy('created_at', 'desc')->pluck('image_path')->toArray();
$productImages = App\Models\Product::orderBy('created_at', 'desc')->pluck('product_photo')->toArray();
$multi_photo = App\Models\multi_photo::orderBy('created_at', 'desc')->pluck('multi_photo')->toArray();
$productImages = App\Models\Product::orderBy('created_at', 'desc')->pluck('product_photo')->toArray();
$categoryImages = App\Models\Category::orderBy('created_at', 'desc')->pluck('cat_photo')->toArray();
$brandImages = App\Models\Brand::orderBy('created_at', 'desc')->pluck('brand_photo')->toArray();
// dd($customPhoto);
// Merge all image paths into one array
$allImages = array_merge($customPhoto, $productImages, $multi_photo, $categoryImages, $brandImages);
$randomizedImages = Arr::shuffle($allImages);
@endphp
<style>
   /* Overlay styling */
   .overlay {
   background-color: rgba(0, 0, 0, 0.7);
   opacity: 0;
   transition: opacity 0.5s ease;
   }
   /* Text styling */
   .overlay button {
   font-size: 20px;
   font-weight: bold;
   }
   /* Hover effect */
   .image-container:hover .overlay {
   opacity: 1;
   }
   /* Copied button style */
   .copied {
   background-color: green !important;
   }
</style>
<div class="container">
   <div class=" mt-5">
      <div class="catd ">
        <div class="d-flex justify-content-between">

          <div class="card-title">
            <h3 class="p-3">Gallery</h3>
          </div>
          <div>
            <a href="{{route('admin.add.image')}}" class="btn btn-primary">Add Images</a>
          </div>
        </div>
         <hr>
         <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item ">
                  <button type="button" class="nav-link {{session()->get('custom_image')?'':'active'}}" role="tab" data-bs-toggle="tab" data-bs-target="#all_image" aria-controls="all_image" aria-selected="true">
                  All
                  </button>
               </li>
               <li class="nav-item">
                  <button type="button" class="nav-link {{session()->get('custom_image')?'active':''}}" role="tab" data-bs-toggle="tab" data-bs-target="#custom_image" aria-controls="custom_image" aria-selected="false">
                  Custom Images
                  </button>
               </li>
               <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#product_image" aria-controls="product_image" aria-selected="false">
                  Product  
                  </button>
               </li>
               <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#product_Item_image" aria-controls="product_Item_image" aria-selected="false">
                  Product Item Image
                  </button>
               </li>
               <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#category_image" aria-controls="category_image" aria-selected="false">
                  Category
                  </button>
               </li>
               <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#brand_image" aria-controls="brand_image" aria-selected="false">
                  Brand   
                  </button>
               </li>
            </ul>
            <div class="tab-content">
               {{-- All Images start --}}
               <div class="tab-pane  fade  {{session()->get('custom_image')?'':'active show'}} " id="all_image" role="tabpanel">
                  <div class="row">
                     @forelse ($randomizedImages as $image)
                     <div class="col-md-3">
                        <div class="image-container position-relative my-2">
                           <img src="{{ asset($image) }}" alt="Image 1" class="w-100 h-100 img-fluid">
                           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                              <input type="hidden" name="url" class="url" value="{{ URL::to('/') . '/' . $image }}">
                              <button class="copyButton btn btn-primary">Copy link</button>
                           </div>
                        </div>
                     </div>
                     @empty
                     <h3>No image found...!</h3>
                     @endforelse
                  </div>
               </div>
               {{-- All Images end --}}
               {{-- custom images start --}}
               <div class="tab-pane fade {{session()->get('custom_image')?'active show':' '}}" id="custom_image" role="tabpanel">
                  <div class="row">
                     @forelse ($customPhoto as $image)
                     <div class="col-md-3">
                        <div class="image-container position-relative my-2">
                           <img src="{{ asset($image) }}" alt="Image 1" class="w-100 h-100 img-fluid">
                           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                              <input type="hidden" name="url" class="url" value="{{ URL::to('/') . '/' . $image }}">
                              <button class=" btn btn-primary">Copy link</button>
                              <a onclick="return confirm('Are you sure to delete it?')" href="{{route('admin.image.delete',encrypt($image))}}" class=" btn btn-danger">Delete</a>
                           </div>
                        </div>
                     </div>
                     @empty
                     <h3>No image found...!</h3>
                     @endforelse
                  </div>
               </div>
               {{-- custom images end --}}
               {{-- product image start --}}
               <div class="tab-pane fade" id="product_image" role="tabpanel">
                  <div class="row">
                     @forelse ($productImages as $image)
                     <div class="col-md-3">
                        <div class="image-container position-relative my-2">
                           <img src="{{ asset($image) }}" alt="Image 1" class="w-100 h-100 img-fluid">
                           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                              <input type="hidden" name="url" class="url" value="{{ URL::to('/') . '/' . $image }}">
                              <button class="copyButton btn btn-primary">Copy link</button>
                           </div>
                        </div>
                     </div>
                     @empty
                     <h3>No image found...!</h3>
                     @endforelse
                  </div>
               </div>
               {{-- product image end --}}
               {{-- product item image start --}}
               <div class="tab-pane fade" id="product_Item_image" role="tabpanel">
                  <div class="row">
                     @forelse ($multi_photo as $image)
                     <div class="col-md-3">
                        <div class="image-container position-relative my-2">
                           <img src="{{ asset($image) }}" alt="Image 1" class="w-100 h-100 img-fluid">
                           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                              <input type="hidden" name="url" class="url" value="{{ URL::to('/') . '/' . $image }}">
                              <button class="copyButton btn btn-primary">Copy link</button>
                           </div>
                        </div>
                     </div>
                     @empty
                     <h3>No image found...!</h3>
                     @endforelse
                  </div>
               </div>
               {{-- product item image end --}}
               {{-- category image start --}}
               <div class="tab-pane fade" id="category_image" role="tabpanel">
                  <div class="row">
                     @forelse ($categoryImages as $image)
                     <div class="col-md-3">
                        <div class="image-container position-relative my-2">
                           <img src="{{ asset($image) }}" alt="Image 1" class="w-100 h-100 img-fluid">
                           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                              <input type="hidden" name="url" class="url" value="{{ URL::to('/') . '/' . $image }}">
                              <button class="copyButton btn btn-primary">Copy link</button>
                           </div>
                        </div>
                     </div>
                     @empty
                     <h3>No image found...!</h3>
                     @endforelse
                  </div>
               </div>
               {{-- category image end --}}
               {{-- brand image start --}}
               <div class="tab-pane fade" id="brand_image" role="tabpanel">
                  <div class="row">
                     @forelse ($brandImages as $image)
                     <div class="col-md-3">
                        <div class="image-container position-relative my-2">
                           <img src="{{ asset($image) }}" alt="Image 1" class="w-100 h-100 img-fluid">
                           <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                              <input type="hidden" name="url" class="url" value="{{ URL::to('/') . '/' . $image }}">
                              <button class="copyButton btn btn-primary">Copy link</button>
                           </div>
                        </div>
                     </div>
                     @empty
                     <h3>No image found...!</h3>
                     @endforelse
                  </div>
               </div>
               {{-- brand image end --}}
            </div>
         </div>
         <div class="my-5">
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
     $('.copyButton').on('click', function() {
       const url = $(this).prev('.url').val();
       const tempInput = $('<input>');
       $('body').append(tempInput);
       tempInput.val(url).select();
   
       document.execCommand('copy');
       tempInput.remove();
       
       // Change button color and text after copying
       $(this).addClass('copied').text('Copied!');
     });
   });
</script>
</script>
@endsection