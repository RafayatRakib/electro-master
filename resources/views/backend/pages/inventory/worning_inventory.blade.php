@extends('backend.master')
@section("title", "Product Stock")
@section('content')
    <div class="container">
        <div class="my-5">
            <h1>Stock Worning</h1>
            <div class="card">
                <div class="table-responsive ">
                    <table class="table">
                      <thead class="table-light">
                        <tr>
                          <th>SL</th>
                          <th>Photo</th>
                          <th>Product</th>
                          <th>Current Stock</th>
                          <th>All time Stock</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
      
                          @foreach($product as $key => $item)
                          
                        <tr class="{{ ($item->qty < $item->qty_warning) ? 'text-danger' : '' }}">
                          <td>{{$key+1}}</td>
                          <td> <img src="{{asset($item->product_photo)}}" style="width: 50px" alt="Brand" > </td>
                          <td>  {{$item->product_name}} </td>
                          
                          <td> {{$item->qty}} </td>
                              
                          @php
                              $alltimestock = App\Models\Inventory::where('product_id',$item->id)->sum('qty');
                          @endphp
                          <td> {{$alltimestock}} </td>
                            <td><strong class="{{$item->status? 'badge bg-label-success me-1' : 'badge bg-label-danger me-1'}}">{{$item->status}}</strong></td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="{{route('product.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="{{route('stock.details',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Details</a>
                                
                              </div>
                            </div>
                          </td>
                        </tr>
                       
                        @endforeach
                      </tbody>
                      <footer class="table-light">
                          <tr>
                            <th>SL</th>
                            <th>Photo</th>
                            <th>Product</th>
                            <th>Current Stock</th>
                            <th>All time Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                      </footer>
                    </table>
      
                    {{$product->links('vendor.pagination.custom')}}
      
                    
                  </div>
            </div>
        </div>
    </div>
@endsection