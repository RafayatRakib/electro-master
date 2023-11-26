@extends('backend.master')
@section("title",'Edit Contact and Social')
@section("content")
<div class="container">
    <div class="my-5">
        <form action="{{route('socialContact.update')}}" method="post">
            @csrf
            <input type="hidden" name="contact_id" value="{{$contact->id}}">
            <div class="card">
               <div class="card-header bg-dark">
                   <div class="d-flex justify-content-between">
                       <h2>Address</h2>
                       <a href="{{route('all.socialandcontact')}}" class="btn btn-primary text-white">All Contact</a>
                   </div>
               </div>
               <div class="card-body">
                  <div class="my-3">
                     <label for="site name" class="form-label">Address</label>
                     <textarea name="address" class="form-control @error('address')is-invalid @enderror" id="" cols="30" rows="2"  placeholder="Thana Road, Sonargaon, Narayangonj" >{{$contact->address}}</textarea>
                     @error('address')
                     <div class="text-danger">{{$message}}</div>
                     @enderror
                  </div>
                  <div class="my-3">
                   <label for="site name" class="form-label">Map Link (Optional)</label>
                   <input name="map_link" class="form-control @error('address')is-invalid @enderror" value="{{$contact->map_link}}" placeholder="eg: https://maps.app.goo.gl/ANBPa6KkW1pDxPrN6">
                   @error('map_link')
                   <div class="text-danger">{{$message}}</div>
                   @enderror
                </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="my-3">
                           <label for="site name" class="form-label">Phone(1)</label>
                           <input type="text" name="phone_1" class="form-control @error('phone_1')is-invalid @enderror" id="site_name" placeholder="ex: +021-95-51-84" value="{{$contact->phone_one}}">
                           @error('phone_1')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                        <div class="my-3">
                           <label for="logo" class="form-label">Email(1)</label>
                           <input type="email" name="email_1" class="form-control @error('email_1')is-invalid @enderror" placeholder="ex: abc@info.com" value="{{$contact->email_one}}">
                           @error('email_1')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="my-3">
                           <label for="site name" class="form-label">Phone(Optional)</label>
                           <input type="text" name="phone_2" class="form-control @error('phone_2')is-invalid @enderror" id="site_name" placeholder="ex: Electro Master" value="{{$contact->phone_two}}" >
                           @error('phone_2')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                        <div class="my-3">
                           <label for="logo" class="form-label">Email(Optional)</label>
                           <input type="email" name="email_2" class="form-control @error('email_2')is-invalid @enderror" placeholder="ex: xyx@info.com" value="{{$contact->email_two}}">
                           @error('email_2')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
            </div>
   
            {{--scoical option start--}}
            <div class="card my-5">
               <div class="card-header bg-dark">
                  <h2>Social</h2>
               </div>
               <div class="card-body">
   
                  <div class="row">
                     <div class="col-md-6">
                        <div class="my-3">
                           <label for="site name" class="form-label">Facebook (optional)</label>
                           <input type="text" name="facebook" class="form-control @error('facebook')is-invalid @enderror"  placeholder="ex: https://www.facebook.com/" value="{{$contact->facebook_url}}">
                           @error('facebook')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                        <div class="my-3">
                           <label for="logo" class="form-label">youtube (optional)</label>
                           <input type="text" name="youtube" class="form-control @error('youtube')is-invalid @enderror" placeholder="ex: https://www.youtube.com/" value="{{$contact->youtube_url}}">
                           @error('youtube')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="my-3">
                           <label for="site name" class="form-label">Twitter (optional)</label>
                           <input type="text" name="twitter" class="form-control @error('twitter')is-invalid @enderror"  placeholder="ex: https://www.twitter.com/" value="{{$contact->twitter_url}}">
                           @error('twitter')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                        <div class="my-3">
                           <label for="logo" class="form-label">Instagram (optional)</label>
                           <input type="text" name="instagram" class="form-control @error('instagram')is-invalid @enderror" placeholder="ex: https://www.instagram.com/" value="{{$contact->instagram_url}}">
                           @error('instagram')
                           <div class="text-danger">{{$message}}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
            </div>
   
            <button class="btn btn-primary">Update</button>
         </form>
    </div>
</div>
@endsection