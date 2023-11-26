@extends('frontend.master')
@section('title','Account Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" style="btn" href="" ><i class="fa fa-tachometer p-2"></i> Dashboard</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link " href="" ><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link " href=""><i class="fa fa-truck"></i> Track Your Order</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link " href=""><i class="fa fa-map-marker"></i> My Address</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link active-nav" href=""><i class="fa fa-user"></i> Account details</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card mb-3 mb-lg-0">
                            <div class="card-header">
                                <h3 class="mb-0">Billing Address</h3>
                            </div>
                            <div class="card-body">
                                <address>
                                    3522 Interstate<br />
                                    75 Business Spur,<br />
                                    Sault Ste. <br />Marie, MI 49783
                                </address>
                                <p>New York</p>
                                <a href="#" class="btn-small">Edit</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection