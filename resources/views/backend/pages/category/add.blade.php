@extends('backend.master')
@section('title','Category List')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
        <div class="card mb-4">
            {{-- <h5 class="card-header">Add Category</h5> --}}
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Add Category</h5>
                <div class="mt-3 mx-3">
                    <a class="btn btn-dark" href="{{route('admin.cat.all')}}">All Category</a>
                </div>
            </div>
            <div class="card-body">
            <form action="{{route('cat.store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div>
                <label for="defaultFormControlInput" class="form-label">Category Name</label>
                <input type="text" name="category" id="category" class="form-control @error('category')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Fashion, Laptops etc..." aria-describedby="defaultFormControlHelp">
                @error('category') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                <input type="file" id="category_photo" name="category_photo" class="form-control  @error('category')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Fashion, Laptops etc..." aria-describedby="defaultFormControlHelp">
                @error('category_photo') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                <div id="image-preview"></div>
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
    $('#category_photo').change(function () {
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