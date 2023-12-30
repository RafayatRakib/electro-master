@extends('frontend.master')
@section('title',$page->title)
@section('content')
<div class="container">
    @if (Auth::check() && Auth::user()->role === 'admin')
        <a class="btn mb-3" href="{{route('page.edit',$page->id)}}">Edit this page</a>
    {{-- <hr style="border-bottom: 2px solid black" /> --}}
    <div style="border:1px solid black; padding:5px; margin-top: 15px" >
        {!!$page->content!!}
    </div>     
    @else
         {!!$page->content!!}    
    @endif
    
</div>



{{-- @if (Auth::check() && Auth::user()->role == 'admin')
<a  class="btn mb-3" href="{{ route('page.edit', $page->id) }}">Edit this page</a>
<div style="border:1px solid black;"></div>
@endif

<div {{ Auth::check() && Auth::user()->role == 'admin'? 'style="border:1px solid black; padding:5px; margin-top: 15px"' : ' '  }} >
{!!$page->content!!}
</div> --}}
@endsection