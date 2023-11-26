@extends('backend.master')
@section('title','Category List')
@section('content')

    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
        @elseif(session('error'))
        <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
        @endif
        <div class="card">
            <div class="d-flex justify-content-between">

                <h5 class="card-header">Light Table head</h5>
                <div class="mt-3 mx-3">
                    <a class="btn btn-primary" href="{{route('cat.add')}}">Add Category</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th>SL</th>
                    <th>Photo</th>
                    <th>Category Name</th>
                    <th>Total Product</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @forelse ($cat as $key => $item)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td> <img src="{{asset($item->cat_photo)}}" style="width: 70px" alt="Category" > </td>
                    <td> {{$item->cat_name}} </td>
                    <td>1000(after Product add then work here)</td>
                    <td>
                        @if($item->status == '1' )
                        <a href="{{route('cat.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                        @else
                        <a href="{{route('cat.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                        @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                          <a class="dropdown-item" href="{{route('cat.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <form id="deleteForm" action="{{route('cat.delete')}}" method="post">
                            @csrf
                            <input type="hidden" name="delete_id" value="{{$item->id}}">
                          <button type="submit" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
                        </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @empty
                        <strong>No data found</strong>
                  @endforelse
                </tbody>
                <footer class="table-light">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Total Product</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </footer>
              </table>

              {{$cat->links('vendor.pagination.custom')}}


            </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#delete').on('click',function(){
                    const userConfirmed = confirm("Are you sure you want delete it?");
  
                    if (!userConfirmed) {
                        event.preventDefault(); 
                    }
                })
            });
        </script>
        
@endsection