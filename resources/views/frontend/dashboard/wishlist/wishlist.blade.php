
@php
$site = App\Models\LogonAndName::where('status','active')->first();
$currency = App\Models\Currency::where('status','active')->first();
$wishlist = App\Models\Wishlist::where('user_id',Auth::id())->get();

@endphp
@extends('frontend.master')
@section('title',$site->name.' - My Wishlist')

@section('content')



<div class="container">

    <div class="row">
        <div class="col-md-4">
           <h2 >My wishlist:</h2>
           {{-- <p>There are <strong id="Totalitem">{{$totalItem}}</strong> products in your cart</p> --}}
        </div>
        <div class="col-md-4">
           <div id="alertMsg" style="margin-top: 40px">
              @if (session()->get('success'))
              <div style="margin-top: 40px">
                  <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
                      <p style="margin: auto">{{session()->get('success')}}</p>
                  </div>
              </div>
              @endif
           </div>
        </div>
     </div>

        <div class="table-responsive">
           <div id="alert_msg">
           </div>
           <table class="table">
              <thead>
                  <tr>
                     <th>SL</th>
                    <th colspan="2">Product</th>
                    <th>Regular Price</th>
                    <th>Current Price</th>
                    <th>Remove</th>
                 </tr >
              </thead>
              <tbody id="tbody">

               @forelse ($wishlist as  $key => $item)
               @php
                   $flashSales = App\Models\FlashSalesProduct::where('product_id',$item->product_id)->first();
               @endphp

               @if ($flashSales && $flashSales->flashsale->end_time >= Carbon\Carbon::now())
              
               
               <tr>
                  <td>{{$key+1}}</td>
                  <td><img style="width: 60px" src="{{asset($item->product->product_photo)}}"></td>
                  <td style="width: 50%">{{$item->product->product_name}}</td>
                  <td><del>{{number_format($item->product->product_price,2,'.',',')}}</del></td>
                  @if ($flashSales->flashsale->discount_type == 'percentage')
                  @php 
                     $discountPrice = $item->product->product_price - (($item->product->product_price  / 100) * $flashSales->flashsale->discount );
              
                  @endphp
                  <td> {!!$currency->currency_symbol !!} {{ number_format($discountPrice,2,'.',',')}}</td>
                  @else
                  @php 
                     $discountPrice = $item->product->product_price - $flashSales->flashsale->discount ;
              

                  @endphp
                  <td> {!!$currency->currency_symbol !!} {{ number_format($discountPrice,2,'.',',')}}</td>                      
                  @endif
                  
                  <td>
                     <a class="btn" href="{{route('cart_item_delete',encrypt($item->id))}}" onclick="return confirm('Are you sure you want to remove it?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                     <a class="btn" href="{{url('/product/details/'.$item->product_id.'/'.$item->product->product_slug)}}"><i class="fa fa-shopping-cart"></i></a>
                   </td>
               </tr>
               {{-- @endif --}}
               
               @else
                   @php
               $value = $item->product->product_discount?$item->product->product_price -$item->product->product_discount : $item->product->product_price;
                 @endphp
               <tr>
                  <td><input class="form-check-input customCheckbox" type="checkbox" name="cartcheckbox[]" value="{{$item->id}}" id="customCheckbox" checked=""></td>
                  <td><img style="width: 60px" src="{{asset($item->product->product_photo)}}"></td>
                  <td>{{$item->product->product_name}}</td>
                  <td> {!!$currency->currency_symbol !!} {{ number_format($value,2,'.',',')}}</td>

                  <td>
                     <a class="btn" href="{{route('cart_item_delete',encrypt($item->id))}}" onclick="return confirm('Are you sure you want to remove it?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                     <a class="btn" href="{{url('/product/details/'.$item->product_id.'/'.$item->product->product_slug)}}" ><i class="fa fa-shopping-cart"></i></a>
                   </td>
               </tr>
               @endif

               @empty
               <h4>Cart is empty</h4>
               @endforelse
                 
              </tbody>
           </table>
        </div>
    </div>

    
    
@endsection