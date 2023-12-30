@extends('backend.master')
@section('title','Flash Sales Edit')
@section('content')
<div class="container">
   <div class="my-5">
      <h4 class="title">Add Flash Sales:</h4>
         <div class="card">
            <div class="container">
               <!-- Form for adding/editing flash sale details -->
               <form method="POST" action="{{ route('update_flash_sale')}}" enctype="multipart/form-data">
                  @csrf
                <input name="id" type="hidden" value="{{encrypt($flashSales->id)}}">
                  <div class="row">
                     <div class="col-md-6">   
                  <div class="my-3">
                     <label for="flas_sales_name">Flash Sale Name:</label>
                     <input type="text" id="flas_sales_name" name="flas_sales_name" value="{{$flashSales->flas_sales_name}}" class="form-control" placeholder="Enter Flas sales name">
                     @error('flas_sales_name')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="my-3">
                     <label for="bg_photo">Background Photo:*</label>
                     <input type="file" id="bg_photo" name="bg_photo" class="form-control">
                     @error('bg_photo')
                     <span class="error">{{ $message }}</span>
                     @enderror
                     
                     <div class="mt-2">
                        <img src="{{asset($flashSales->bg_photo)}}" alt="" srcset="">
                     </div>
                  </div>
                  <div class="my-3">
                     <label for="short_note">Short Note:</label>
                     <textarea id="short_note" name="short_note"  class="form-control" placeholder="Enter Short Note">{{$flashSales->short_note}}</textarea>
                     @error('short_note')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="my-3">
                     <label for="discount">Discount:</label>
                     <input type="number" id="discount" name="discount" value="{{$flashSales->discount}}" class="form-control" placeholder="Enter discount">
                     @error('discount')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class="col-md-6">   
                  <div class="my-3">
                     <label for="discount_type">Discount Type:</label>
                     <select id="discount_type" name="discount_type" class="form-control">
                        <option value="{{$flashSales->discount_type}}">--{{$flashSales->discount_type}}</option>
                        <option value="cash">Cash</option>
                        <option value="percentage">Percentage</option>
                     </select>
                     @error('discount_type')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="my-3">
                     <label for="start_time">Start Time:</label>
                     <input type="datetime-local" id="start_time" name="start_time" value="{{$flashSales->start_time}}" class="form-control">
                     @error('start_time')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="my-3">
                     <label for="end_time">End Time:</label>
                     <input type="datetime-local" id="end_time" name="end_time" value="{{$flashSales->end_time}}" class="form-control">
                     @error('end_time')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="my-3">
                     <label for="status">Status:</label>
                     <select id="status" name="status" class="form-control">
                        <option value="{{$flashSales->status}}">--{{$flashSales->status}}</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                     </select>
                     @error('status')
                     <span class="error">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
            </div>
                  <!-- Here you might have fields to associate products with the flash sale -->
                  <!-- For example, a multi-select or other input to select products -->
                  <button type="submit" class="btn btn-primary mb-4">Update Flash Sale</button>
               </form>

        </div>
      </div>

   </div>
</div>
@endsection