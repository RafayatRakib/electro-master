@extends('backend.master')
@section('title','Add District')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="row">
                <div class="col-md-6">
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">Add District</h5>
                    <div class="mt-3 mx-3">
                        <a class="btn btn-dark" href="{{route('admin.all.district')}}">All District</a>
                    </div>
                </div>
                <div class="card-body">
                <form action="{{route('district.store')}}" method="post">
                    @csrf
                  <div>
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Default select</label>
                        <select id="defaultSelect" name="division" class="form-select @error('division') is-invalid @enderror">
                          <option selected disabled>Select Divison</option>
                          @foreach ($division as $item)
                          <option value="{{$item->id}}">{{$item->division_name}}</option>
                          @endforeach
                        </select>
                        @error('division')<strong class="text-danger">{{$message}}</strong> @enderror
                      </div>
                    <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">District Name</label>
                    <input type="text" name="district" id="district" class="form-control @error('district')is-invalid @enderror"  placeholder="Ex: Dhaka" aria-describedby="defaultFormControlHelp">
                    @error('district') 
                    <strong class="text-danger">{{$message}}</strong> @enderror 
                </div>

                    <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Delivery Charge</label>
                    <input type="number" name="delivery_charge" id="delivery_charge" class="form-control @error('delivery_charge')is-invalid @enderror" placeholder="Ex: 100..." aria-describedby="defaultFormControlHelp">
                    @error('delivery_charge')<strong class="text-danger">{{$message}}</strong> @enderror
                </div>

                    
                    <button type="submit" class="btn btn-primary">Add District</button>
                  </div>
                </form>
                </div>
              </div>
        </div>
    </div>
        </div>
    </div>
@endsection