@extends('backend.master')
@section('title','Edit Coupon')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="row">
                <div class="col-md-6">
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">Edit Coupon<</h5>
                    <div class="mt-3 mx-3">
                        <a class="btn btn-dark" href="{{route('admin.all.coupon')}}">All Coupon</a>
                    </div>
                </div>
                <div class="card-body">
                <form action="{{route('coupon.update')}}" method="post">
                    @csrf
                  <div>
                    <input type="hidden" name="id" value="{{$coupon->id}}">
                    <label for="defaultFormControlInput" class="form-label">Coupon Code</label>
                    <input type="text" name="coupon" id="coupon" class="form-control @error('coupon')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->coupon_code}}" placeholder="Ex: CRISMAS007" aria-describedby="defaultFormControlHelp">
                    @error('coupon') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    <label for="defaultFormControlInput" class="form-label">Coupon Amount</label>
                    <input type="number" name="coupon_amount" id="coupon_amount" class="form-control @error('coupon_amount')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->amount}}" placeholder="Ex: 500" aria-describedby="defaultFormControlHelp">
                    @error('coupon_amount') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    
                    <label for="defaultFormControlInput" class="form-label">Coupon Percentage</label>
                    <input type="number" name="coupon_percentage" id="coupon_percentage" class="form-control @error('coupon_percentage')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->percentage}}" placeholder="Ex: 10%" aria-describedby="defaultFormControlHelp">
                    @error('coupon_percentage') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    
                    <label for="defaultFormControlInput" class="form-label">Minimum Purchase</label>
                    <input type="number" name="minimum_purchase" id="minimum_purchase" class="form-control @error('minimum_purchase')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->minimum_purchase}}" placeholder="Ex: 500" aria-describedby="defaultFormControlHelp">
                    @error('minimum_purchase') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    <label for="defaultFormControlInput" class="form-label">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control @error('start_date')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->start_date}}" placeholder="Ex: 500" aria-describedby="defaultFormControlHelp">
                    @error('start_date') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    <label for="defaultFormControlInput" class="form-label">Ending Date</label>
                    <input type="datetime-local" name="end_date" id="end_date" class="form-control @error('end_date')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->end_date}}" placeholder="Ex: 500" aria-describedby="defaultFormControlHelp">
                    @error('end_date') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    <label for="defaultFormControlInput" class="form-label">Category</label>
                    <select id="defaultSelect" name="category" class="form-select @error('category')is-invalid @enderror">
                        <option disabled >Select Category</option>
                        <option selected value="{{$coupon->cat_id}}"> {{$coupon->category->cat_name}} </option>

                        @foreach ($cat as $item)
                        <option value="{{$item->id}}">{{$item->cat_name}}</option>
                        @endforeach
                    </select>
                    @error('category') <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    <label for="defaultFormControlInput" class="form-label">Restrictions</label>
                    <input type="number" min="1" name="restrictions" id="restrictions" class="form-control @error('restrictions')is-invalid @enderror" id="defaultFormControlInput" value="{{$coupon->restrictions}}" placeholder="Ex: one-time use" aria-describedby="defaultFormControlHelp">
                    @error('restrictions') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    
                    <button type="submit" class="btn btn-primary">Update Coupon</button>
                  </div>
                </form>
                </div>
              </div>
        </div>
    </div>
        </div>
    </div>
@endsection