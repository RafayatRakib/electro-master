@extends('backend.master')
@section('title','Return Note')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="card px-3">
                <h1>Confirm Return</h1>
                <hr>
                <div class="card-body">
                    <form action="{{route('admin.order.reject')}}" method="post">
                        @csrf
                <table>
                    <input type="hidden" name="reject_id" value="{{$return->id}}">
                    <tr>
                        <th>Product Name:</th>
                        <th> {{$return->product->product_name}} </th>
                    </tr>
                    <tr>
                        <th>User Name:</th>
                        <th> {{$return->user->name}} </th>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        {{-- <th> {{$order->adress.','.$order->upazila->upazila_name.','.$order->district->district_name}}</th> --}}
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <th> {{$order->phone}} </th>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <th> <a href="mailto:{{$order->email}}">{{$order->email}}</a> </th>
                    </tr>
                   <tr>
                    <th>Reject Note</th>
                    <th>
                        <textarea name="reject_note" class="form-control" id="" cols="30" rows="5"></textarea>
                        {{-- <input class="form-control" type="text" name="reject_note" > --}}
                    </th>
                    <tr>
                        <th></th>
                        <th> <button onclick="return confirm('Are you sure to reject this order?')" class="btn btn-danger mt-3" >Reject</button> </th>
                    </tr>
                   </tr>
                </table>
            </form>

            </div>
        </div>
        </div>
    </div>
@endsection