@extends('backend.master')
@section('title','Employer Details')
@section('content')
<div class="container">
   <div class="my-5">
    <div class="d-flex justify-content-between">
        <h1>Employer Details</h1>
        <div class="p-3">
            <a class="btn btn-dark" href="{{route('all.employer')}}">All Employer</a>
        </div>
    </div>
      <div class="card">
         <div class="row">
            <div class="col-md-6">
               <div class="table-responsive text-nowrap">
                  <table class="table">
                     <tr>
                        <th>Name :</th>
                        <td>{{$employer->name}}</td>
                     </tr>
                     <tr>
                        <th>ID/Passport :</th>
                        <td>{{$employer->nid}}</td>
                     </tr>
                     <tr>
                        <th>Email :</th>
                        <td>{{$employer->email}}</td>
                     </tr>
                     <tr>
                        <th>Phone :</th>
                        <td>{{$employer->phone}}</td>
                     </tr>
                     <tr>
                        <th>Address :</th>
                        <td>{{$employer->address}}</td>
                     </tr>
                     <tr>
                        <th>Date Of Birth :</th>
                        <td>{{ \Carbon\Carbon::parse($employer->date_of_birth)->format('d M Y') }}</td>
                     </tr>
                     <tr>
                        <th>Role :</th>
                        <td>{{$employer->RoleName->role}}</td>
                     </tr>
                     <tr>
                        <th>Salary :</th>
                        <td>{{$employer->RoleName->salary}}</td>
                     </tr>
                     <tr>
                        <th>Status :</th>
                        <td>{{$employer->status}}</td>
                     </tr>
                     <tr>
                        <th></th>
                        <th>
                            <a class="btn btn-primary" href="{{route('employ.edit',$employer->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        </th>
                     </tr>

                  </table>

               </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-center">
                    <div class="p-5">
                        <img src="{{asset($employer->photo)}}" alt="" srcset="">
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection