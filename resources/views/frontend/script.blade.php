
@extends('frontend.master')
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addtocart(){
        alert('I am from cart');
    }//end metod 





</script>
@endsection