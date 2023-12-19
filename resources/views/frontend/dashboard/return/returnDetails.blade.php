@extends('frontend.master')
@section('title','Return Details')
@section('content')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<div class="container">
   <style>
      th{
      padding: 5px;
      text-align: center;
      }
      td{
      padding: 5px;
      }
      
  /* progress-bar */
 #return_view ul{
    display: flex;
    /* margin-top: 80px; */
}
#return_view ul li{
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}
#return_view ul li .icon{
    font-size: 35px;
    color: #ff4732;
    margin: 0 60px;
}
#return_view ul li .text{
    font-size: 14px;
    font-weight: 600;
    color: #ff4732;
    margin-bottom: 0px;
}

/* Progress Div Css  */

#return_view ul li .progress{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(68, 68, 68, 0.781);
    margin: 14px 0;
    display: grid;
    place-items: center;
    color: #fff;
    position: relative;
    cursor: pointer;
}
#return_view .progress::after{
    content: " ";
    position: absolute;
    width: 125px;
    height: 5px;
    background-color: rgba(68, 68, 68, 0.781);
    left: 30px;
}
#return_view .one::after{
    width: 0;
    height: 0;
}
#return_view ul li .progress .uil{
    display: none;
}
#return_view ul li .progress p{
    font-size: 13px;
}

/* Active Css  */

#return_view ul li .active{
    background-color: #ff4732;
    display: grid;
    place-items: center;
}
#return_view li .active::after{
    background-color: #ff4732;
}
#return_view ul li .active p{
    display: none;
}
#return_view ul li .active .uil{
    font-size: 20px;
    display: flex;
}

/* Responsive Css  */

@media (max-width: 980px) {
   #return_view ul{
        flex-direction: column;
    }
    #return_view    ul li{
        flex-direction: row;
    }
    #return_view    ul li .progress{
        margin: 0 30px;
    }
    .progress::after{
        width: 5px;
        height: 55px;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }
    .one::after{
        height: 0;
    }
    #return_view    ul li .icon{
        margin: 15px 0;
    }
}


   </style>
   <h4>Order Details</h4>
   <div class="row">
      {{-- 
      <div class="col-md-4"></div>
      --}}
      <div class="col-md-4">
         <div class="card">
            <div class="card-body">
               <table border="1" id="example" class="display nowrap stripe row-border order-column compact" style="width:100%">
                  <tr>
                     <th>Order Number : </th>
                     <th>{{$return->order->order_number}}</th>
                  </tr>
                  <tr>
                     <th>Invoice No : </th>
                     <th>{{$return->order->invoice_no}}</th>
                  </tr>
                  <tr>
                     <th>Price : </th>
                     <th>{!!$currency->currency_symbol!!} {{number_format(($orderItem->price-$orderItem->discount)*$orderItem->qty,2,'.',',')}}, {{$orderItem->qty}} Item</th>
                  </tr>
                  <tr>
                     <th>Payment Type : </th>
                     <th>{{$return->order->payment_method}}({{$return->order->payment_type}})</th>
                  </tr>
                  <tr>
                     <th>Status : </th>
                     <th style="color:rgb(207, 35, 35)">{{$return->status}}</th>
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <div class="col-md-8">
         <table>
            <tr>
               <th>Photo</th>
               <th>Product</th>
               <th>Size</th>
               <th>Color</th>
               <th>Amount</th>
               <th>Action</th>
            </tr>
            <tr>
               <td><img src="{{asset($return->product->product_photo)}}" width="80" alt="" srcset=""></td>
               <td>
                  <h4>{{$return->product->product_name}}</h4>
               </td>
               <td>
                  <h4>{{$orderItem->size??'-'}}</h4>
               </td>
               <td>
                  <h4>{{$orderItem->color??'-'}}</h4>
               </td>
               <td>
                  <h4>{!!$currency->currency_symbol!!}{{number_format(($orderItem->price-$orderItem->discount)*$orderItem->qty,2,'.',',')}}</h4>
               </td>
               <td>
                @if ($return->status == 'deliverd' || $return->status == 'reject')
                  <h4><button id="report">Report</button></h4>                      
                  @else
                  <h4><button disabled>Report</button></h4>                      
                      
                  @endif
               </td>
            </tr>
         </table>
         <div id="reportTextArea" style="display: none">
            <form action="" method="post">
               @csrf
               <textarea   name="" id="" cols="70" rows="5"></textarea><br>
               <button class="btn">Submit</button>
            </form>
         </div>
      </div>
   </div>

   <div class="row" id="return_view">
    <div class="col-md-4">
        <h4 style="margin-top: 40px">Return Tracker: </h4>
       <ul>
           @if ($return->status == 'reject')
           <li>
               <i class="icon uil uil-cancel"></i>
               <div class="progress four active">
                   <p>3</p>
                   <i class="uil uil-check"></i>
                </div>
                <p class="text">Return Reject</p>
              <p class="">{{Carbon\Carbon::parse($return->reject_date)->format('h:m a, d-M-y')}}</p>

            </li> 
            @endif
            @if ($return->status == 'deliverd')
           
           <li>
              <i class="icon uil uil-package"></i>
              <div class="progress three active">
                 <p>3</p>
                 <i class="uil uil-check"></i>
              </div>
              <p class="text">Delivery</p>
              <p class="">{{Carbon\Carbon::parse($return->delivery_date)->format('h:m a, d-M-y')}}</p>

           </li> 
           @endif
           @if ($return->status == 'accept')
           <li>
            <i class="icon uil uil-process"></i>
            <div class="progress one active ">
               <p>5</p>
               <i class="uil uil-check"></i>
            </div>
            <p class="text">Return Progress</p>
            <p class="">{{Carbon\Carbon::parse($return->accept_date)->format('h:m a, d-M-y')}}</p>

         </li>
         @endif
         @if ($return->status == 'accept')
           <li>
              <i class="icon uil uil-check"></i>
              <div class="progress two active ">
                 <p>4</p>
                 <i class="uil uil-check"></i>
              </div>
              <p class="text">Return in Accept</p>
              <p class="">{{Carbon\Carbon::parse($return->accept_date)->format('h:m a, d-M-y')}}</p>

           </li>
           @endif
           @if ($return->status == 'process')
           <li>
              <i class="icon uil uil-exchange"></i>
              <div class="progress one active ">
                 <p>5</p>
                 <i class="uil uil-check"></i>
              </div>
              <p class="text">Return Progress</p>
              <p class="">{{Carbon\Carbon::parse($return->process_date)->format('h:m a, d-M-y')}}</p>
           </li>
           @endif
        </ul>
    </div>
    <div class="col-md-3"></div>
 </div>
</div>


</div>
@section('script')
<script>
   $('#report').on('click',function(){
       $('#reportTextArea').show();
   })
</script>

@endsection
@endsection