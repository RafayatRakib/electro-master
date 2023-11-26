@extends('frontend.master')
@section('title','Order Details')
@section('content')
<div class="container">
    <style>
        th{
            padding: 5px;
            text-align: center;
        }
        td{
            padding: 5px;
        }
    </style>
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
            <th>product Item : </th>
            <th>{{$totalItem}}</th>
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
                <a href="{{ route('order.return', ['oid' => encrypt($item->order_id), 'pid' => encrypt($item->product_id)]) }}"><b>Return</b></a>

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





</div>

@endsection