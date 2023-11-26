@extends('backend.master')
@section("title", "All Employer") 
@section('content')
    <div class="container">
        <div class="my-5">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif

            <div class="d-flex justify-content-between">
                <h1>All Employer Table</h1>
                <div class="p-3">
                  <a href="{{route('add.employer')}}" class="btn btn-primary">Add Employer</a>
                </div>
            </div>
            <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-light">
                    <tr>
                      <th>SL</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
  
                      @forelse ($employers as $key => $item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>  <img src="{{asset($item->photo)}}" style="width: 60px"> </td>
                      <td>  {{$item->name}} </td>
                      <td>  {{$item->RoleName->role}} </td>


                      <td>
                          @if($item->status == 'active' )
                          <a href="{{route('employ.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                          @else
                          <a href="{{route('employ.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                          @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="{{route('employ.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="dropdown-item" href="{{route('employ.details',$item->id)}}"><i class='bx bxs-analyse'></i> Details</a>
                            <form id="deleteForm" action="{{route('employ.delete')}}" method="post">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="delete_id" value="{{$item->id}}">
                            <button type="submit" onclick="return confirm('Are you sure to delete it?')" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
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
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                      </tr>
                  </footer>
                </table>
  
                {{$employers->links('vendor.pagination.custom')}}
            </div>
  
  
              </div>
       


        </div>
    </div>
@endsection