@extends('backend.master')
@section('title','Edit Page')
@section('content')

<div class="container mt-5">
    <div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Edit page:</h5>
        <div class="mt-3 mx-3">
            <a class="btn btn-dark" href="{{route('admin.add.page')}}">Add Page</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('page.update')}}" method="post">
            @csrf
            <input type="hidden" name="page_id" value="{{$page->id}}" id="">
          <div>
            <div class="my-2">
                <label for="defaultFormControlInput" class="form-label">Page Title</label>
                <input type="text" name="title" id="title" value="{{$page->title}}" class="form-control @error('title')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: About" aria-describedby="defaultFormControlHelp" value="{{old('title')}}">
                @error('title') <strong class="text-danger">{{$message}}</strong> @enderror 
            </div>

            <div class="my-2">
                <label for="defaultFormControlInput" class="form-label">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{$page->meta_title}}" class="form-control @error('meta_title')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: About" aria-describedby="defaultFormControlHelp" value="{{old('meta_title')}}">
                @error('meta_title') <strong class="text-danger">{{$message}}</strong> @enderror 
            </div>

            <div class="my-2">
                <label for="defaultFormControlInput" class="form-label">Meta Description</label>
                <textarea type="text" name="meta_description" id="meta_description" class="form-control @error('meta_description')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: This meta is about pages..." >{{$page->meta_description}}</textarea>
                @error('meta_description') <strong class="text-danger">{{$message}}</strong> @enderror 
            </div>

            <div class="my-2">
                <label for="defaultFormControlInput" class="form-label">Page Content</label>
                <textarea type="text" name="content" id="summernote4" rows="10" class="form-control @error('content')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Fashion, Laptops etc..." >{{$page->content}}</textarea>
                @error('content') <strong class="text-danger">{{$message}}</strong> @enderror 
            </div>

            <div class="my-2">
                <label for="defaultFormControlInput" class="form-label">status</label>
                <select name="status" class="form-select @error('status')is-invalid @enderror">
                    <option value="{{$page->status}}" selected disabled > --{{$page->status}} </option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status') <strong class="text-danger">{{$message}}</strong> @enderror 
            </div>


            <button type="submit" class="btn btn-primary">Update Page</button>
          </div>
        </form>
        </div>




</div>
</div>
@endsection