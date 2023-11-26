@extends('backend.master')
@section('title','Edit Return Reson')
@section('content')
    <div class="container">
        <div class="my-5">
            
            <div class="card mb-3">
                <h5 class="card-header">Edit Reson</h5>
            <div class="card-body">
                <form action="{{route('update.return.reson')}}" method="post">
                    @csrf
                    <div class="my-2">
                        <input type="hidden" name="reson_id" value="{{$reson->id}}">
                        <label for="defaultFormControlInput" class="form-label">Return Reson</label>
                        <input type="text" name="return_reson" id="return_reson" class="form-control @error('return_reson')is-invalid @enderror" id="defaultFormControlInput" value="{{$reson->return_reson}}" placeholder="Ex: Broken, Wrong Product etc" aria-describedby="defaultFormControlHelp">
                        @error('return_reson') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Reson</button>
                </form>
            </div>

        </div>
        </div>
    </div>
@endsection