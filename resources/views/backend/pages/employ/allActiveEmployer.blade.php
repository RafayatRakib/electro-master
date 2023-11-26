@extends('backend.master')
@section("title", "Active Employer") 
@section('content')
    <div class="container">
        <div class="my-5">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif

            <div class="d-flex justify-content-between">
                <h1>Active Employer Table</h1>
                <div class="p-3">
                  <a href="{{route('add.employer')}}" class="btn btn-primary">Add Employer</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-light">
                    <tr>
                      <th>SL</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Status</th>
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
                      </tr>
                  </footer>
                </table>
  
                {{-- {{$employers->links('vendor.pagination.custom')}} --}}
  
  
              </div>
       


        </div>
    </div>
@endsection