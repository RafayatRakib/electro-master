@extends('backend.master')
@section('title', 'All Product')
@section('content')



<div class="container">
   @if(session('success'))
   <div class="alert alert-primary" role="alert">{{session('success')}}</div>
   @elseif(session('error'))
   <div class="alert alert-danger" role="alert">{{session('error')}}</div>
   @endif

   <div class="card my-5">
      <div class="d-flex justify-content-between ">
         <h5 class="card-header">All Product</h5>
         <div class="mt-3 mx-3">
            <div class="input-group input-group-merge">
               <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
               <input type="text" class="form-control" placeholder="Search by product code..." aria-label="Search..." aria-describedby="basic-addon-search31">
             </div>
         </div>
         <div class="mt-3 mx-3">
            <a class="btn btn-primary" href="{{route('product.add')}}">Add Product</a>
         </div>
         
      </div>
   </div>

   <div class="row ">

      @forelse ($allProducts as $item)
          

      <div class="col-md-3">
         <div class="card">
            <img src="{{asset($item->product_photo)}}" class="card-img-top" alt="...">
            <div class="">
               @if ($item->product_discount)
                  
               <div class="position-absolute top-0 end-0 m-3 product-discount"><span class=""> -{{round(100*$item->product_discount/$item->product_price)}} % </span></div>
               @else
                   
               @endif
            </div>
            <div class="card-body">
               <h6 class="card-title cursor-pointer"> {{$item->product_name}} </h6>
               <div class="clearfix">
                  <p class="mb-0 float-start"><strong>134</strong> Sales</p>

                  <p class="mb-0 float-end fw-bold">
                     @if ($item->product_discount)
                     <span class="me-2 text-decoration-line-through text-secondary">${{$item->product_price}}</span>
                     <span>${{$item->product_price-$item->product_discount}}</span>
                        
                     @else
                     <span>${{$item->product_price}}</span>
                     @endif
                  </p>
               </div>
               <div class="d-flex align-items-end mt-3 fs-6">
                  <div class="dropdown">
                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="{{route('product.view',$item->id)}}"><i class="bx bx-low-vision  me-1"></i> View</a>
                        <a class="dropdown-item" href="{{route('product.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <form id="deleteForm" action="{{route('product.delete')}}" method="post">
                           @csrf
                           <input type="hidden" name="delete_id" value="{{$item->id}}">
                           <button type="submit" class="dropdown-item" id="productdelete"><i class="bx bx-trash me-1"></i> Delete</button>
                        </form>
                     </div>
                  </div>
               </div>


               <div class="d-flex align-items-center mt-3 fs-6">
                 <div class="cursor-pointer">
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-secondary"></i>
                 </div>	
                 <p class="mb-0 ms-auto">4.2(182)</p>
               </div>
            </div>
         </div>
      </div>
      @empty
          
      @endforelse



{{-- 
      <div class="col-md-3">
         <div class="card">
            <img src="assets/images/products/01.png" class="card-img-top" alt="...">
            <div class="">
               <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span></div>
            </div>
            <div class="card-body">
               <h6 class="card-title cursor-pointer">Nest Shaped Chair</h6>
               <div class="clearfix">
                  <p class="mb-0 float-start"><strong>134</strong> Sales</p>
                  <p class="mb-0 float-end fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$350</span><span>$240</span></p>
               </div>
               <div class="d-flex align-items-center mt-3 fs-6">
                 <div class="cursor-pointer">
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-secondary"></i>
                 </div>	
                 <p class="mb-0 ms-auto">4.2(182)</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card">
            <img src="assets/images/products/01.png" class="card-img-top" alt="...">
            <div class="">
               <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span></div>
            </div>
            <div class="card-body">
               <h6 class="card-title cursor-pointer">Nest Shaped Chair</h6>
               <div class="clearfix">
                  <p class="mb-0 float-start"><strong>134</strong> Sales</p>
                  <p class="mb-0 float-end fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$350</span><span>$240</span></p>
               </div>
               <div class="d-flex align-items-center mt-3 fs-6">
                 <div class="cursor-pointer">
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-secondary"></i>
                 </div>	
                 <p class="mb-0 ms-auto">4.2(182)</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card">
            <img src="assets/images/products/01.png" class="card-img-top" alt="...">
            <div class="">
               <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span></div>
            </div>
            <div class="card-body">
               <h6 class="card-title cursor-pointer">Nest Shaped Chair</h6>
               <div class="clearfix">
                  <p class="mb-0 float-start"><strong>134</strong> Sales</p>
                  <p class="mb-0 float-end fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$350</span><span>$240</span></p>
               </div>
               <div class="d-flex align-items-center mt-3 fs-6">
                 <div class="cursor-pointer">
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-warning"></i>
                  <i class="bx bxs-star text-secondary"></i>
                 </div>	
                 <p class="mb-0 ms-auto">4.2(182)</p>
               </div>
            </div>
         </div>
      </div> --}}
   </div>
</div>


















{{-- <div class="container mt-5">
   @if(session('success'))
   <div class="alert alert-primary" role="alert">{{session('success')}}</div>
   @elseif(session('error'))
   <div class="alert alert-danger" role="alert">{{session('error')}}</div>
   @endif
   <div class="card">
      <div class="d-flex justify-content-between ">
         <h5 class="card-header">Light Table head</h5>
         <div class="mt-3 mx-3">
            <a class="btn btn-primary" href="{{route('cat.add')}}">Add Category</a>
         </div>
      </div>


      <div class="row">
         <div class="col-sm-6 col-lg-4 mb-4" style="position: absolute; left: 0%; top: 0px;">
            <div class="card">
              <img class="card-img-top" src="../assets/img/elements/5.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Card title that wraps to a new line</h5>
                <p class="card-text">
                  This is a longer card with supporting text below as a natural lead-in to additional content.
                  This content is a little bit longer.
                </p>
              </div>
            </div>
          </div>
      </div>



      <div class="table-responsive text-nowrap">
        
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                     <div class="row">
                        <div class="col-sm-12 col-md-6">
                           <div class="dataTables_length" id="example_length">
                              <label>
                                 Show 
                                 <select name="example_length" aria-controls="example" class="form-select form-select-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                 </select>
                                 entries
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                           <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                              <thead>
                                 <tr role="row">
                                    <th>SL</th>
                                    <th>Photo</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>QTY</th>
                                    <th>Category</th>
                                    <th>Product Code</th>
                                    <th>Total Sold</th>
                                    <th>Status</th>
                                    <th>Actions</th>   
                                </tr>
                              </thead>
                              <tbody>
                                @forelse ($allProducts as $key => $item)
                                @php
                                    $cat =  App\Models\Category::findOrFail($item->cat_id);
                                @endphp
                                <tr>
                                   <td>{{$key+1}}</td>
                                   <td> <img src="{{asset($item->product_photo)}}" style="width: 70px" alt="Category" > </td>
                                   <td> {{$item->product_name}} </td>
                                   <td>{{$item->product_price}}</td>
                                   <td>{{$item->product_discount}}</td>
                                   <td>{{$item->qty}}</td>
                                   <td>{{$cat->cat_name}}</td>
                                   <td>{{$item->product_code}}</td>
                                   <td>1000</td>
                                   <td>
                                      @if($item->status == 'active' )
                                      <a href="{{route('product.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                                      @else
                                      <a href="{{route('product.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                                      @endif
                                   </td>
                                   <td>
                                      <div class="dropdown">
                                         <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                         </button>
                                         <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="{{route('product.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <form id="deleteForm" action="{{route('product.delete')}}" method="post">
                                               @csrf
                                               <input type="hidden" name="delete_id" value="{{$item->id}}">
                                               <button type="submit" class="dropdown-item" id="productdelete"><i class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                                @empty
                                <strong>No data found</strong>
                                @endforelse 
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>SL</th>
                                    <th>Photo</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>QTY</th>
                                    <th>Category</th>
                                    <th>Product Code</th>
                                    <th>Total Sold</th>
                                    <th>Status</th>
                                    <th>Actions</th>  
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </div>
                     <div class="row">
                        
                        <div class="col-sm-12 col-md-7">
                           <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                            {{$allProducts->links('vendor.pagination.custom')}}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         
      </div>
     
   </div>

</div> --}}



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#productdelete').on('click',function(){
            const userConfirmed = confirm("Are you sure you want delete it?");
            if (userConfirmed) {
                event.preventDefault(); 
            }
        })
    });
</script>
@endsection