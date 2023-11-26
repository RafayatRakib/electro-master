
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		 <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick.css')}}"/>
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>
 		{{-- <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/> --}}

		 {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}


    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
                        @php
                            $contact = App\Models\ContactAndSocial::where('status', 'active')->first();
                        @endphp
						<li><a><i class="fa fa-phone"></i> {{$contact->phone_one}} </a></li>
						<li><a href="mailto:{{$contact->email_one}}"><i class="fa fa-envelope-o"></i>{{$contact->email_one}} </a></li>
						<li><a target="__blank" href="{{$contact->map_link}}"><i class="fa fa-map-marker"></i> {{$contact->address}}</a></li>
					</ul>
					<ul class="header-links pull-right">
                        @php
                            $currency = App\Models\Currency::where('status','active')->get();
                        @endphp
                        @foreach ($currency as $item)
						<li><a href="#"> {!! $item->currency_symbol !!} {{$item->currency}} </a></li>
                        @endforeach
						{{-- {{Auth::user()->name}} --}}
						@if (Auth::user())
						<li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard </a></li>							
						<li>
							<form action="{{route('logout')}}" method="post">
								@csrf
								<button type="submit" class="btn"><i class="fa fa-sign-out" style="color: white"></i>Logout</button>
							</form>
							{{-- <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Logout</a> --}}
						</li>							
						@else
						<li><a href="{{route('userLogin')}}"><i class="fa fa-user-o"></i>Login</a></li>
						<li><a href="{{route('userRegistration')}}"><i class="fa fa-user-plus"></i>Register</a></li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
                                @php
                                    $logo =  App\Models\LogonAndName::where('status','active')->first();
                                @endphp
								<a href="{{route('home')}}" class="logo">
									<img src="{{asset($logo->logo)}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select" style="width: 150px">
										<option value="0">All Categories</option>
                                        @php
                                            $cat =  App\Models\Category::where('status','1')->get();
                                        @endphp
                                        @foreach ($cat as $item)
										<option  value="{{$item->id}}">{{$item->cat_name}}</option>
                                        @endforeach
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<div class="dropdown">
									@php
										$cart = App\Models\Cart::where('user_id',Auth::id())->count();
									@endphp
									<a href="{{route('mycart')}}">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{$cart}}</div>
									</a>
								</div>

								<!-- Cart -->
								{{-- <div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div> --}}
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						@php
							$cat = App\Models\Category::where('status', 1)->inRandomOrder()->limit(6)->get();
						@endphp
						<li class="active"><a href="#">Home</a></li>
						@foreach ($cat as $item)
						<li><a href="{{route('cat_wise.product',$item->cat_slug)}}"> {{$item->cat_name}} </a></li>
						@endforeach
						
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		{{-- <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Regular Page</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Blank</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB --> --}}

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">

                @yield('content')
                    {{-- <h1>Hello mother fucker</h1> --}}
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>

							<ul class="newsletter-follow">
                                @if ($contact->facebook_url)
								<li>
                                    <a  target="__blank" href="{{$contact->facebook_url}}"><i class="fa fa-facebook"></i></a>
                                </li>
                                @endif
                                @if ($contact->twitter_url)
								<li>
                                    <a target="__blank" href="{{$contact->twitter_url}}"><i class="fa fa-twitter"></i></a>
								</li>
                                @endif
                                @if ($contact->instagram_url)
								<li>
									<a target="__blank" href="{{$contact->instagram_url}}"><i class="fa fa-instagram"></i></a>
								</li>
                                @endif
                                @if ($contact->youtube_url)
								<li>
									<a target="__blank" href="{{$contact->youtube_url}}"><i class="fa fa-youtube"></i></a>
								</li>
                                @endif
                                
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a target="__blank" href="{{$contact->map_link}}"><i class="fa fa-map-marker"></i>{{$contact->address}}</a></li>
									<li><a><i class="fa fa-phone"></i>{{$contact->phone_one? $contact->phone_one : ' '}}</a> <a >{{$contact->phone_two? 'or, '.$contact->phone_two : ' '  }}</a></li>
									<li><a href="mailto:{{$contact->email_two}}"><i class="fa fa-envelope-o"></i>{{$contact->email_one}}</a><br>
                                    <a style="margin-left: 30px" href="mailto:{{','.$contact->email_two}}">{{$contact->email_two}}</a>
                                    </li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>



						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
		<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('frontend/js/slick.min.js')}}"></script>
		<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
		<script src="{{asset('frontend/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('frontend/js/main.js')}}"></script>
		{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
 
		<script>
			(function (window, document) {
				var loader = function () {
					var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
					script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
					tag.parentNode.insertBefore(script, tag);
				};
		
				window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
			})(window, document);
		</script>
		
		@yield('script')

	</body>
</html>
