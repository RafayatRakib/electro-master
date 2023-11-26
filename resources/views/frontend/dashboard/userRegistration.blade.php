@extends('frontend.master')
@php
$site = App\Models\LogonAndName::where('status','active')->first();
@endphp
@section('title',$site->name.' - Login')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-6 col-xl-6">  
        <div class="billing-details">
            <div class="section-title">
                <h2 class="title">Create an Account</h2>
                <p>Already have an account? <a href="{{route('userLogin')}}">Login</a></p>
            </div>
            <form action="{{route('userRegistrationStore')}}" method="post">
            @csrf
            <div class="form-group">
                <input class="input"  @error('name')style="border-color: #D10024"@enderror type="text" name="name" placeholder="Name" value="{{old('name')}}">
                @error('name')<strong style="color: #D10024">{{$message}}</strong>@enderror
            </div>
            <div class="form-group">
                <input class="input"  @error('email')style="border-color: #D10024"@enderror  type="email" name="email" placeholder="Email" value="{{old('email')}}">
                @error('email')<strong style="color: #D10024">{{$message}}</strong>@enderror
            </div>
            <div class="form-group">                        
                <input class="input"  @error('password')style="border-color: #D10024"@enderror type="password" name="password" placeholder="Enter Your Password" value="{{old('password')}}">
                @error('password')<strong style="color: #D10024">{{$message}}</strong>@enderror

            </div>
            <div class="form-group">                        
                <input class="input"  @error('password_confirmation')style="border-color: #D10024"@enderror type="password" name="password_confirmation" placeholder="Enter Your Password" value="{{old('password_confirmation')}}">
                @error('password_confirmation')<strong style="color: #D10024">{{$message}}</strong>@enderror

            </div>
            <div class="form-group">
                <div class="input-checkbox">
                    <input type="checkbox" @error('terms_and_Policy')style="border-color: #D10024"@enderror name="terms_and_Policy" id="create-account">
                    <label for="create-account">
                        <span></span>
                        I agree to terms & Policy.
                    </label>
                @error('terms_and_Policy')<strong style="color: #D10024">{{$message}}</strong>@enderror

                 </div>
            </div>
        </div>
        <div class="d-flex justify-content-right">
            <button class="btn">Register</button>
        </div>
    </form>
       </div>
            <div class="col-md-6 col-xl-6">
            <div class="shop-img">
                <img style="width: 350px; height: 450px; border-radius:5px; margin-left:30%; box-shadow: 5px 5px 5px rgb(182, 179, 179)" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Marke_%28Courtrai%29_Molenhof_te_Rodenborg.jpg/901px-Marke_%28Courtrai%29_Molenhof_te_Rodenborg.jpg" alt="">
            </div>    
            </div>  

    </div>
</div>

@endsection