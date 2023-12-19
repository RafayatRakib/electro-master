@extends('frontend.master')
@section('title','Account Details')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-3">
         <div class="dashboard-menu">
            <ul class="nav flex-column" role="tablist">
               <li class="dashboard-nav-item">
                  <a class="dashboard-nav-link" style="btn" href="{{route('dashboard')}}" ><i class="fa fa-tachometer p-2"></i> Dashboard</a>
               </li>
               <li class="dashboard-nav-item">
                  <a class="nav-link" href="{{route('my_orders')}}" ><i class="fa fa-cart-arrow-down"></i> Orders</a>
               </li>
               {{-- 
               <li class="dashboard-nav-item">
                  <a class="nav-link" href=""><i class="fa fa-truck"></i> Track Your Order</a>
               </li>
               --}}
               <li class="dashboard-nav-item">
                  <a class="nav-link" href="{{route('my_return')}}"><i class="fa fa-undo"></i> My Return</a>
               </li>
               <li class="dashboard-nav-item">
                  <a class="nav-link" href="{{route('user.address')}}"><i class="fa fa-map-marker"></i> My Address</a>
               </li>
               <li class="dashboard-nav-item">
                  <a class="nav-link active-nav" href="{{route('user.account')}}"><i class="fa fa-user"></i> Account details</a>
               </li>
               <li class="dashboard-nav-item">
                  <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-md-9">
         @if (session()->get('success'))
         <div style="margin-top: 40px">
            <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
               <p style="margin: auto">{{session()->get('success')}}</p>
            </div>
         </div>
         @endif
         <!--start page wrapper -->
         <div class="main-body">
            <div class="row">
               <div class="col-lg-4 col-md-4">
                  <div class="card">
                     <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                           <img src="{{asset($user->photo??'no-image-icon.png')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                           <div class="mt-3">
                              <h4 class="my-3">Hi!, {{Auth::user()->name}}</h4>
                           </div>
                        </div>
                        <hr class="my-4" />

                        <div class="row my-3">
                           <div class="col-sm-6">
                              <h6 class="mb-0">Total Order :</h6>
                           </div>
                           <div class="col-sm-6 text-secondary">
                              <strong>{!! $currency->currency_symbol !!} {{$totalOrder}}</strong>
                           </div>
                        </div>

                        <div class="row my-3">
                           <div class="col-sm-6">
                              <h6 class="mb-0">Total Amount :</h6>
                           </div>
                           <div class="col-sm-6 text-secondary">
                              <strong>{!! $currency->currency_symbol !!} {{number_format($totalAmount,2,'.',',')}}</strong>
                           </div>
                        </div>

                        <div class="row my-3">
                           <div class="col-sm-6">
                              <h6 class="mb-0">Total Return :</h6>
                           </div>
                           <div class="col-sm-6 text-secondary">
                              <strong>{!! $currency->currency_symbol !!} {{number_format($totalReturn,2,'.',',')}}</strong>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="col-lg-8 col-md-4">
                  <div class="card">
                     <div class="card-body">
                        <form action="{{route('user.account.update')}}" method="post" enctype="multipart/form-data">
                           @csrf
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Full Name</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" />
                                 @error('mame')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Email</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" />
                                 @error('email')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Phone</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}" />
                                 @error('phone')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Current Password</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"  placeholder="Enter your current password" />
                                 @error('current_password')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">New Password</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"  placeholder="New password" />
                                 @error('new_password')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Confirm Password</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="Confirm password"/>
                                 @error('password_confirmation')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Date Of Birth</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input class="form-control" value="{{$user->date_of_birth}}" type="date">
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Gender</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 {{-- <input class="form-control" value="{{$user->gender}}" type="date"> --}}
                                 <select class="form-control" name="gender" id="gender">
                                    <option selected disabled>Select Gender</option>
                                    <option value="male" >Male</option>
                                    <option value="female" >Female</option>
                                    <option value="others" >Others</option>
                                 </select>
                              </div>
                           </div>
                           <div class="row my-3">
                              <div class="col-sm-3">
                                 <h6 class="mb-0">Profile</h6>
                              </div>
                              <div class="col-sm-9 text-secondary">
                                 <input name="photo" class="form-control @error('photo') is-invalid @enderror" type="file">
                                 @error('photo')
                                 <strong class="text-danger">{{$message}}</strong>
                                 @enderror
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-3"></div>
                              <div class="col-sm-9 text-secondary">
                                 <button type="submit" class="btn">Changes</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--end page wrapper -->
      </div>
   </div>
</div>
@endsection