@extends('frontend.master')
@section('title','Order Details')
@section('content')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<style>


</style>


<div class="container">
  


   <h4>Order Details</h4>
    <div class="row">
        {{-- <div class="col-md-4"></div> --}}
        <div class="col-md-4">

<div class="card">
    <div class="card-body">
        <table border="1" id="example" class="display nowrap stripe row-border order-column compact" style="width:100%">
        <tr>
            <th>Order Number : </th>
            <th>{{$order->order_number}}</th>
        </tr>
        <tr>
            <th>Invoice No : </th>
            <th>{{$order->invoice_no}}</th>
        </tr>
        <tr>
            <th>Total Amount : </th>
            <th>{!!$currency->currency_symbol!!} {{number_format($order->total_amount,2,'.',',')}}</th>
        </tr>
        <tr>
            <th>Total Discount : </th>
            <th>{!!$currency->currency_symbol!!} {{number_format($order->total_discount,2,'.',',')}}</th>
        </tr>
        <tr>
            <th>Payment Type : </th>
            <th>{{$order->payment_method}}({{$order->payment_type}})</th>
        </tr>
        <tr>
            <th>Status : </th>
            <th style="color:rgb(207, 35, 35)">{{$order->status}}</th>
        </tr>
        </table>
    </div>
</div>
    
</div>
<div class="col-md-8">
    <table>
        <tr>
            <th>SL</th>
            <th>Product</th>
            <th>Size</th>
            <th>Color</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        @foreach ($orderItem as $key => $item)

        <tr>
            <td>{{$key+1}}</td>
            <td>{{ substr($item->product->product_name, 0, 50).'...' }}({{$item->qty}}x)</td>
            <td>{{$item->size?? '-'}}</td>
            <td>{{$item->color?? '-'}}</td>
            <td>{!!$currency->currency_symbol!!} {{number_format($item->qty*$item->price,2,'.',',')}}</td>
            <td>
                @if ($order->delivered_date)
                {{-- <a href="{{route('order.return',encrypt($item->product_id))}}" > <b> Return</b></a> --}}
                @php
                    $return = \App\Models\ProductReturn::where('user_id', Auth::id())
                                            ->where('order_id', $item->order_id)
                                            ->where('product_id', $item->product_id)
                                            ->first();
                    
                @endphp
                @if ($return)
              
                <a href="{{route('return_details',encrypt($return->id))}}"><b>Return Rquested</b></a>
                @else
                    
                <a href="{{ route('order.return', ['oid' => encrypt($item->order_id), 'pid' => encrypt($item->product_id)]) }}"><b>Return</b></a>
                @endif

                @else
                <b disabled title="Disabled"> Return</b>
                {{-- <a disabled title="Disabled"> 
                </a>
                 --}}
                @endif
                
                @if ($order->delivered_date)
                {{-- <a href="">R</a> --}}
                {{-- <a href="{{ url('/product/rate/' . encrypt($item->product_id)) }}"><b>Rate</b></a> --}}
                <a href="{{ route('rate',encrypt($item->product_id)) }}"><b>Rate</b></a>
                @else
                <b disabled title="Disabled"> Rate</b>
                {{-- <a disabled title="Disabled">
                </a> --}}
                @endif
                
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>


<div id="tracker_view">



        <h4 style="margin-top: 40px">Return Tracker: </h4>
       <ul>

        @if ($order->delivered_date)
        <li>
            <i class="icon uil uil-home"></i>
            <div class="progress five active">
                <p>3</p>
                <i class="uil uil-check"></i>
             </div>
             <p class="text">Order Delivered</p>
           <p class="">{{Carbon\Carbon::parse($order->delivered_date)->format('h:m a, d-M-y')}}</p>

         </li> 
         @endif

        @if ($order->shipped_date)
           <li>
               <i class="icon uil uil-ship"></i>
               <div class="progress four active">
                   <p>3</p>
                   <i class="uil uil-check"></i>
                </div>
                <p class="text">Product Shipped</p>
              <p class="">{{Carbon\Carbon::parse($order->shipped_date)->format('h:m a, d-M-y')}}</p>

            </li> 
            @endif
            @if ($order->picked_date )
           
           <li>
              <i class="icon uil uil-package"></i>
              <div class="progress three active">
                 <p>3</p>
                 <i class="uil uil-check"></i>
              </div>
              <p class="text">Order Picked</p>
              <p class="">{{Carbon\Carbon::parse($order->picked_date	)->format('h:m a, d-M-y')}}</p>

           </li> 
           @endif

           @if ($order->confirmed_date)
           <li>
            <i class="icon uil uil-check"></i>
            <div class="progress one active ">
               <p>5</p>
               <i class="uil uil-check"></i>
            </div>
            <p class="text">Order Confirmed</p>
            <p class="">{{Carbon\Carbon::parse($order->confirmed_date)->format('h:m a, d-M-y')}}</p>

         </li>
         {{-- @endif
         @if ($order->processing_date ) --}}
           <li>
              <i class="icon uil uil-process"></i>
              <div class="progress two active ">
                 <p>4</p>
                 <i class="uil uil-check"></i>
              </div>
              <p class="text">Order Processing</p>
              <p class="">{{Carbon\Carbon::parse($order->processing_date)->format('h:m a, d-M-y')}}</p>

           </li>
           @endif
           @if ($order->order_date)
           <li>
              <i class="icon uil uil-exchange"></i>
              <div class="progress one active ">
                 <p>5</p>
                 <i class="uil uil-check"></i>
              </div>
              <p class="text">Order Date</p>
              <p class="">{{Carbon\Carbon::parse($order->order_date)->format('h:m a, d-M-y')}}</p>
           </li>
           @endif
        </ul>

 </div>

</div>

@endsection