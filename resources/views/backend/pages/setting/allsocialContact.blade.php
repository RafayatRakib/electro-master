@extends('backend.master')
@section('title','All Contact and Socical link')
@section('content')
    <div class="container">
        <div class="my-5">
            <div class="d-flex justify-content-between">

                <h2 class="">All Contact and Social Link</h2> 
                <a class="btn btn-primary" href="{{route('admin.setting')}}">settings</a>
            </div>
            @if(session('success'))
            <div class="alert alert-primary" role="alert">{{session('success')}}</div>            
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
            @endif
            <div class="row">
                @foreach ($contact as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <table >
                                <tr>
                                    <th>Address:</th>
                                    <th>{{$item->address??'--'}}</th>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <th>{{$item->phone_one??'--'}}</th>
                                </tr>
                                <tr>
                                    <th>Phone Two:</th>
                                    <th>{{$item->phone_two??'--'}}</th>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <th><a href="mailto:{{$item->email_one}}">{{$item->email_one??'--'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Email two:</th>
                                    <th><a mailto="mailto:{{$item->email_two}}">{{$item->email_two??'--'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Facebook:</th>
                                    <th><a href="{{$item->facebook_url}}" target="_blank">{{$item->facebook_url??'--'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Twitter:</th>
                                    <th><a href="{{$item->twitter_url}}" target="_blank">{{$item->twitter_url??'--'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Instagram:</th>
                                    <th><a href="{{$item->instagram_url}}" target="_blank">{{$item->instagram_url??'--'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Youtube:</th>
                                    <th><a target="_blank" href="{{$item->youtube_url}}">{{$item->youtube_url??'--'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <th > <strong>{{$item->status}}</strong> <a class="{{$item->status=='active'?'badge bg-danger':'badge bg-primary'}}" href="{{route('contact_status',$item->id)}}">{{$item->status=='active'?'inactive it' :'active it'}}</a></th>
                                </tr>
                                <tr>
                                    <th>Action:</th>
                                    <th class="d-flex ">
                                        <a onclick="return confirm('Are you sure to delete it?')" href="{{route('socialContact.edit',$item->id)}}" class="btn-sm btn-success mx-1">Edit</a>
                                        <form action="{{route('contact_delete')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="deleted_id" value="{{$item->id}}">
                                            <button onclick="return confirm('Are you sure to delete it?')" type="submit"  class="btn-sm btn-danger">Delete</button>
                                        </form>
                                    </th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection