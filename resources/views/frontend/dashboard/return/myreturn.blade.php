@extends('frontend.master')
@section('title','My Returns')
@section('content')

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
                                    <a class="dashboard-nav-link " style="btn" href="{{route('dashboard')}}" ><i class="fa fa-tachometer p-2"></i> Dashboard</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('my_orders')}}" ><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                </li>
                                {{-- <li class="dashboard-nav-item">
                                    <a class="nav-link" href=""><i class="fa fa-truck"></i> Track Your Order</a>
                                </li> --}}
                                <li class="dashboard-nav-item">
                                    <a class="nav-link active-nav" href="{{route('my_return')}}"><i class="fa fa-undo"></i> My Return</a>
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
                        <h3 style="margin-top:60px">Your last return:</h3>
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
                                    @forelse ($return as $item)
                                    @php
                                        $orderitem = App\Models\Order_item::where('order_id',$item->order_id)->where('product_id',$item->product_id)->first();
                                        // dd($orderitem);
                                    @endphp
                                    <tr>
                                        <td>#{{$item->order->order_number}}</td>
                                        <td>{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</td>
                                        <td style="color: brown">{{strtoupper($item->status)}}</td>
                                        <td>{!!$currency->currency_symbol!!} {{number_format(($orderitem->price-$orderitem->discount)*$orderitem->qty,2,'.',',')}}  for {{$orderitem->qty}} item</td>
                                        
                                        <td><a href="{{route('return_details',encrypt($item->id))}}" class="btn-small d-block">View</a></td>

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
@endsection