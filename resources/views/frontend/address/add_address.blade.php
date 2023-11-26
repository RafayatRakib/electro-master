@extends('frontend.master')
@php
$site = App\Models\LogonAndName::where('status','active')->first();
@endphp
@section('title',$site->name.' - Add Address')
@section('content')

<!-- Billing Details -->
<div class="billing-details">
    <div class="section-title">
        <h3 class="title">Add address</h3>
    </div>
    <div class="row">
        <form action="{{route('add.address')}}" method="post">
            @csrf
        <div class="col-md-6">
            <div class="form-group">
                <input class="input" type="text" @error('name') style="color: #D10024" @enderror name="name" placeholder="First Name">
                @error('name')<div style="color: #D10024"> {{$message}} </div>@enderror
            </div>
            <div class="form-group">
                <input class="input" @error('mobile_number') style="color: #D10024" @enderror type="mobile_number" min="1" name="mobile_number" placeholder="Input Mobile Number">
                @error('mobile_number')<div style="color: #D10024"> {{$message}} </div>@enderror

            </div>
            <div class="form-group">
                <input class="input" @error('address') style="color: #D10024" @enderror type="text" name="address" placeholder="House No/ Building/ Street / area">
                @error('address')<div style="color: #D10024"> {{$message}} </div>@enderror
                
            </div>

            <div class="form-group">
                <select  class="input"  name="address_lable" id="address_lable" >
                    <option selected disabled>Select Address Label (optional)</option>
                    <option value="home">Home</option>
                    <option value="office">Office</option>
                    <option value="others">Others</option>
                </select>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select  class="input" @error('division') style="color: #D10024" @enderror name="division" id="division" >
                    <option selected disabled>Select Division</option>
                    @forelse ($division as $item)
                        <option value="{{$item->id}}"> {{$item->division_name}} </option>
                    @empty
                        <option> No data found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <select disabled class="input" @error('district') style="color: #D10024" @enderror name="district" id="district" >
                    <option selected disabled>Select District</option>

                </select>
            </div>
            <div class="form-group">
                <select disabled class="input" @error('upazila') style="color: #D10024" @enderror name="upazila" id="upazila" >
                    <option selected disabled>Upazila</option>
                </select>
            </div>
            <button type="submit" class="checkout-btn">Save</button>
        </div>
    </form>
    </div>


</div>
<!-- /Billing Details -->

@section('script')
    <script>
        //get district
        $('#division').change(function(){
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url:'/getDistrict/' + id,
                success:function(data){

                var district = '<option selected disabled>Select District</option>';
                $.each(data.district, function (index, item) {
                    district += `<option value="${item.id}">${item.district_name}</option>`;
                });
                $('#district').html(district);
                $('#district').prop('disabled', false);
                }
            });
        })
        //end district

        //get upazila
        $('#district').change(function(){
            let id = $(this).val();
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url:'/getUpazila/' + id,
                success:function(data){
                    // console.log(data.upazila);
                    let upazila = `<option selected disabled>Select Upazila</option>`;
                    $.each(data.upazila,function(index,item){
                        upazila += `<option value="${item.id}">${item.upazila_name}</option>`;
                    })
                    $('#upazila').html(upazila);
                    $('#upazila').prop('disabled', false);
                    
                }
            })
        });
        //end upazila

    </script>
@endsection

@endsection