@extends('backend.master')
@section('title','Mass Mail')
@section('content')
<div class="container">
    <div class="card my-4 ">
        <div class="mx-3">

            <div class="my-2">
                <h3 class="mt-5">Send Notic or email to all user: </h3>
                <hr>
            </div>
            <form action="{{route('admin.send.mail')}}"  method="post">
                @csrf
                <div class="my-2">
                    @if (session()->get('msg'))
                    <strong class="text-danger">{{session()->get('msg')}}</strong>
                    @endif
                    <div class="my-2">
                        <label for="subject">Subject : </label>
                        <input type="text" name="subject" id="subject"  placeholder="Enter subject here..." class="form-control @error('subject') is-invalid @enderror"/>
                    </div>
                    <div class="my-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Type Email Here:</label>
                        <textarea class="form-control" name="email" id="summernote4" rows="3"></textarea>
                      </div>
                      <div class="mt-3">
                        <div class="form-check my-2">
                            <input class="form-check-input" type="checkbox" value="all_user" id="exampleCheckbox">
                            <label class="form-check-label" for="exampleCheckbox"> All user </label>
                        </div>
                        <div class="form-check my-2">
                            <input class="form-check-input" type="checkbox" value="news_letter" id="exampleCheckbox">
                            <label class="form-check-label" for="exampleCheckbox">
                              News Letter
                            </label>
                          </div>
                          <small>*Defult all user</small><br>
                      <button class="btn btn-primary">Send Mail</button>  
                      </div>
                </div>
            </form>
            
        </div>
    </div>


</div>
@endsection