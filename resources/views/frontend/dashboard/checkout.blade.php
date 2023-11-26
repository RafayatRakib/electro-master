@extends('frontend.master')
@php
$site = App\Models\LogonAndName::where('status','active')->first();
$cart = App\Models\Cart::where('user_id',Auth::id())->get();
$currency = App\Models\Currency::where('status','active')->first();
$address = App\Models\Address::where('status','active')->first();

@endphp
@section('title',$site->name.' - Checkout')
@section('content')
<div class="container">
   <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="{{url('/')}}">Home</a></li>
							<li class="active">Checkout</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

        <div class="row">
            <div class="col-md-3"></div>

        <!-- Order Details -->
        <div class="col-md-6 order-details">
            <div class="section-title text-center">
                <h3 class="title">Your Order</h3>
            </div>
            <div class="order-summary">
                <div class="order-col">
                    <div><strong>PRODUCT</strong></div>
                    <div><strong>TOTAL</strong></div>
                </div>
                @php
                        $totalvalue= 0;
                        $totalDlevery = 0;
                        
                        @endphp
                <div class="order-products">
                    @foreach ($cart as $item)
                        @php

                        $value = $item->product->product_discount?$item->product->product_price -$item->product->product_discount : $item->product->product_price;
                        $totalDlevery += $address->district->delivery_charge * $item->qty;
                        $totalvalue+=$value;
                        @endphp
                    <div class="order-col">
                        
                        <div> {{$item->qty}} x {{substr($item->product->product_name,20).'...'}}</div>
                        <div> {!!$currency->currency_symbol !!} {{ number_format($value,2,'.',',')}}</div>
                    </div>
                    @endforeach
                </div>
                <div class="order-col">
                    <div>Shiping</div>
                    <div><strong>{!!$currency->currency_symbol !!} {{$totalDlevery}}</strong></div>
                </div>
                <div class="order-col">
                    <div><strong>TOTAL</strong></div>
                    <div><strong class="order-total">{!!$currency->currency_symbol !!}{{number_format(($totalvalue+$totalDlevery),2,'.',',')}} </strong></div>
                </div>
            </div>
            <div class="payment-method">
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-1">
                    <label for="payment-1">
                        <span></span>
                        Direct Bank Transfer
                    </label>
                    <div class="caption">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-2">
                    <label for="payment-2">
                        <span></span>
                        Cheque Payment
                    </label>
                    <div class="caption">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-3">
                    <label for="payment-3">
                        <span></span>
                        Paypal System
                    </label>
                    <div class="caption">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="input-checkbox">
                <input type="checkbox" id="terms">
                <label for="terms">
                    <span></span>
                    I've read and accept the <a href="#">terms & conditions</a>
                </label>
            </div>
            <a href="#" class="primary-btn order-submit">Place order</a>
        </div>
<!-- /Order Details -->


            <div class="col-md-3"></div>
        </div>








</div>
@section('script')


@endsection
@endsection