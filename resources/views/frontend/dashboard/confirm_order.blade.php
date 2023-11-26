@extends('frontend.master')
@php
$currency = App\Models\Currency::where('status','active')->first(); 
$address = App\Models\Address::where('status','active')->first();

	error_reporting(0);
	date_default_timezone_set('Asia/Dhaka');
	//Generate Unique Transaction ID
	function rand_string( $length ) {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}
	$cur_random_value=rand_string(6);
	
@endphp 
@section('title','Confirm Order')
@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
                                @foreach ($cartData as $item)

                                    @php
                                        $cart = App\Models\Cart::findOrFail($item);
                                        // $product = App\Models\Product::findOrFail($cart->product_id);
                                         $value = $cart->product->product_discount?$cart->product->product_price -$cart->product->product_discount : $cart->product->product_price;

                                    @endphp
                                
								<div class="order-col">
                                    <div>{{$cart->qty}}x {{$cart->product->product_name}}</div>
									<div>{!!$currency->currency_symbol !!} {{ number_format(($value*$cart->qty),2,'.',',')}}</div>
								</div>
                                @endforeach
								{{-- <div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div> --}}


							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>{!!$currency->currency_symbol !!}{{$totalDlevery}}</strong></div>
							</div>
							<div class="order-col">
								<div>Total Discount</div>
								<div><strong>{!!$currency->currency_symbol !!}{{$totalDiscount}}</strong></div>
							</div>
                            <div class="order-col">
								<div>Payment Method</div>
								<div><strong>{{$payment=='cash'?'Cash on delivery':'Online payment'}}</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total"> {!!$currency->currency_symbol !!} {{number_format(($totalAmount+$totalDlevery),2,'.',',')}} </strong></div>
							</div>
						</div>
						<div class="payment-method">
							
						</div>
						@if ($payment !=='cash')
	                    <form  style='margin:0 auto; text-align:center;' action="https://sandbox.aamarpay.com/index.php" method="post" name="form1">
						@else							
                        <form action="{{route('confirmed')}}" method="post">
 						@endif
                            @csrf
						@if ($payment == 'cash')
						<div class="input-checkbox">
							<input type="checkbox" name="read_and_accept" id="terms">
							<label for="terms">
								<span></span>
                                {{-- {{$payment=='cash'?' ':'Online payment'}} --}}
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						@if ($errors->has('read_and_accept'))
							<div class="alert alert-danger">
								{{ $errors->first('read_and_accept') }}
							</div>
						@endif

						@endif

                        <input type="hidden" name="payment" value="{{$payment}}">
                        <input type="hidden" name="totalAmount" value="{{$totalAmount}}">
                        <input type="hidden" name="totalDlevery" value="{{$totalDlevery}}">
                        <input type="hidden" name="totalDiscount" value="{{$totalDiscount}}">



						<input type="hidden" name="store_id" value="aamarpay">
						<input type="hidden" name="signature_key" value="28c78bb1f45112f5d40b956fe104645a">
						<input type="hidden" name="tran_id" value='<?php echo "$cur_random_value"; ?>'>
						<input type="hidden" name="amount" value="{{$totalAmount+$totalDlevery}}">
						<input type="hidden" name="currency" value="{{$currency->currency}}">
						<input type="hidden" name="cus_name" value="{{$address->name??Auth::user()->name}}">
						<input type="hidden" name="cus_email" value="{{$address->email??Auth::user()->email}}">
						<input type="hidden" name="cus_add1" value="{{$address->address}}">
						<input type="hidden" name="cus_add2" value="">
						<input type="hidden" name="cus_city" value="{{$address->division->division_name}}">
						<input type="hidden" name="cus_state" value="{{$address->district->district_name}}">
						<input type="hidden" name="cus_postcode" value="">
						<input type="hidden" name="cus_country" value="Bangladesh">
						<input type="hidden" name="cus_phone" value="{{$address->mobile_number}}">
						<input type="hidden" name="cus_fax" value="">
						<input type="hidden" name="amount_vatratio" value="0">
						<input type="hidden" name="amount_vat" value="0">
						<input type="hidden" name="amount_taxratio" value="0">
						<input type="hidden" name="amount_tax" value="0">
						<input type="hidden" name="amount_processingfee_ratio" value="0">
						<input type="hidden" name="amount_processingfee" value="0">
						<input type="hidden" name="desc" value="Products Name Payment">
						{{-- <input type="hidden" name="opt_a" value="{{ json_encode(session()->get('cartData')) }}"> --}}
						<input type="hidden" name="opt_a" value="{{ implode(',', session()->get('cartData')) }}">
						<input type="hidden" name="opt_b" value="{{ implode(',', session()->get('orderItem')) }}">
						<input type="hidden" name="opt_c" value="{{ session()->get('totalDiscount') }}">
						<input type="hidden" name="opt_d" value="{{ session()->get('totalDlevery') }}">


						<input type="hidden" name="success_url" value="{{route('success')}}">
						<input type="hidden" name="fail_url" value="{{route('fail')}}">
						<input type="hidden" name="cancel_url" value="{{route('cancel')}}">
						{{-- <input type="submit" class='button' value="Pay Now" name="pay"> --}}








                        @if ($payment =='cash')
						<button type="submit" class="primary-btn order-submit" style="margin: auto">Confirm Order</button>
                        @else
						{{-- <a href="#" class="primary-btn order-submit">Pay and Confirm order</a> --}}
						<button type="submit" class="primary-btn order-submit" value="Pay Now" name="pay" style="margin: auto">Pay and Confirm order</button>
						{{-- <button class="primary-btn order-submit" style="margin: auto" id="sslczPayBtn"
                        token="if you have any token validation"
                        postdata="your javascript arrays or objects which requires in backend"
                        order="If you already have the transaction generated for current order"
                        endpoint="{{ url('/pay-via-ajax') }}"> Pay and Confirm order
               			 </button> --}}
                        @endif

                    </form>
					</div>
					<!-- /Order Details -->
            </div>
        </div>
    </div>



	 
	
	 @section('script')
		

	
	<script>
		// var obj = {};
		// obj.cus_name = $('#customer_name').val();
		// obj.cus_phone = $('#mobile').val();
		// obj.cus_email = $('#email').val();
		// obj.cus_addr1 = $('#address').val();
		// obj.amount = $('#total_amount').val();
	
		$('#sslczPayBtn').prop('postdata', obj);
	
		(function (window, document) {
			var loader = function () {
				var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
				// script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
				script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
				tag.parentNode.insertBefore(script, tag);
			};
	
			window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
		})(window, document);
	</script>

	@endsection



@endsection