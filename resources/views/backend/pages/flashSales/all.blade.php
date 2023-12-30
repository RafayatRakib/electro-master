@extends('backend.master')
@section('title','All Flash Sales')
@section('content')
<div class="container">

        <div class="card my-3">
            <h3 class="m-3">All Flash Sales:</h3>
         <div class=" text-nowrap py-4">
            <table class="table">
            <tr class="bg-dark text-white">
               <th>SL</th>
               <th>Flash Sales Name</th>
               <th>Discount Type</th>
               <th>Discount</th>
               <th>Start Time</th>
               <th>End Time</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
            @php
                $flash = App\Models\FlashSales::latest()->paginate();
            @endphp
               @forelse ($flash as $key => $flashSale)
               <tr class="{{$flashSale->discount_type=='cash'?' bg-label-secondary':''}}">
                  <td>{{$key+1}}</td>
                  <td>{{$flashSale->flas_sales_name}}</td>
                  <td>{{$flashSale->discount_type}}</td>
                  <td>{{$flashSale->discount}}</td>
                  <td>{{$flashSale->start_time}}</td>
                  <td>{{$flashSale->end_time}}</td>
                  <td class="badge bg-success mt-2">{{$flashSale->status}}</td>
                  <td>
                     {{-- <a class="dropdown-item" href="{{route('editFlashSale',$flashSale->id)}}"><i class="bx bx-edit-alt me-1"></i> </a> --}}
                     <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                           <a class="dropdown-item" href="{{route('editFlashSale',$flashSale->id)}}"><i class="bx bx-edit-alt me-1"> Edit</i> </a>
                           <a class="dropdown-item" href="{{route('viewFlashSale',$flashSale->id)}}"><i class="bx bx-show-alt me-1"> Preview</i> </a>

                          <form id="deleteForm" action="" method="post">
                            @csrf
                            <input type="hidden" name="delete_id" value="">
                          <button type="submit" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
                        </form>
                        </div>
                      </div>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="7">No flash sales available</td>
               </tr>
               @endforelse
         </table>
         {{ $flash->links() }}
        </div>
      </div>

</div>
@endsection