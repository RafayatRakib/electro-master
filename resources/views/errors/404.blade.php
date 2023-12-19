@extends('frontend.master')
@section('title','404 error')
@section('content')
<div class="container">
    <div class="text-center">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="200"
        height="200"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#2B2D42"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <circle cx="12" cy="12" r="10" />
        <line x1="8" y1="8" x2="16" y2="16" />
        <line x1="8" y1="16" x2="16" y2="8" />
      </svg>
      

        <h1>404</h1>
        <h3>page not found</h3>
    </div>
</div>
@endsection