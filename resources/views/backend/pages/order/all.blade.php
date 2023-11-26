@extends('backend.master')
@section('title','Order List')
@section('content')

    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
        @elseif(session('error'))
        <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
        @endif
        <div class="card">
            <div class="d-flex justify-content-between">

                <h5 class="card-header">All Orders</h5>
                <div class="mt-3 mx-3">
                    <a class="btn btn-primary" href="{{route('cat.add')}}">Add Category</a>
                </div>
            </div>

        
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    {{-- <th>Address</th> --}}
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Shipment</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @forelse ($order as $key => $item)

                    @php
                        $product_item =  App\Models\Order_item::where('order_id',$item->id)->count();
                    @endphp
                   
                   @if ($item->status == 'processing')
                   <tr class=" bg-label-primary">
                   @elseif($item->status == 'confirmed')
                   <tr class=" bg-label-info">
                   @elseif($item->status == 'picked')
                   <tr>
                   @elseif($item->status == 'shipped')         
                   <tr class=" bg-label-dark">
                   @elseif($item->status == 'delivered')
                   <tr class=" bg-label-secondary">
                   @elseif($item->status == 'cancelled')
                   <tr class=" bg-label-danger">

                   @endif
                    <td>#{{$item->order_number}}</td>
                    <td> {{$item->user->name}}</td>
                    <td>{{$item->phone }} <br> {{$item->email}} </td>
                    {{-- <td> <b>
                      {{$item->adress }},
                      {{$item->upazila->upazila_name }}, 
                      {{$item->district->district_name }} 
                    </b> --}}
                    </td>
                    <td> {{$product_item }} </td>
                    <td> ${{$item->total_amount }} </td>
                    <td class="text-center"> 
                      @if ($item->payment_method == "COD")
                      <span class='badge bg-warning'>Unpaid</span>
                      <br>
                      <i><small>by</small></i> {{$item->payment_method}}  
                      @else
                      <span class='badge bg-success'>Paid</span>
                      <br>
                      <i><small>by</small></i> {{$item->payment_method}} <br>
                      <small>
                        <small>{{$item->payment_type}} </small>
                      </small>
                      @endif  
                      
                    </td>
                    <td>
                        @if ($item->status == 'processing')
                        <span class='badge bg-warning'>Processing</span>
                        @elseif($item->status == 'confirmed')
                        <span class='badge bg-info'>Confirmed</span>
                        @elseif($item->status == 'picked')
                        <span class='badge bg-primary'>Picked</span>
                        @elseif($item->status == 'shipped')         
                        <span class='badge bg-dark'>Shipped</span> 
                        @elseif($item->status == 'delivered')
                        <span class='badge bg-success'>Delivered</span> 
                        @elseif($item->status == 'cancelled')
                        <span class='badge bg-danger'>Cancelled</span> 
                        @endif
                    
                    
                    </td>

                    <td>
                      {{-- <a href=""><i class='bx bxs-low-vision'></i></a>
                      <a href=""><i class='bx bx-shield-x'></i></a> --}}
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                          <a class="dropdown-item" href="{{route('order.view',encrypt($item->id))}}"><i class='bx bxs-analyse'></i> View</a>
                          <form id="deleteForm" action="{{route('cat.delete')}}" method="post">
                            @csrf
                            <input type="hidden" name="delete_id" value="{{$item->id}}">
                          <button type="submit" class="dropdown-item" id="delete"><i class='bx bx-shield-x'></i> Cancell</button>
                        </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @empty
                        <strong>No data found</strong>
                  @endforelse
                </tbody>
                <footer class="table-light">
                  <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    {{-- <th>Address</th> --}}
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Shipment</th>
                    <th>Actions</th>
                  </tr>
                </footer>
              </table>

              {{$order->links('vendor.pagination.default')}}


            </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#delete').on('click',function(){
                    const userConfirmed = confirm("Are you sure you want delete it?");
  
                    if (!userConfirmed) {
                        event.preventDefault(); 
                    }
                })
            });
        </script>
        
@endsection