@extends('backend.master')
@section('title','Invenotry Details')
@section('content')
<div class="container">
    <div class="my-5">
        <div class="d-flex justify-content-between">
            <h2>Inventory Details</h2>
            <div class="p-3">
                <a class="btn btn-primary" href="{{route('product.edit',$product->id)}}"><i class="bx bx-edit-alt me-1"></i> Update QTY</a>
            </div>
        </div>
        <div class="card"> 
            <div class="row">
            <div class="col-md-6">
        <div class="table-responsive ">
            <table class="table">
                <tr>
                    <th>Name: </th>
                    <th> {{$product->product_name}} </th>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <th><strong>SL</strong></th>
                    <th><strong>QTY</strong></th>
                    <th><strong>Update Date</strong></th>
                </tr>
                @foreach ($inventory as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>    
                    <td>{{$item->qty}}</td>    
                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('h:i:s A / d-M-Y') }}</td>
   
                </tr>   
                @endforeach
                <tr>
                    <th><strong>SL</strong></th>
                    <th><strong>QTY</strong></th>
                    <th><strong>Update Date</strong></th>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="p-5 d-flex justify-content-center">
            <img src="{{asset($product->product_photo)}}"style="width: 200px" alt="" srcset="">
        </div>
    </div>
    </div>           
        </div>


        <div class="mt-5">
            <h2 class="">Product Details</h2>
            <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                    Short Description
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                    Logn Description
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                    Details
                  </button>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    {!! $product->short_des !!}
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    {!! $product->long_des !!}
                </div>
                <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                    {!! $product->details !!}
                </div>
              </div>
            </div>
          </div>
    
        </div>


    </div>
</div>
    
@endsection