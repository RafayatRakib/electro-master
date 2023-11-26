@extends('backend.master')
@section('title','Edit Employer')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="row">
                <div class="col-md-6">
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">Edit Employer</h5>
                    <div class="mt-3 mx-3">
                        <a class="btn btn-dark" href="{{route('active.employer')}}">Active Employer</a>
                    </div>
                </div>
                <div class="card-body">
                <form action="{{route('update.employer')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_id" value="{{$employer->id}}">
                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name')is-invalid @enderror" id="defaultFormControlInput" value="{{$employer->name}}" placeholder="Ex: Jone Doe" aria-describedby="defaultFormControlHelp">
                        @error('name') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    
                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">NID/Id/Passport</label>
                        <input type="text" name="nid" id="nid" class="form-control @error('nid')is-invalid @enderror" id="defaultFormControlInput" value="{{$employer->nid}}" placeholder="Ex: CRISMAS007" aria-describedby="defaultFormControlHelp">
                        @error('nid') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>

                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Phone</label>
                        <input type="text" name="Phone" id="Phone" class="form-control @error('Phone')is-invalid @enderror" id="defaultFormControlInput" value="{{$employer->phone}}" placeholder="Ex: +8801612-151515" aria-describedby="defaultFormControlHelp">
                        @error('Phone') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email')is-invalid @enderror" id="defaultFormControlInput" value="{{$employer->email}}" placeholder="Ex: +8801612-151515" aria-describedby="defaultFormControlHelp">
                        @error('email') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>


                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Address</label>
                        <textarea name="address" class="form-control" cols="30" rows="5" value="{{$employer->address}}" placeholder="Enter address here">{{$employer->address}}</textarea>
                        @error('address') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>


                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Date Of Birht</label>
                        <input name="date_of_birth" type="datetime-local" class="form-control" value="{{$employer->date_of_birth}}">
                        @error('date_of_birth') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>


                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Role</label>
                        <select name="role" id="" class="form-control @error('role')is-invalid @enderror">
                            <option >Select Role</option>
                            <option  selected value="{{$employer->role_id}}">--{{$employer->RoleName->role}}</option>
                            @foreach ($role as $item)
                            <option value="{{$item->id}}">{{$item->role}}</option>
                            @endforeach
                        </select>
                        @error('role') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <div class="my-3">
                        <label for="defaultFormControlInput" class="form-label">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control @error('photo')is-invalid @enderror" id="defaultFormControlInput" value="{{old('photo')}}" placeholder="Ex: CRISMAS007" aria-describedby="defaultFormControlHelp">
                        @error('photo') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Employ</button>

                </form>
                </div>
              </div>
        </div>
    </div>
        </div>
    </div>
@endsection