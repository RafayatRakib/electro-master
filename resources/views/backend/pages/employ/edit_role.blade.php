@extends('backend.master')
@section('title','Edit Role')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="d-flex justify-content-between">
                <h1>Edit Role</h1>
                <a href="{{route('role.employer')}}">All role</a>
            </div>

            <div class="card-body">
                <form action="{{route('role.employer.update')}}" method="post" >
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="update_id" value="{{$role->id}}">
                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Role Name</label>
                        <input type="text" name="role" id="role" class="form-control @error('role')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: Adminstraitor, CEO, Managaer etc" aria-describedby="defaultFormControlHelp" value="{{$role->role}}">
                        @error('role') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    
                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Role wise Salary</label>
                        <input type="text" name="salary" id="salary" class="form-control @error('salary')is-invalid @enderror" id="defaultFormControlInput" value="{{$role->salary}}" placeholder="Ex: 10000" aria-describedby="defaultFormControlHelp">
                        @error('salary') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
                </div>

        </div>
    </div>
@endsection