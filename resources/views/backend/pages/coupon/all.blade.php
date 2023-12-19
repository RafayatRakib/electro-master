@extends('backend.master')
@section('title','All Coupon')
@section('content')
@php
    $c = App\Models\Currency::where('status','active')->first();
@endphp
    <div class="container">
        <div class="my-5">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-light">
                    <tr>
                      <th>SL</th>
                      <th>Coupon Code</th>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Minimum Purchase</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Restriction</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
  
                      @forelse ($coupons as $key => $item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>  {{$item->coupon_code}} </td>
                      <td>  {{$item->discount_type}} </td>
                      <td>  {{$item->discount_type=="cash"?$item->discount:$item->discount.'%'}} </td>
                      <td>  {{$item->minimum_purchase}} </td>
                      <td>  {{$item->start_date}} </td>
                      <td>  {{$item->end_date}} </td>
                      <td>  {{$item->restrictions }} times </td>

                      <td>
                          @if($item->status == '1' )
                          <a href="{{route('coupon.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                          @else
                          <a href="{{route('coupon.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                          @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="{{route('coupon.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <form id="deleteForm" action="{{route('coupon.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="delete_id" value="{{$item->id}}">
                            <button type="submit" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
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
                        <th>SL</th>
                        <th>Coupon Code</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Minimum Purchase</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Restriction</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                  </footer>
                </table>
  
                {{$coupons->links('vendor.pagination.custom')}}
  
  
              </div>
        </div>
    </div>
@endsection