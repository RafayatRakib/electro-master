@extends('frontend.master')
@php
$site = App\Models\LogonAndName::where('status','active')->first();
$cart = App\Models\Cart::where('user_id',Auth::id())->get();
$currency = App\Models\Currency::where('status','active')->first();
$address = App\Models\Address::where('status','active')->first();
$totalItem = count($cart);
// $totalAmount = 0;
// foreach ($ as $key => $value) {
//     # code...
// }
@endphp
@section('title',$site->name.' - My Cart')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-4">
         <h2 >My Cart:</h2>
         <p>There are <strong id="Totalitem">{{$totalItem}}</strong> products in your cart</p>
      </div>

            @if (session()->get('success'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{session()->get('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
            @endif
   </div>
   <form action="{{route('checkout')}}" method="get">
      @csrf
      <div class="table-responsive">
         <div id="alert_msg">
         </div>
         <table class="table">
            <thead>
               <tr>
                  <th>    <input type="checkbox" id="selectAll" checked=''> Select All<br></th>
                  <th colspan="2">Product</th>
                  <th>Unit Price</th>
                  <th>Quantity</th>
                  <th>Remove</th>
               </tr >
            </thead>
            <tbody id="tbody">
               @php
               $totalAmount = 0;
               $totalDlevery = 0;
               $totalDiscount = 0;
               @endphp
               @forelse ($cart as $item)
               @php
                   $flashSales = App\Models\FlashSalesProduct::where('product_id',$item->product_id)->first();
               @endphp

               @if ($flashSales && $flashSales->flashsale->end_time >= Carbon\Carbon::now())
               {{-- @if($flashSales->flashsale->end_time >= Carbon::now()) --}}
               
               <tr>
                  <td><input class="form-check-input customCheckbox" type="checkbox" name="cartcheckbox[]" value="{{$item->id}}" id="customCheckbox" checked=""></td>
                  <td><img style="width: 60px" src="{{asset($item->product->product_photo)}}"></td>
                  <td>{{$item->product->product_name}}</td>
                  @if ($flashSales->flashsale->discount_type == 'percentage')
                  @php 
                     $discountPrice = $item->product->product_price - (($item->product->product_price  / 100) * $flashSales->flashsale->discount );
                     $totalAmount+=$discountPrice;
                     $totalDlevery += $address->district->delivery_charge * $item->qty;
                  @endphp
                  <td> {!!$currency->currency_symbol !!} {{ number_format($discountPrice,2,'.',',')}}</td>
                  @else
                  @php 
                     $discountPrice = $item->product->product_price - $flashSales->flashsale->discount ;
                     $totalAmount+=$discountPrice;
                     $totalDlevery += $address->district->delivery_charge * $item->qty;

                  @endphp
                  <td> {!!$currency->currency_symbol !!} {{ number_format($discountPrice,2,'.',',')}}</td>                      
                  @endif
                  
                  <td>{{$item->qty}}</td>
                  <td>
                     <a class="btn" href="{{route('cart_item_delete',encrypt($item->id))}}" onclick="return confirm('Are you sure you want to remove it?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
               </tr>
               {{-- @endif --}}
               
               @else
                   @php
               $value = $item->product->product_discount?$item->product->product_price -$item->product->product_discount : $item->product->product_price;
               $totalAmount += $value * $item->qty;
               $totalDlevery += $address->district->delivery_charge * $item->qty;
               $totalDiscount += $item->product->product_discount? $item->product->product_discount * $item->qty : 0;
                   @endphp
               <tr>
                  <td><input class="form-check-input customCheckbox" type="checkbox" name="cartcheckbox[]" value="{{$item->id}}" id="customCheckbox" checked=""></td>
                  <td><img style="width: 60px" src="{{asset($item->product->product_photo)}}"></td>
                  <td>{{$item->product->product_name}}</td>
                  <td> {!!$currency->currency_symbol !!} {{ number_format($value,2,'.',',')}}</td>
                  <td>{{$item->qty}}</td>
                  <td>
                     <a class="btn" href="{{route('cart_item_delete',encrypt($item->id))}}" onclick="return confirm('Are you sure you want to remove it?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
               </tr>
               @endif

               @empty
               <h4>Cart is empty</h4>
               @endforelse
            </tbody>
         </table>
      </div>

      <div class="row mt-50">
         <form action="{{route('checkout')}}" method="post">
            @csrf
            <div class="col-lg-5">
               <h2>Shipping Address: </h2>
               <div class="card">
                  <div class="card-header">
                     <h4>Deliver to: {{Auth::user()->name}}</h4>
                  </div>
                  <strong style="border: 2px solid #333; border-radius: 3px; padding:3px"> {{$address->address_type}} </strong> <a href="{{route('user.address')}}" style="color: #D10024">Change</a>
                  <div class="card-body" style="margin-top: 10px">
                     <p>{{ $address->address. ',' . $address->upazila->upazila_name . ',' . $address->district->district_name }}</p>
                  </div>
               </div>
            </div>
            <div class="col-lg-7">
               <div class="divider-2 mb-30"></div>
               <div class="border p-md-4 cart-totals ml-30">

                  <div class="table-responsive">
                     <table class="table no-border">
                        <tbody>
                           <tr>
                              <th >Item Total</th>
                              <th style="flote: right" class="d-flex"  >
                                 <p>{!! $currency->currency_symbol !!}</p>
                                 <p id="totalAmount">{{$totalAmount}}</p>
                              </th>
                           </tr>
                           <tr>
                              <th >Shipping</th>
                              <th class="d-flex">
                                 {!! $currency->currency_symbol !!} 
                                 <p id="totalDlevery" >{{$totalDlevery}}</p>
                              </th>
                           </tr>

                           <tr>
                              <th >Total Payment</th>
                              <th class="d-flex">
                                 {!!  $currency->currency_symbol !!} 
                                 <p id="grandTotal">{{$totalAmount+$totalDlevery}}</p>
                              </th>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="payment-method">
                     <div class="input-radio">
                        <input type="radio" name="payment" value="online_payment" id="payment-2">
                        <label for="payment-2">
                        <span></span>
                        Online Payment (bkash, Rocket, Nagad etc)
                        </label>
                     </div>
                     <div class="input-radio">
                        <input type="radio" name="payment" value="cash" id="payment-3">
                        <label for="payment-3">
                        <span></span>
                        Cash on delevary
                        </label>
                     </div>
                     @error('payment')
                     <strong style="color: #D10024"> {{$message}} </strong>
                     @enderror
                  </div>
                  <input type="hidden" name="totalAmount" value="{{$totalAmount}}">
                  <input type="hidden" name="totalDlevery" value="{{$totalDlevery}}">
                  <input type="hidden" name="totalDiscount" value="{{$totalDiscount}}">
                  <button id="CheckOut" type="submit"  class="checkout-btn">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></button>
               </div>
            </div>
         </form>
      </div>


</div>

@section('script')

<script>
   $("#selectAll").change(function() {
           $(".customCheckbox").prop("checked", this.checked);
   
           var selectedValues = [];
           $(".customCheckbox:checked").each(function() {
               selectedValues.push($(this).val());
           });
           if(selectedValues.length === 0){
            $("#CheckOut").prop("disabled", true);
   
              let alert_msg = `<div style="margin-top: 40px">
                                      <div class="alert alert-danger" style="width: 60%; margin: auto; text-align: center">
                                         <p style="margin: auto">Please select at lest one item.</p>
                                      </div>
                                </div>`
              $('#alert_msg').html(alert_msg);
           }else{
            $("#CheckOut").prop("disabled", false);
              $('#alert_msg').html(' ');
   
           }
           if(selectedValues.length > 0){
           $.ajax({
              method: 'GET',
              dataType:'json',
              data: {id: selectedValues},
              url: 'get/cart/item/price',
              success:function(res){
                 console.log(res);
                 $('#totalAmount').html(res.totalAmount);
                 $('#totalDlevery').text(res.totalDlevery);
               //   $('#totalDiscount').text(res.totalDiscount);
                 $('#grandTotal').text(res.totalAmount+res.totalDlevery);
   
                 $("input[name='totalAmount']").val(res.totalAmount);
                 $("input[name='totalDlevery']").val(res.totalDlevery);
               //   $("input[name='totalDiscount']").val(res.totalDiscount);
              }
           });
           
         }else{
                 $('#totalAmount').html(0);
                 $('#totalDlevery').text(0);
                 $('#totalDiscount').text(0);
                 $('#grandTotal').text(0);
   
                 $("input[name='totalAmount']").val(0);
                 $("input[name='totalDlevery']").val(0);
                 $("input[name='totalDiscount']").val(0);
         }
       });
   //end all item
   
       $('.customCheckbox').change(function(){
        let Totalitem = $('#Totalitem').text();
   
        var selectedValues = [];
           $(".customCheckbox:checked").each(function() {
               selectedValues.push($(this).val());
           });
           if(selectedValues.length != Totalitem ){
              $("#selectAll").prop("checked", false);
           }else{
              $("#selectAll").prop("checked", true);
   
           }
   
           if(selectedValues.length === 0){
            $("#CheckOut").prop("disabled", true);
            
              let alert_msg = `<div style="margin-top: 40px">
                                      <div class="alert alert-danger" style="width: 60%; margin: auto; text-align: center">
                                         <p style="margin: auto">Please select at lest one item.</p>
                                      </div>
                                </div>`
              $('#alert_msg').html(alert_msg);
           }else{
            $("#CheckOut").prop("disabled", false);
              $('#alert_msg').html(' ');
   
           }
         
   
    if(selectedValues.length > 0){
           $.ajax({
              method: 'GET',
              dataType:'json',
              data: {id: selectedValues},
              url: 'get/cart/item/price',
              success:function(res){
                 console.log(res);
                 $('#totalAmount').html(res.totalAmount);
                 $('#totalDlevery').text(res.totalDlevery);
               //   $('#totalDiscount').text(res.totalDiscount);
                 $('#grandTotal').text(res.totalAmount+res.totalDlevery);
   
                 $("input[name='totalAmount']").val(res.totalAmount);
                 $("input[name='totalDlevery']").val(res.totalDlevery);
               //   $("input[name='totalDiscount']").val(res.totalDiscount);
              }
           });
         }else{
                 $('#totalAmount').html(0);
                 $('#totalDlevery').text(0);
                 $('#totalDiscount').text(0);
                 $('#grandTotal').text(0);
   
                 $("input[name='totalAmount']").val(0);
                 $("input[name='totalDlevery']").val(0);
                 $("input[name='totalDiscount']").val(0);
         }
   
       });




</script>
@endsection
@endsection