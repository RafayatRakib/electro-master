@extends('backend.master')
@section('title','Add Division')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="row">
                <div class="col-md-6">
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">Add Division</h5>
                    <div class="mt-3 mx-3">
                        <a class="btn btn-dark" href="{{route('admin.all.division')}}">All Division</a>
                    </div>
                </div>
                
                <div class="card-body">
                <form action="{{route('division.store')}}" method="post">
                    @csrf
                  <div>
                    <label for="defaultFormControlInput" class="form-label">Division Name</label>
                    <input type="text" name="division" id="division" class="form-control @error('division')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Dhaka" aria-describedby="defaultFormControlHelp">
                    @error('division') 
                    <strong class="text-danger">{{$message}}</strong> @enderror <br>

                    <button type="submit" class="btn btn-primary">Add Division</button>
                  </div>
                </form>
                </div>
              </div>
        </div>
    </div>
        </div>
    </div>
@endsection