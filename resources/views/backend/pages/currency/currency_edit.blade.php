@extends('backend.master')
@section('title','Currency Edit')
@section('content')
<div class="container">
    <div class="my-5">
        <div class="d-flex justify-content-between">
            <h3>Currency Edit</h3>
            <div class="p-3">
                <a class="btn btn-dark" href="{{route('currency')}}">All Currency</a>
            </div>
        </div>
        <div class="card">
            <div class="p-3">
            <form action="{{route('currency.update')}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="currency_id" value="{{$currency->id}}">
                <div class="my-3">
                    <label for="defaultFormControlInput" class="form-label">Currency Name</label>
                    <input type="text" name="currency" id="currency" class="form-control @error('currency')is-invalid @enderror" id="defaultFormControlInput" value="{{$currency->currency}}" placeholder="Ex: USD, BDT, IN etc" aria-describedby="defaultFormControlHelp">
                    @error('currency') <strong class="text-danger">{{$message}}</strong> @enderror 
                </div>
                <div class="my-3">
                    <label for="defaultFormControlInput" class="form-label">Currency Symbol <b class="text-danger">(Hex code)</b> </label>
                    <input type="text" name="currency_symbol" id="currency_symbol" class="form-control @error('currency_symbol')is-invalid @enderror" id="defaultFormControlInput" value="{{$currency->currency_symbol}}"placeholder="Ex:    &amp;#x24;" aria-describedby="defaultFormControlHelp">
                    @error('currency_symbol') <strong class="text-danger">{{$message}}</strong> @enderror <br>
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>    
@endsection