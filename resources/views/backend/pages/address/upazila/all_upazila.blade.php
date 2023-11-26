@extends('backend.master')
@section('title','All Upazila')
@section('content')
    <div class="container">
        <div class="my-5 ">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif

            <div class="card px-2">
                <div class="d-flex justify-content-between">
    
                    <h5 class="card-header">All Upazila</h5>
                    <div class="mt-3 mx-3">
                        <a class="btn btn-primary" href="{{route('upazila.add')}}">Add Upazila</a>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>SL</th>
                        <th>Upazila</th>
                        <th>District</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
    
                        @forelse ($upazila as $key => $item)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td> {{$item->upazila_name}} </td>
                        <td> {{$item->district->district_name}} </td>
                        <td>
                            @if($item->status == '1' )
                            <a href="{{route('upazila.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                            @else
                            <a href="{{route('upazila.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                            @endif
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href="{{route('upazila.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <form id="deleteForm" action="{{route('upazila.delete')}}" method="post">
                                @csrf
                                <input type="hidden" name="delete_id" value="{{$item->id}}">
                              <button type="submit" onclick="return confirm('Are you sure to delete this data?')" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
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
                            <th>Division</th>
                            <th>Delivery Charge</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </footer>
                  </table>
    
                  {{$upazila->links('vendor.pagination.bootstrap-5')}}
    
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection