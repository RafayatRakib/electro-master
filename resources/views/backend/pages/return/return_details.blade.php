@extends('backend.master')
@section('title','Return Details')
@section('content')
<style>
       /* Add this CSS to your existing styles */
   .image-container {
    display: flex;
    justify-content: space-around;
    }
    .zoom-image {
    transition: transform 0.3s ease; /* Transition effect for zoom */
    }
    /* Scale up the image on hover */
    .zoom-image:hover {
    transform: scale(5.2); /* Scale the image to 120% of its original size */
    }
</style>
    <div class="container">
        <div class="my-5">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif

            <div class="card">
                <h5 class="card-header">Return Reson</h5>
                <hr>
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-8">
                        <h3>Return Details</h3>
                        <table style="border-right: 3px solid #8592a3">
                            <tr>
                                <th> <strong>Product :</strong> </th>
                                <th> <strong> {{$product->product->product_name}}</strong> </th>
                            </tr>
    
                            <tr>
                                <th> <strong>Price :</strong> </th>
                                <th> <strong> ${{$product->price}}</strong> </th>
                            </tr>
                            <tr>
                                <th> <strong>QTY :</strong> </th>
                                <th> <strong> {{$product->qty}}</strong> </th>
                            </tr>
                            <tr>
                                <th> <strong>Discount :</strong> </th>
                                <th> <strong> ${{$product->discount}}</strong> </th>
                            </tr>
                            <tr>
                                <th> <strong>Return Reson :</strong> </th>
                                <th> <strong class=" bg-danger text-white"> {{$return->reson->return_reson}}</strong> </th>
                            </tr>

                            <tr>
                                <th> <strong>Return Details :</strong> </th>
                                <th> <strong > {{$return->user_note}}</strong> </th>
                            </tr>
                            
                            <tr>
                                <th> <strong>Damge Photo :</strong> </th>
                                <th>
                                @foreach ($images as $item)
                                    {{-- {{$item->return_images}} --}}
                                    <img class="zoom-image" style="width: 80px" src="{{ asset($item->return_images) }}" alt="">
                                {{-- <img style="width: 80px" src="{{asset($item->return_images)}}" alt="" srcset=""> --}}
                                @endforeach
                                </th>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-4">
                        <h3>User Details</h3>
                        <table>
                            <tr>
                                <th> <strong>Name :</strong> </th>
                                <th> <strong> {{$return->user->name}}</strong> </th>
                            </tr>
                            <tr>
                                <th> <strong>Email :</strong> </th>
                                <th> <a href="mailto:{{$return->order->email}}"> {{$return->order->email}}</a> </th>
                            </tr>
                            <tr>
                                <th> <strong>Phone :</strong> </th>
                                <th> <strong> {{$return->order->phone}}</strong> </th>
                                {{-- <th> <a href="phoneto:{{$return->order->phone}}"> {{$return->order->phone}}</a> </th> --}}
                            </tr>
                            <tr>
                                <th> <strong>Address:</strong> </th>
                                {{-- <th> <strong class="text-danger"> {{$order->adress.','.$order->upazila->upazila_name.','.$order->district->district_name}}</strong> </th> --}}
                                <th> <strong class="text-danger"> {{$order->address->address.','.$order->address->upazila->upazila_name.','.$order->address->district->district_name}}</strong> </th>
                            </tr>
                            <tr>
                                <th> <strong>Deliverd:</strong> </th>
                                <th> <strong> {{Carbon\Carbon::parse($order->delivered_date)->format('h : m a, d/ m /Y')}} </strong> </th>
                            </tr>
                            <tr>
                                {{-- <th><a href="{{route('return.acc',$return->id)}}" class="btn btn-primary">Accept</a></th>
                                <th><a href="" class="btn btn-danger">Reject</a></th> --}}
                                <th>

          
                                </th>
                            </tr>
                        </table>
                        {{-- {{"your return statsu would be rejected. becouse this product are ok!"}} --}}
                
                     <form action="{{route('return.acc')}}" method="post">
                        <div class="input-group mt-3">
                                @csrf
                                <textarea name="reject_comment" class="form-input" id="textarea" style="display: none;" placeholder="should be rejected. Becouse of" id="" cols="30" rows="10"></textarea>
                                <div>
                                    @error('reject_comment')
                                    <div style="color: red">{{$message}}</div>
                                @enderror
                                </div> <br>
                            <input type="hidden" name="return_id" value="{{$return->id}}">
                            <div>
                            <select class="form-select @error('return_status')is-invalid @enderror " name="return_status" >
                               <option {{$return->status =='NULL'? 'selected':''}}  disabled >Select Order Status</option>
                               <option {{$return->status =='process'? 'selected':''}} value="process">{{$return->status =='process'? '--':''}}Proccessing</option>
                               <option {{$return->status =='accept'? 'selected':''}} value="accept">{{$return->status =='accept'? '--':''}}Accept</option>
                               <option {{$return->status =='deliverd'? 'selected':''}} value="deliverd">{{$return->status =='deliverd'? '--':''}}Deliverd</option>
                               <option {{$return->status =='reject'? 'selected':''}} value="reject">{{$return->status =='reject'? '--':''}}Reject</option>
                            </select>
                        </div>
                            @error('return_status')
                                <strong class="text-danger"> {{$message}} </strong>
                            @enderror 
                            
                            <button onclick="return confirm('Are you sure to change this action?')" class="btn btn-primary" type="submit">Change</button>
                        </div>
                    </form>  
                    </div>
                   </div>
                    
                </div>
            </div>

        </div>
    </div>

    @section('script')
        <script>
        
        $(document).ready(function(){
            $('.form-select').on('change', function(event) {
                const selectedValue = $(this).val();
                if(selectedValue == 'reject'){
                    $('#textarea').show();
                }else{
                    $('#textarea').hide();
                }

            });




        });





        </script>
    @endsection


@endsection