@extends('frontend.master')
@section('title','My Order')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="dashboard-nav-item">
                                    <a class="dashboard-nav-link" style="btn" href="{{route('dashboard')}}" ><i class="fa fa-tachometer p-2"></i> Dashboard</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link active-nav" href="{{route('my_orders')}}" ><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href=""><i class="fa fa-truck"></i> Track Your Order</a>
                                </li>
                                <li class="dashboard-nav-item">
                                    <a class="nav-link" href="{{route('user.address')}}"><i class="fa fa-map-marker"></i> My Address</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Your Orders</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $counter = $order->currentPage() * $order->perPage() - $order->perPage() + 1;
                                            @endphp

                                            @forelse ($order as $key => $item)
                                                @php
                                                    $orderitem = App\Models\Order_item::where('order_id', $item->id)->get();
                                                    $totalQty = 0;
                                                    foreach ($orderitem as $value) {
                                                        $totalQty += $value->qty;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <td>#{{ $item->order_number }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                                                    <td style="color: brown">{{ strtoupper($item->status) }}</td>
                                                    <td>{!! $currency->currency_symbol !!} {{ number_format($item->total_amount, 2, '.', ',') }} for {{ $totalQty }} item</td>
                                                    <td><a href="{{route('order_details',encrypt($item->id))}}" class="btn-small d-block">View</a></td>
                                                </tr>    
                                            @empty
                                                <tr>
                                                    <td colspan="6"><h3>No order found</h3></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $order->links('vendor.pagination.custom') }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection