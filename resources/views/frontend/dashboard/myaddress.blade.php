@extends('frontend.master')
@section('title','My Address')
@section('content')
@php
    $address = App\Models\Address::where('user_id',Auth::id())->get();
@endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @if (session()->get('success'))
                            <div style="margin-top: 40px; margin-bottom: 40px">
                                <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
                                    <p style="margin: auto">{{session()->get('success')}}</p>
                                </div>
                            </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" style="btn" href="{{route('dashboard')}}" ><i class="fa fa-tachometer p-2"></i> Dashboard</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link " href="" ><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link " href=""><i class="fa fa-truck"></i> Track Your Order</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link active-nav" href=""><i class="fa fa-map-marker"></i> My Address</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href=""><i class="fa fa-user"></i> Account details</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card mb-3 mb-lg-0 ">
                            <div class="d-flex justify-content-between">

                            <div class="card-header">
                                <h3 class="mb-0">Shipping & Billing Address</h3>
                            </div>
                            <div class="add-address">
                                {{-- <a href="{{route('add.user.address')}}">Add Address</a> --}}
                                <form action="{{route('add.user.address')}}" method="get">
                                    @csrf
                                    <button type="submit" class="checkout-btn">Add Address</button>
                                </form>
                            </div>
                        </div>

                            <div class="card-body" style="margin-top:30px">
                                <div class="row">
                                @forelse ($address as $item)
                                <div class="col-md-3">
                                <div class="custom-card p-3">
                                    <strong>
                                        {{$item->address}} ,
                                        {{$item->upazila->upazila_name}}
                                        <p>{{$item->district->district_name}}</p><br>
                                        <p>{{$item->district->district_name}}</p>
                                    </strong>
                                    <div class="d-flex justify-content-between" style="margin-bottom: 20px">

                                        <a href="{{route('address.edit',$item->id)}}" class="btn-small">Edit</a> 
                                        <form action="{{route('address.delete')}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="delete_id" value="{{$item->id}}">
                                            <button onclick="return confirm('Are you sure to delete it?')" type="submit" class="btn-small">Delete</button> 
                                        </form>
                                    </div>
                                        
                                     <strong style="border: 2px solid #333; border-radius: 3px; padding:3px"> {{strtoupper($item->address_type)}}</strong> <a href="{{route('address.status',$item->id)}}" onclick="return confirm('Are you sure to change it?')" style="color: #D10024"> {{$item->status}} </a>
                                </div>
                                <hr>
                            </div>
                                @empty
                                    <strong>No shipping found, <a href="">add</a> shipping </strong>
                                @endforelse
                        </div>
                                
                                
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection