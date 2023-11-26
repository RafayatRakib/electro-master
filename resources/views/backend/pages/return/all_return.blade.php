@extends('backend.master')
@section('title','All Return')
@section('content')
    <div class="container">
        <div class="my-5">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif

            <div class="card">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">All Return</h5>
                    {{-- <div class="mt-3 mx-3">
                        <a class="btn btn-primary" href="{{route('cat.add')}}">Add Category</a>
                    </div> --}}
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Order Number</th>
                        <th>Product</th>
                        <th>Return Reson</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($return as $item)
                            <tr>
                                <td>#{{$item->order->order_number}}</td>
                                <td>{{$item->product->product_name}}</td>
                                <td class="badge bg-label-danger mt-2">{{$item->reson->return_reson}}</td>
                                <td class="text-danger" >{{strtoupper($item->status)}}</td>
                                
                                <td>
                                    <a class="dropdown-item" href="{{route('return.details',$item->id)}}"><i class='bx bxs-low-vision'></i> View</a>
                                </td>
                            
                            </tr>
                        @endforeach
                       
                    </tbody>
                    <footer class="table-light">
                      <tr>
                        <th>Order Number</th>
                        <th>Product</th>
                        <th>Return Reson</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </footer>
                  </table>
    
                  {{$return->links('vendor.pagination.default')}}
    
    
                </div>
              </div>
            </div>










        </div>
    </div>
@endsection