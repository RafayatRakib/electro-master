@extends('backend.master')
@section('content')
@section('title','All settings')
<style>
    .container .bx{
        font-size: 2rem;
    }
</style>
    <div class="container">
        <div class="my-5">
           
            <h1>All Settings:</h1>
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="card py-3">
                        <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                           <h4><i class='bx bx-paint-roll' ></i>Name & Logo</h4>
                        </div>
                        <a href="{{route('admin.site.logo')}}" class="btn btn-danger">Go</a>
                        </div>
                    </div>
                </div> 


                <div class="col-md-3">
                    <div class="card py-3">
                       <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                           <h4><i class='bx bx-trash'></i>Cache Clear</h4>
                        </div>
                        <form action="{{route('admin.clearCache')}}" method="post">
                            @csrf
                            <button class="btn btn-primary">Clear</button>
                        </form>
                        </div>
                    </div>
                </div> 


                <div class="col-md-3">
                    <div class="card py-1">
                        <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                           <h4><i class='bx bx-message-rounded-dots'></i>Social & Contact</h4>
                        </div>
                        <a href="{{route('social.contact')}}" class="btn btn-dark">Go</a>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="card py-1">
                        <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                           <h4><i class='bx bx-dollar'></i>Currency Settings</h4>
                        </div>
                        <a href="{{route('currency')}}" class="btn btn-danger">Go</a>
                        </div>
                    </div>
                </div> 

                 

                <div class="col-md-3">
                    <div class="card py-3">
                        <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                           <h4>Under Maintenance</h4>
                        </div>
                        <a href="" class="btn btn-danger">Change</a>
                        </div>
                    </div>
                </div> 
        </div>

    </div>
@endsection