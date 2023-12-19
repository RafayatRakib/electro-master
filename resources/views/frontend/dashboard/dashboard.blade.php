@extends('frontend.master')
@section('title','Dashboard')
@section('content')
   <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="dashboard-nav-item">
                                    <a class="dashboard-nav-link active-nav" style="btn" href="{{route('dashboard')}}" ><i class="fa fa-tachometer p-2"></i> Dashboard</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('my_orders')}}" ><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                </li>
                                {{-- <li class="dashboard-nav-item">
                                    <a class="nav-link" href=""><i class="fa fa-truck"></i> Track Your Order</a>
                                </li> --}}
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('my_return')}}"><i class="fa fa-undo"></i> My Return</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('user.address')}}"><i class="fa fa-map-marker"></i> My Address</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('user.account')}}"><i class="fa fa-user"></i> Account details</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div class="card">

                          


                            <div class="card-header">
                                <h3 class="mb-0">Hello {{Auth::user()->name}}!</h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    From your account dashboard. you can easily check &amp; view your <a href="{{route('my_orders')}}">recent orders</a>,<br />
                                    manage your <a href="{{route('user.address')}}">shipping and billing addresses</a> and <a href="{{route('user.account')}}">edit your password and account details.</a>
                                </p>

                                  @if (session()->get('success'))
                            <div style="margin-top: 40px">
                                <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
                                    <p style="margin: auto">{{session()->get('success')}}</p>
                                </div>
                            </div>
                            @endif

                                <h3 style="margin-top:60px">Your last few orders:</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($order as $item)
                                            @php
                                                $orderitem = App\Models\Order_item::where('order_id',$item->id)->get();
                                                $totalQty = 0;
                                                foreach ($orderitem as $value) {
                                                    $totalQty+=$value->qty;
                                                }
                                            @endphp
                                            <tr>
                                                <td>#{{$item->order_number}}</td>
                                                <td>{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</td>
                                                <td style="color: brown">{{strtoupper($item->status)}}</td>
                                                <td>{!!$currency->currency_symbol!!} {{number_format($item->total_amount,2,'.',',')}}  for {{$totalQty}} item</td>
                                                <td><a href="{{route('order_details',encrypt($item->id))}}" class="btn-small d-block">View</a></td>

                                            </tr>    
                                            @empty
                                                <h3>No order found</h3>
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection