@extends('backend.master')
@section('title','Return Reson')
@section('content')
    <div class="container">
        <div class="my-5">

            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif

            <div class="card mb-3">
                    <h5 class="card-header">Add Reson</h5>
                <div class="card-body">
                    <form action="{{route('add.return.reson')}}" method="post">
                        @csrf
                        <div class="my-2">
                            <label for="defaultFormControlInput" class="form-label">Return Reson</label>
                            <input type="text" name="return_reson" id="return_reson" class="form-control @error('return_reson')is-invalid @enderror" id="defaultFormControlInput" value="{{old('return_reson')}}" placeholder="Ex: Broken, Wrong Product etc" aria-describedby="defaultFormControlHelp">
                            @error('return_reson') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Reson</button>
                    </form>
                </div>

            </div>

            <div class="card">
                <div class="d-flex justify-content-between">
    
                    <h5 class="card-header">All Return Reson</h5>
                    {{-- <div class="mt-3 mx-3">
                        <a class="btn btn-primary" href="{{route('cat.add')}}">Add Category</a>
                    </div> --}}
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>SL</th>
                        <th>Return Reson</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reson as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->return_reson}}</td>
                                <td>
                                    @if($item->status == 'active' )
                                    <a href="{{route('return.reson.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                                    @else
                                    <a href="{{route('return.reson.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="{{route('return.reson.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form id="deleteForm" action="{{route('reson.delete')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="delete_id" value="{{$item->id}}">
                                        <button type="submit" onclick="return confirm('Are you sure to delete this data?')" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
                                      </form>
                                      </div>
                                    </div>
                                  </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                    <footer class="table-light">
                      <tr>
                        <th>SL</th>
                        <th>Return Reson</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </footer>
                  </table>
    
                  {{$reson->links('vendor.pagination.default')}}
    
    
                </div>
              </div>
            </div>





        </div>
    </div>
@endsection