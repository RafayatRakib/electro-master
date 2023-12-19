<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;
    protected $gurded = [];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }// end method

    public function item(){
        return $this->hasMany(Order_item::class,'');
    }//end method

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }//end method

    public function reson(){
        return $this->belongsTo(ReturnReson::class,'return_reson_id','id');
    }//end method

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }//end method

}


// @foreach ($orderItem as $key => $item)
//         <tr>
//             <td>{{$key+1}}</td>
//             <td>{{ substr($item->product->product_name, 0, 50).'...' }}({{$item->qty}}x)</td>
//             <td>{{$item->size?? '-'}}</td>
//             <td>{{$item->color?? '-'}}</td>
//             <td>{!!$currency->currency_symbol!!} {{number_format($item->qty*$item->price,2,'.',',')}}</td>
//             <td>
//                 @if ($order->delivered_date)
//                 {{-- <a href="{{route('order.return',encrypt($item->product_id))}}" > <b> Return</b></a> --}}
//                 <a href="{{ route('order.return', ['oid' => encrypt($item->order_id), 'pid' => encrypt($item->product_id)]) }}"><b>Return</b></a>

//                 @else
//                 <b disabled title="Disabled"> Return</b>
//                 {{-- <a disabled title="Disabled"> 
//                 </a>
//                  --}}
//                 @endif
                
//                 @if ($order->delivered_date)
//                 {{-- <a href="">R</a> --}}
//                 {{-- <a href="{{ url('/product/rate/' . encrypt($item->product_id)) }}"><b>Rate</b></a> --}}
//                 <a href="{{ route('rate',encrypt($item->product_id)) }}"><b>Rate</b></a>
//                 @else
//                 <b disabled title="Disabled"> Rate</b>
//                 {{-- <a disabled title="Disabled">
//                 </a> --}}
//                 @endif
                
//             </td>
//         </tr>
//         @endforeach