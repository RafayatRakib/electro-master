@extends('backend.master')
@section('title','Add Image')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card my-3">
                <div class="container">
                    <h3 class="p-3">Add Images:</h3>
                    <form action="{{route('admin.store.image')}}" method="post" enctype="multipart/form-data">
                        @csrf
                     <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Images: </label>
                        <input type="file" name="images[]" multiple id="images" class="form-control @error('images')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Jone Doe" aria-describedby="defaultFormControlHelp">
                        @error('images') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label">Width: (px only)-- optional  </label>
                        <input type="text" name="width"   id="width" class="form-control @error('width')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: 80px" aria-describedby="defaultFormControlHelp">
                        @error('width') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <div class="my-2">
                        <label for="defaultFormControlInput" class="form-label" >Height: (px only)-- optional </label>
                        <input type="text" name="height" id="height" class="form-control @error('height')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: 120px" aria-describedby="defaultFormControlHelp">
                        @error('height') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <div class="my-2">
                        <button class="btn btn-dark" type="submit">Store</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

</div>
@section('script')


@endsection
@endsection
