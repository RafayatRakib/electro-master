@extends('backend.master')
@section('title','Add Upazila')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="row">
                <div class="col-md-6">
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">Add District</h5>
                    <div class="mt-3 mx-3">
                        <a class="btn btn-dark" href="{{route('admin.all.upazila')}}">All Upazila</a>
                    </div>
                </div>
                <div class="card-body">
                <form action="{{route('upazila.store')}}" method="post">
                    @csrf
                  <div>
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Default select</label>
                        <select id="defaultSelect" name="district" class="form-select @error('district') is-invalid @enderror">
                          <option selected disabled>Select District</option>
                          @foreach ($district as $item)
                          <option value="{{$item->id}}">{{$item->district_name}}</option>
                          @endforeach
                        </select>
                        @error('district')<strong class="text-danger">{{$message}}</strong> @enderror
                      </div>
                    <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Upazila Name</label>
                    <input type="text" name="upazila" class="form-control @error('upazila')is-invalid @enderror"  placeholder="Ex: Sonargaon" aria-describedby="defaultFormControlHelp">
                    @error('upazila') 
                    <strong class="text-danger">{{$message}}</strong> @enderror 
                </div>


                    
                    <button type="submit" class="btn btn-primary">Add Upazila </button>
                  </div>
                </form>
                </div>
              </div>
        </div>
    </div>
        </div>
    </div>
@endsection