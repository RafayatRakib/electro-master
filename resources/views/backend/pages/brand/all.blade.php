@extends('backend.master')
@section('title','Brand List')
@section('content')

    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
        @elseif(session('error'))
        <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
        @endif
        <div class="card">
            <div class="d-flex justify-content-between">

                <h5 class="card-header">Light Table head</h5>
                <div class="mt-3 mx-3">
                    <a class="btn btn-primary" href="{{route('brand.add')}}">Add Brand</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th>SL</th>
                    <th>Photo</th>
                    <th>Brand Name</th>
                    <th>Total Product</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @forelse ($brand as $key => $item)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td> <img src="{{asset($item->brand_photo)}}" style="width: 70px" alt="Brand" > </td>
                    <td> {{$item->brand_name}} </td>
                    <td>1000(after Product add then work here)</td>
                    <td>
                        @if($item->status == '1' )
                        <a href="{{route('brand.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                        @else
                        <a href="{{route('brand.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                        @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                          <a class="dropdown-item" href="{{route('brand.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <form id="deleteForm" action="{{route('brand.delete')}}" method="post">
                            @csrf
                            <input type="hidden" name="delete_id" onclick="return confirm('Are you sure to delete this data?')" value="{{$item->id}}">
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
                        <th>Brand Name</th>
                        <th>Total Product</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </footer>
              </table>

              {{$brand->links('vendor.pagination.custom')}}

              {{-- <div class="mt-5 d-flex justify-content-center">
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <li class="page-item prev">
                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">2</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="javascript:void(0);">3</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">4</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">5</a>
                  </li>
                  <li class="page-item next">
                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                  </li>
                </ul>
              </nav>
            </div> --}}
            </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#delete').on('click',function(){
                    const userConfirmed = confirm("Are you sure you want delete it?");
  
                    if (!userConfirmed) {
                        event.preventDefault(); 
                    }
                })
            });
        </script>
@endsection