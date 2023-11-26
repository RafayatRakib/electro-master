@extends('backend.master')
@section('title','Brand Edit')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
    <div class="card mb-4">
        <h5 class="card-header">Add Brand</h5>
        <div class="card-body">
        <form action="{{route('brand.update')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div>
            <input type="hidden" name="brand_id" value="{{$brand->id}}">
            <label for="defaultFormControlInput" class="form-label">Brand Name</label>
            <input type="text" name="Brand" class="form-control @error('Brand')is-invalid @enderror" id="defaultFormControlInput" value="{{$brand->brand_name}}" placeholder="Ex: Fashion, Laptops etc..." aria-describedby="defaultFormControlHelp">
            @error('brand') <strong class="text-danger">{{$message}}</strong> @enderror <br>
            <input type="file" id="brand_photo" name="brand_photo" class="form-control  @error('brand')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Fashion, Laptops etc..." aria-describedby="defaultFormControlHelp">
            @error('brand_photo') <strong class="text-danger">{{$message}}</strong> @enderror <br>
            <div id="image-preview"> 
                <img src="{{asset($brand->brand_photo)}}" style="width:100px">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
        </div>
      </div>
</div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#brand_photo').change(function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#image-preview').html('<img style="width:100px" src="' + e.target.result + '" alt="Image Preview">');
            };
            reader.readAsDataURL(file);
        } else {
            $('#image-preview').html('');
        }
    });
});


</script>

@endsection