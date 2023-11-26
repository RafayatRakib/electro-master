@extends('frontend.master')
@php
$site = App\Models\LogonAndName::where('status','active')->first();
@endphp
@section('title',$site->name.' - Login')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-6 col-xl-6">
            <div class="shop-img">
                <img style="width: 350px; height: 450px; border-radius:5px; margin-left:30%; box-shadow: 5px 5px 5px rgb(182, 179, 179)" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Marke_%28Courtrai%29_Molenhof_te_Rodenborg.jpg/901px-Marke_%28Courtrai%29_Molenhof_te_Rodenborg.jpg" alt="">
            </div>    
            </div>  


       <div class="col-md-6 col-xl-6">  
        <div class="billing-details">
            <div class="section-title">
                <h2 class="title">Login</h2>
                <p>Don't have an account? <a href="{{route('userRegistration')}}">Create an account</a></p>
            </div>
            <strong style="color: red; margin-bottom: 20px">
                <x-input-error  :messages="$errors->get('email')" class="mt-2" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </strong>
                    
            <form action="{{route('userLoginStore')}}" method="post">
            @csrf

            <div class="form-group">
                <input class="input" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">                        
                <input class="input" type="password" name="password" placeholder="Enter Your Password">
            </div>
            <div class="form-group">
                <div class="input-checkbox">
                    <input type="checkbox" id="create-account">
                    <label for="create-account">
                        <span></span>
                        Remember me.
                    </label>
                 </div>
            </div>
        </div>
        <div style="display: flex">
            <button class="btn">Login</button>
        </div>
    </form>
       </div>


    </div>
</div>
@endsection