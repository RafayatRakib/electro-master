@extends('backend.master')
@section('content')
@section('title','Site and Logo')
<div class="container">
    <div class="my-5 ">
        <div class="p-2 card">
            <h3>Site and Logo: </h3>
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif
            <form action="{{route('logoandsite.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="my-3">
                    <label for="site name" class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control @error('site_name')is-invalid @enderror" id="site_name" placeholder="ex: Electro Master">
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
                <div id="image-preview"></div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="my-5">
            <div class="card">
                <h5 class="card-header">Logo and Site name list</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Logo</th>
                        <th>Site Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($logo as $key => $item)
                            
                      <tr>
                        <td>{{$key+1}}</td>
                        <td><img src="{{asset($item->logo)}}" style="width: 80px; height: 65px;" alt="" srcset=""></td>
                        <td>{{$item->name}}</td>
                        {{-- <td>{{$item->status}}</td> --}}
                      <td><a href="{{route('logo.site.status',$item->id)}}" class="{{$item->status=='active' ? 'badge bg-label-primary me-1' : 'badge bg-label-danger me-1'}}">{{$item->status}}</a></td>

                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('logo.site.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <form action="{{route('logo.site.delete')}}" method="post">
                                @csrf
                                <input type="hidden" name="delete_id" value="{{$item->id}}">
                                  <button class="dropdown-item" type="submit" ><i class="bx bx-trash me-1"></i> Delete</button>
                              </form>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                    <tfoot class="table-border-bottom-0">
                      <tr>
                        <th>SL</th>
                        <th>Logo</th>
                        <th>Site Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
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