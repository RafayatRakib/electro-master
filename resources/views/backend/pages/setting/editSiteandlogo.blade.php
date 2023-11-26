@extends('backend.master')
@section('title','Edit Site and Logo')
@section('content')
<div class="container">

    <div class="my-5 ">
        <div class="card p-2">
            <form action="{{route('logoandsite.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="logo_name_id" value="{{$logo->id}}">
                <div class="my-3">
                    <label for="site name" class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control @error('site_name')is-invalid @enderror" id="site_name" placeholder="ex: Electro Master" value="{{$logo->name}}">
                    @error('site_name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control @error('logo')is-invalid @enderror" id="logo">
                    @error('logo')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div id="image-preview">
                    <img style="width: 169px;" src="{{asset($logo->logo)}}" alt="" srcset="">
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#logo').change(function () {
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