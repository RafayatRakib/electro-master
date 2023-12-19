@extends('frontend.master')
@section('title',$page->title)
@section('content')
<div class="container">
    {!!$page->content!!}
</div>
@endsection