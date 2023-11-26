@extends('backend.master')
@section('title','Flash Sales')
@section('content')
    <div class="container">
        <div class="my-5">
            <h4 class="title">Add Flash Sales:</h4>

            <div class="card">
                <div class="container">

                <form action="" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="my-3 ">
                                <label for="defaultFormControlInput" class="form-label">Start Time:</label>
                                <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time')is-invalid @enderror" id="defaultFormControlInput" value="{{old('coupon')}}" placeholder="Ex: CRISMAS007" aria-describedby="defaultFormControlHelp">
                                @error('start_time') <strong class="text-danger">{{$message}}</strong> @enderror 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="my-3 ">
                                <label for="defaultFormControlInput" class="form-label">Ending Time</label>
                                <input type="datetime-local" name="end_time" id="end_time" class="form-control @error('end_time')is-invalid @enderror" id="defaultFormControlInput" value="{{old('coupon')}}" placeholder="Ex: CRISMAS007" aria-describedby="defaultFormControlHelp">
                                @error('end_time') <strong class="text-danger">{{$message}}</strong> @enderror 
                            </div>
                        </div>
                    </div>

                    



                </form>
            </div>
        </div>
    </div>
    </div>
@endsection