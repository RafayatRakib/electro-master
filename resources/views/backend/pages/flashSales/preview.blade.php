@extends('backend.master')
@section('title','Flash Sales Preview')
@section('content')
<div class="container">
    <div class="my-5">

           <div class="card">
              <div class="container my-3">
                <div class="d-flex justify-content-between">
                    <h4 class="title">Add Flash Sales:</h4>
                        <a href="{{route('editFlashSale',$flashSales->id)}}" class="btn btn-primary">Edit</a>
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>Name:</th>
                                <td>{{$flashSales->flas_sales_name}}</td>
                            </tr>
                            <tr>
                                <th>Discount Type:</th>
                                <td>{{$flashSales->discount_type}}</td>
                            </tr>
                            <tr>
                                <th>Start Time :</th>
                                <td>{{Carbon\Carbon::parse($flashSales->start_time)->toDateTimeString()}}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td class="mt-1 {{$flashSales->status=='active'?'badge bg-success':'badge bg-danger'}}">{{$flashSales->status}}</td>
                            </tr>

                        </table>        
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>Short Note:</th>
                                <td>{{$flashSales->short_note}}</td>
                            </tr>
                            <tr>
     
                                <th>Discount:</th>
                                <td>{{$flashSales->discount}} {{$flashSales->discount_type=='cash'? $currency->currency:'%'}}</td>
                            </tr>
                            <tr>
                                <th>End Time :</th>
                                <td>{{Carbon\Carbon::parse($flashSales->end_time)->toDateTimeString()}}</td>
                            </tr>
                            <tr>
                                <th>Photo :</th>
                                @if ($flashSales->bg_photo)
                                <td><img style="width: 75px" src="{{asset($flashSales->bg_photo)}}" alt=""></td>
                                @else
                                <td>No photo found</td>    
                                @endif
                                
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="m-3">
                        <h3 id="days">00</h3>
                        <span>Days  </span>
                     </div>
                     <div class="m-3">
                        <h3 id="hours">00</h3>
                        <span>Hours</span>
                     </div>
                     <div class="m-3">
                        <h3 id="seconds">00</h3>
                        <span>Secs</span>
                     </div>
                </div>

            </div>
    </div>
</div>
<hr>
<div class="card p-3">
    <h3>Flash Sales Product list: </h3>

    <table class="table">
        <tr>
            <th>SL</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Main Price</th>
            <th>Action</th>
        </tr>
        @php
            $product = App\Models\FlashSalesProduct::where('flash_sales_id',$flashSales->id)->get();
        @endphp
        @forelse ($product as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td> 
                    @if ($item->bg_photo)
                    <img src="{{asset($item->bg_photo)}}" style="width: 70px" alt="Background" > 
                    @else
                        <small><strong>No photo found</strong></small>                        
                    @endif
                </td>
                <td><small>{{$item->product->product_name}}</small></td>
                <td><small>{{number_format($item->product->product_price,2,'.',',')}}{{ $currency->currency}}</small></td>
                <td><a href="{{route('flashProduct',$item->id)}}" onclick="return confirm('Are you sure you want to delete?')" ><i class="bx bx-trash me-1"></i> Delete</a></td>
            </tr>
        @empty
            <h4>No product found</h4>
        @endforelse

        <tr>
            <th>SL</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Main Price</th>
            <th>Action</th>
        </tr>
    </table>
</div>


</div>

@section('script')
<script>
   $(document).ready(function() {
       var countDownDate = new Date("{{ $flashSales->end_time }}").getTime();
   
       var x = setInterval(function() {
           var now = new Date().getTime();
           var distance = countDownDate - now;
   
           var days = Math.floor(distance / (1000 * 60 * 60 * 24));
           var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
           var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
           var seconds = Math.floor((distance % (1000 * 60)) / 1000);
   
           $('#days').text(days.toString().padStart(2, '0'));
           $('#hours').text(hours.toString().padStart(2, '0'));
           $('#minutes').text(minutes.toString().padStart(2, '0'));
           $('#seconds').text(seconds.toString().padStart(2, '0'));
   
           if (distance < 0) {
               clearInterval(x);
               $('#days').text('00');
               $('#hours').text('00');
               $('#minutes').text('00');
               $('#seconds').text('00');
           }
       }, 1000);
   });
</script>
@endsection
@endsection