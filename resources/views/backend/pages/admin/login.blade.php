@include('backend.src.header')
@section('title','Admin Login')
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register -->
            
            <div class="card" style="width: 40%;  margin:auto" class=" justify-content-center">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                  <a href="{{url('/')}}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img src="{{asset('backend/uploads/logo/logo.png')}}" alt="" srcset="">
                    </span>
                    @php
                      $logo = App\Models\LogonAndName::where('status','active')->first();
                    @endphp
                    <span class="app-brand-text demo text-body fw-bolder">{{$logo->name}}</span>
                    <img src="{{asset($logo->logo)}}" alt="" srcset="">
                  </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Welcome to Admin Login panale</h4>
                <p class="mb-4">Please sign-in and see whats happend wating for you</p>
                {{-- @if (session()->has("error"))

                <div class="alert alert-danger" role="alert">{{session('error')}}</div>           
                @endif --}}
                <x-input-error  :messages="$errors->get('email')" class="mt-2" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />


                <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
                    @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      name="email"
                      placeholder="Enter your email"
                      autofocus
                    />
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Password</label>
                      
                    </div>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                  </div>
                </form>

              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
      </div>
  
      <!-- / Content -->
  
      @include('backend.src.footer')

  
