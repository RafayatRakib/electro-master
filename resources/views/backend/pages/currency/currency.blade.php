@extends('backend.master')
@section('title','Currency')
@section('content')
<div class="container">
    <div class="my-5">
        <h3>Add Currency</h3>
        @if(session('success'))
        <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
        @elseif(session('error'))
        <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
        @endif
        <div class="card">
            <div class="p-3">
            <form action="{{route('currency.store')}}" method="post">
                @csrf
                <div class="my-3">
                    <label for="defaultFormControlInput" class="form-label">Currency Name</label>
                    <input type="text" name="currency" id="currency" class="form-control @error('currency')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex: USD, BDT, IN etc" aria-describedby="defaultFormControlHelp">
                    @error('currency') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                </div>
                <div class="my-3">
                    <label for="defaultFormControlInput" class="form-label">Currency Symbol <b class="text-danger">(Hex code)</b> </label>
                    <input type="text" name="currency_symbol" id="currency_symbol" class="form-control @error('currency_symbol')is-invalid @enderror" id="defaultFormControlInput" placeholder="Ex:    &amp;#x24;" aria-describedby="defaultFormControlHelp">
                    @error('currency_symbol') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                </div>
                <button class="btn btn-primary">Add</button>
            </form>
        </div>

        </div>
        <div class="card my-5">
            <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-light">
                    <tr>
                      <th>SL</th>
                      <th>Currency</th>
                      <th>Currency Symbol</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
  
                      @forelse ($currency as $key => $item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->currency}}</td>
                      <td>
                         
                        <p>Symbol: <strong style="font-size: 30px">{!! $item->currency_symbol!!}</strong></p> 
                        <p>Code: {{$item->currency_symbol}}</p> 
                    </td>
                      <td>
                          @if($item->status == 'active' )
                          <a href="{{route('cat.status',$item->id)}}" class="badge bg-label-danger me-1">Deactiv it</a>
                          @else
                          <a href="{{route('cat.status',$item->id)}}" class="badge bg-label-success me-1">Active it</a>
                          @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="{{route('currency.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <form id="deleteForm" action="{{route('currency.delete',$item->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="delete_id" value="{{$item->id}}">
                            <button onclick="return confirm('Are you sure to delete it?')" type="submit" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
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
                        <th>Currency</th>
                        <th>Currency Symbol</th>
                        <th>Status</th>
                        <th>Actions</th>  
                      </tr>
                  </footer>
                </table>
  
                {{-- {{$cat->links('vendor.pagination.custom')}} --}}
  
  
              </div>
        </div>
    </div>
</div>
    
@endsection