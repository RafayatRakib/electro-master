@extends('backend.master')
@section('title','Employer Role')
@section('content')
<div class="container">
    <div class="my-5">
        <div class="card mb-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Add Role</h5>
                <div class="mt-3 mx-3">
                    <a class="btn btn-dark" href="{{route('active.employer')}}">Active Employer</a>
                </div>
            </div>
            <div class="px-5">
                @if(session('success'))
                <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
                @elseif(session('error'))
                <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
                @endif
            </div>
           
            <div class="card-body">
            <form action="{{route('role.employer.store')}}" method="post" >
                @csrf
                <div class="my-3">
                    <label for="defaultFormControlInput" class="form-label">Role Name</label>
                    <input type="text" name="role" id="role" class="form-control @error('role')is-invalid @enderror" id="defaultFormControlInput" value="{{old('name')}}" placeholder="Ex: Adminstraitor, CEO, Managaer etc" aria-describedby="defaultFormControlHelp">
                    @error('role') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                </div>
                
                <div class="my-3">
                    <label for="defaultFormControlInput" class="form-label">Role wise Salary</label>
                    <input type="text" name="salary" id="salary" class="form-control @error('salary')is-invalid @enderror" id="defaultFormControlInput" value="{{old('name')}}" placeholder="Ex: 10000" aria-describedby="defaultFormControlHelp">
                    @error('salary') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                </div>

                <button type="submit" class="btn btn-primary">Add Role</button>
            </form>
            </div>
          </div>

          <div class="card my-3">
            
            <div class="p-3">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Role</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                @foreach ($role as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->role}}</td>
                        <td>{{$item->salary}}</td>
                        <td>
                            @if($item->status == 'active' )
                            <a href="{{route('role.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                            @else
                            <a href="{{route('role.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                            @endif
                        </td>

                        <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href="{{route('role.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <form id="deleteForm" action="{{route('role.delete')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="delete_id" value="{{$item->id}}">
                              <button type="submit" onclick="return confirm('Are you sure to delete it?')" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
                            </form>
                            </div>
                          </div>
                        </td>
                    </tr>
                @endforeach

                <footer class="table-light">
                    <tr>
                        <th>SL</th>
                        <th>Role</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </footer>


            </table>
        </div>
          </div>
    </div>
</div>
    
@endsection