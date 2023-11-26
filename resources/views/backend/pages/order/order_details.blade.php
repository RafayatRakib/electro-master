@extends('backend.master')
@section('title','Order Details')
@section('content')
<div class="container mt-5">
<div class="card">
   @if(session('success'))
   <div class="alert alert-primary" role="alert">{{session('success')}}</div>
   @elseif(session('error'))
   <div class="alert alert-danger" role="alert">{{session('error')}}</div>
   @endif
   <div class="card-body">
      <div id="invoice">
         <div class="toolbar hidden-print">
            <div class="text-end d-flex justify-content-between">

               <div style="width: 30%">
                  <form action="{{route('order_status')}}" method="post">
                     @csrf
                    
                     <input type="hidden" name="order_id" value="{{$order->id}}">
                  <div class="input-group">
                     <select class="form-select " name="order_status" >
                        @if ($order->status == 'processing')
                        <option disabled >Select Order Status</option>
                        <option disabled selected >Processing</option>
                        <option value="confirmed">Confiromed</option>
                        <option value="picked">Picked</option>
                        <option value="shiped">Shiped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                        @elseif($order->status == 'confirmed')
                        <option disabled> Select Order Status</option>
                        <option disabled> Processing</option>
                        <option selected disabled value="confirmed">Confiromed</option>
                        <option value="picked">Picked</option>
                        <option value="shiped">Shiped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                        @elseif($order->status == 'picked')
                        <option disabled selected>Select Order Status</option>
                        <option disabled  value="confirmed">Confiromed</option>
                        <option selected disabled value="picked">Picked</option>
                        <option value="shiped">Shiped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>

                        @elseif($order->status == 'shiped')
                        <option disabled selected>Select Order Status</option>
                        <option disabled  value="confirmed">Confiromed</option>
                        <option disabled value="picked">Picked</option>
                        <option disabled selected value="shiped">Shiped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                        @elseif($order->status == 'delivered')
                        <option disabled selected>Select Order Status</option>
                        <option disabled value="confirmed">Confiromed</option>
                        <option disabled value="picked">Picked</option>
                        <option  disabled value="shiped">Shiped</option>
                        <option disabled selected value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                        @endif
                     </select>
                     
                     <button onclick="return confirm('Are you sure to change this action?')" class="btn btn-primary" type="submit">Change</button>
                  </div>
                  @error('order_status')
                        <strong class="text-danger">{{$message}}</strong>   
                     @enderror
               </form>
               </div>
                   <a href="{{route('invoice',$order->id)}}" class="btn btn-dark"><i class="fa fa-print"></i> Print Invoice</a>
            </div>
            <hr>
         </div>
         <div class="invoice overflow-auto">
            <div style="min-width: 600px">
               <header>
                  <div class="row d-flex justify-content-spcae-between">
                     <div class="col-md-8 col-xl-8">
                        <h2>Order Details:</h2>
                        <h4>Order Status:
                           @if ($order->status == 'processing')
                           <span class='badge bg-warning'>Processing</span>
                           @elseif($order->status == 'confirmed')
                           <span class='badge bg-info'>Confirmed</span>
                           @elseif($order->status == 'picked')
                           <span class='badge bg-primary'>Picked</span>
                           @elseif($order->status == 'shiped')         
                           <span class='badge bg-dark'>Shiped</span> 
                           @elseif($order->status == 'delivered')
                           <span class='badge bg-success'>Delivered</span> 
                           @elseif($order->status == 'cancelled')
                           <span class='badge bg-danger'>Cancelled</span> 
                           @endif
                        </h4>

                     </div>
                     <div class="col-md-4 company-details">

                        <div class="">
                        </div>
                     </div>
                  </div>
               </header>
               <main>
                  <div class="row contacts d-flex justify-content-between">
                     <div class="col-md-8 invoice-to">
                        <div class="text-gray-light">Order for:</div>
                        <h2 class="to">{{$order->user->name}}</h2>
                        <div class="address">
                           @php
                               $address = App\Models\Address::findOrFail($order->address_id);
                           @endphp
                            
                            {{$address->address }},
                           {{$address->upazila->upazila_name }},
                           {{$address->district->district_name }} 
                        </div>
                        <div class="email"><a href="mailto:{{$order->email}}">{{$order->email}}</a>
                        </div>
                     </div>
                     <div class="col-md-4 invoice-details">
                        <h4 class="">INVOICE: #{{$order->invoice_no}} </h4>

                        <div class="date">Order Date: {{Illuminate\Support\Carbon::parse($order->order_date)->format(' d.M.Y - h:i A')}}</div>
                     </div>
                  </div>
               </main>
               <hr>
               <div class="table-responsive text-nowrap">
                  <table class="table">
                     <thead class="table-dark">
                        <tr>
                           <th>SL</th>
                           <th>Product</th>
                           <th>Price</th>
                           <th>QTY</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     {{-- number_format(,2,'.',',') --}}
                     <tbody class="table-border-bottom-0">
                        @foreach ($order_item as $key => $item)
                        <tr>
                           <td>{{$key+1}}</td>
                           <td>{{substr($item->product->product_name,0,50).'...'}}</td>
                           <td><strong>{!!$currency->currency_symbol!!} {{ number_format( $item->price,2,'.',',') }}</strong></td>
                           <td><strong>{{$item->qty}}</strong></td>
                           <td><strong>{!!$currency->currency_symbol!!}{{ number_format($item->price * $item->qty,2,'.',',')}}</strong></td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="2"></td>
                           <td colspan="2">SUBTOTAL</td>
                           <td>{!!$currency->currency_symbol!!}{{number_format($order->total_amount - $order->delevarycharge,2,'.',',')}}</td>
                        </tr>
                        <tr>
                           <td colspan="2"></td>
                           <td colspan="2">Delivery Charge</td>
                           <td>{!!$currency->currency_symbol!!}{{number_format($order->delevarycharge,2,'.',',')}} </td>
                        </tr>
                        @if ($order->total_discount)
                        <tr>
                           <td colspan="2"></td>
                           <td colspan="2">Total Discount</td>
                           <td> {!!$currency->currency_symbol!!}{{number_format($order->total_discount,2,'.',',')}}</td>
                        </tr>
                        @endif
                        <tr>
                           <td colspan="2"></td>
                           <td colspan="2">GRAND TOTAL</td>
                           <td>{!!$currency->currency_symbol!!} {{number_format($order->total_amount,2,'.',',')}} </td>
                        </tr>
                     </tfoot>
                  </table>
                  <div class="table-border-bottom-0"></div>
               </div>
               {{-- <div class="thanks">Thank you!</div>
               <div class="notices">
                  <div>NOTICE:</div>
                  <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
               </div>
               </main>
               <footer>Invoice was created on a computer and is valid without the signature and seal.</footer> --}}
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div>

            </div>
         </div>
      </div>
   </div>
</div>
@endsection