{{-- //admin sidebar --}}
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
<!-- Menu -->
          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="{{route('admin.dashboard')}}" class="app-brand-link">
                {{-- <span class="app-brand-logo demo"> --}}
                 
                 @php
                     $logo = App\Models\LogonAndName::where('status','active')->first();
                 @endphp
                 {{-- <img src="{{asset($logo->logo)}}" alt=""> --}}
                  {{-- <svg
                    width="25"
                    viewBox="0 0 25 42"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                  >
                    <defs>
                      <path
                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                        id="path-1"
                      ></path>
                      <path
                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                        id="path-3"
                      ></path>
                      <path
                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                        id="path-4"
                      ></path>
                      <path
                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                        id="path-5"
                      ></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                          <g id="Mask" transform="translate(0.000000, 8.000000)">
                            <mask id="mask-2" fill="white">
                              <use xlink:href="#path-1"></use>
                            </mask>
                            <use fill="#696cff" xlink:href="#path-1"></use>
                            <g id="Path-3" mask="url(#mask-2)">
                              <use fill="#696cff" xlink:href="#path-3"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                            </g>
                            <g id="Path-4" mask="url(#mask-2)">
                              <use fill="#696cff" xlink:href="#path-4"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                            </g>
                          </g>
                          <g
                            id="Triangle"
                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                          >
                            <use fill="#696cff" xlink:href="#path-5"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg> --}}



                {{-- </span> --}}
                <span class="app-brand-text demo menu-text fw-bolder ms-2">{{strtoupper($logo->name)}}</span>
              </a>
  
              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>
  
            <div class="menu-inner-shadow"></div>
            @php
            $route = Route::currentRouteName();
            // echo "$currentRouteName";
            @endphp
            <ul class="menu-inner py-1">
              <!-- Dashboard -->
              <li class="menu-item {{($route == 'admin.dashboard')? 'active' : ' '}}">
                <a href="{{route('admin.dashboard')}}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Dashboard</div>
                </a>
              </li>
  
              <!-- Layouts -->
              {{-- category --}}
              <li class="menu-item {{($route == 'admin.cat.all' || $route == 'cat.add')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon bx bx-category"></i>
                  <div data-i18n="Layouts">Category</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.cat.all')? 'active' : ' '}} ">
                    <a href="{{route('admin.cat.all')}}" class="menu-link">
                      <div data-i18n="Without menu">All Category</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'cat.add')? 'active' : ' '}}">
                    <a href="{{route('cat.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add Category</div>
                    </a>
                  </li>
                </ul>

              </li>
              {{-- //category --}}

              {{-- brand --}}
              <li class="menu-item {{($route == 'admin.brand.all' || $route == 'brand.add')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                  <div data-i18n="Layouts">Brand</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.brand.all')? 'active' : ' '}} ">
                    <a href="{{route('admin.brand.all')}}" class="menu-link">
                      <div data-i18n="Without menu">All Brand</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'brand.add')? 'active' : ' '}}">
                    <a href="{{route('brand.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add Brand</div>
                    </a>
                  </li>
                </ul>

              </li>
              {{-- //Brand product.add--}}
  
              {{-- product --}}
              <li class="menu-item {{($route == 'admin.all.product' || $route == 'product.add')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  {{-- <i class="menu-icon tf-icons bx bx-layout"></i> --}}
                  <i class='menu-icon bx bx-book-open'></i>
                  <div data-i18n="Layouts">Product</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.all.product')? 'active' : ' '}}">
                    <a href="{{route('admin.all.product')}}" class="menu-link">
                      <div data-i18n="Without menu">All Product</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'product.add')? 'active' : ' '}}">
                    <a href="{{route('product.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add Product</div>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- end product --}}

              {{-- product marketing--}}
              <li class="menu-item {{($route == 'admin.flash.sales' || $route == 'admin.flash.sales.all')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  {{-- <i class="menu-icon tf-icons bx bx-layout"></i> --}}
                  <i class='menu-icon bx bx-store' ></i>
                  <div data-i18n="Layouts">Marketing</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.flash.sales')? 'active' : ' '}}">
                    <a href="{{route('admin.flash.sales')}}" class="menu-link">
                      <div data-i18n="Without menu">Flash Sales Add</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.flash.sales.all')? 'active' : ' '}}">
                    <a href="{{route('admin.flash.sales.all')}}" class="menu-link">
                      <div data-i18n="Without menu">Flash Sales List</div>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- end product --}}

              {{-- inventory managment start --}}
              <li class="menu-item {{($route == 'warning.stock' || $route == 'product.stock')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class='menu-icon  bx bx-package'></i>
                  <div data-i18n="Layouts">Inventory<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    99+</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'warning.stock')? 'active' : ' '}}">
                    <a href="{{route('warning.stock')}}" class="menu-link">
                      <div data-i18n="Without menu">Worning Stock <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'product.stock')? 'active' : ' '}}">
                    <a href="{{route('product.stock')}}" class="menu-link">
                      <div data-i18n="Without menu">Stock Status</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'product.add')? 'active' : ' '}}">
                    <a href="{{route('product.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Stock update Status</div>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- inventory managment end--}}

              
              {{-- coupon --}}
              <li class="menu-item {{($route == 'admin.all.coupon' || $route == 'coupon.add')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon bx bx-coin"></i>
                  <div data-i18n="Layouts">Coupon</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.all.coupon')? 'active' : ' '}}">
                    <a href="{{route('admin.all.coupon')}}" class="menu-link">
                      <div data-i18n="Without menu">All Coupon</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'coupon.add')? 'active' : ' '}}">
                    <a href="{{route('coupon.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add Coupon</div>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- end coupon --}}



              {{-- address managment --}}
              <li class="menu-item {{($route == 'admin.all.division' || $route == 'division.add' ||$route == 'admin.all.district' || $route == 'district.add' ||$route == 'admin.all.upazila' || $route == 'upazila.add')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-map-pin"></i>
                  <div data-i18n="Layouts">Address</div>
                </a>
                
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.all.division')? 'active' : ' '}}">
                    <a href="{{route('admin.all.division')}}" class="menu-link">
                      <div data-i18n="Without menu">All Division</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'division.add')? 'active' : ' '}}">
                    <a href="{{route('division.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add Division</div>
                    </a>
                  </li>
                </ul>
                {{-- ------------------------------------------------------------------------ --}}
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.all.district')? 'active' : ' '}}">
                    <a href="{{route('admin.all.district')}}" class="menu-link">
                      <div data-i18n="Without menu">All District</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'district.add')? 'active' : ' '}}">
                    <a href="{{route('district.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add District</div>
                    </a>
                  </li>
                </ul>
                {{-- ------------------------------------------------------------------------ --}}

                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'admin.all.upazila')? 'active' : ' '}}">
                    <a href="{{route('admin.all.upazila')}}" class="menu-link">
                      <div data-i18n="Without menu">All Upazila</div>
                    </a>
                  </li>
                </ul>
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'upazila.add')? 'active' : ' '}}">
                    <a href="{{route('upazila.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Add Upazila</div>
                    </a>
                  </li>
                </ul>
                {{-- ------------------------------------------------------------------------ --}}

              </li>
              {{-- address managment end --}}

               {{-- order managment --}}
               <li class="menu-item {{($route == 'all.order' || $route == 'cat.add')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon bx bx-basket"></i>
                  <div data-i18n="Layouts">Orders Managment</div>
                </a>
  
                 <ul class="menu-sub">
                  <li class="menu-item {{($route == 'all.order')? 'active' : ' '}} ">
                    <a href="{{route('all.order')}}" class="menu-link">
                      <div data-i18n="Without menu">All Orders</div>
                    </a>
                  </li>
                </ul>
                
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'cat.add')? 'active' : ' '}}">
                    <a href="{{route('cat.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Order Cancle list</div>
                    </a>
                  </li>
                </ul>

                
              </li>
              {{-- //order managment  --}}

                {{-- return managment --}}
               <li class="menu-item {{($route == 'all.return' || $route == 'return_reson')? 'active open' : ' '}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class='menu-icon bx bx-log-out-circle'></i>
                  <div data-i18n="Layouts">Return Managment</div>
                </a>
              
                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'return_reson')? 'active' : ' '}}">
                    <a href="{{route('return_reson')}}" class="menu-link">
                      <div data-i18n="Without menu">Return Reson</div>
                    </a>
                  </li>
                </ul>

                <ul class="menu-sub">
                  <li class="menu-item {{($route == 'all.return')? 'active' : ' '}}">
                    <a href="{{route('all.return')}}" class="menu-link">
                      <div data-i18n="Without menu">Return item</div>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- //return managment  --}}


              {{-- setting managment --}}
               <li class="menu-item {{($route == 'admin.setting' || $route == 'cat.add')? 'active open' : ' '}}">
               
                <a href="{{route('admin.setting')}}" class="menu-link">
                  <i class='menu-icon bx bx-cog'></i>
                  <div data-i18n="Layouts">Settings</div>
                  </a>
              
                {{-- <ul class="menu-sub">
                  <li class="menu-item {{($route == 'cat.add')? 'active' : ' '}}">
                    <a href="{{route('cat.add')}}" class="menu-link">
                      <div data-i18n="Without menu">Return item</div>
                    </a>
                  </li>
                </ul> --}}
              </li>
         {{-- //setting managment --}}



            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pages</span>
            </li>

            
                {{-- Page managment --}}
                <li class="menu-item {{($route == 'admin.all.page' || $route == 'admin.add.page')? 'active open' : ' '}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-book'></i>
                    <div data-i18n="Layouts">Page Managment</div>
                  </a>
                
                  <ul class="menu-sub">
                    <li class="menu-item {{($route == 'admin.add.page')? 'active' : ' '}}">
                      <a href="{{route('admin.add.page')}}" class="menu-link">
                        <div data-i18n="Without menu">Create Page</div>
                      </a>
                    </li>
                  </ul>
  
                  <ul class="menu-sub">
                    <li class="menu-item {{($route == 'admin.all.page')? 'active' : ' '}}">
                      <a href="{{route('admin.all.page')}}" class="menu-link">
                        <div data-i18n="Without menu">All Pages</div>
                      </a>
                    </li>
                  </ul>
                </li>
                {{-- //page managment end --}}

              {{-- gallery managment start--}}
                <li class="menu-item {{($route == 'admin.all.image' || $route == 'admin.add.image')? 'active open' : ' '}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-image'></i>
                    <div data-i18n="Layouts">Gallery</div>
                  </a>
                
                  <ul class="menu-sub">
                    <li class="menu-item {{($route == 'admin.add.image')? 'active' : ' '}}">
                      <a href="{{route('admin.add.image')}}" class="menu-link">
                        <div data-i18n="Without menu">Add Images</div>
                      </a>
                    </li>
                  </ul>
  
                  <ul class="menu-sub">
                    <li class="menu-item {{($route == 'admin.all.image')? 'active' : ' '}}">
                      <a href="{{route('admin.all.image')}}" class="menu-link">
                        <div data-i18n="Without menu">All Images</div>
                      </a>
                    </li>
                  </ul>
                </li>
              {{-- //gallery managment end  --}}

              {{-- gallery managment start--}}
                <li class="menu-item {{($route == 'admin.mail' || $route == 'admin.send.mail')? 'active open' : ' '}}">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bx-mail-send'></i>
                    <div data-i18n="Layouts">Mail</div>
                  </a>
                
                  <ul class="menu-sub">
                    <li class="menu-item {{($route == 'admin.mail')? 'active' : ' '}}">
                      <a href="{{route('admin.mail')}}" class="menu-link">
                        <div data-i18n="Without menu">Send Mail</div>
                      </a>
                    </li>
                  </ul>
                  
                  <ul class="menu-sub">
                    <li class="menu-item {{($route == 'admin.all.image')? 'active' : ' '}}">
                      <a href="{{route('admin.all.image')}}" class="menu-link">
                        <div data-i18n="Without menu">Get Mail</div>
                      </a>
                    </li>
                  </ul>
                </li>
              {{-- //gallery managment end  --}}


              












                      
          {{-- employ mgt system --}}
          {{-- <li class="menu-item {{($route == 'active.employer' || $route == 'add.employer' || $route == 'role.employer' || $route == 'all.employer')? 'active open' : ' '}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class='menu-icon bx bx-street-view'></i>
              <div data-i18n="Layouts">Employ Managment</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item {{($route == 'role.employer')? 'active' : ' '}} ">
                <a href="{{route('role.employer')}}" class="menu-link">
                  <div data-i18n="Without menu">Employer Role</div>
                </a>
              </li>
            </ul>


             <ul class="menu-sub">
              <li class="menu-item {{($route == 'active.employer')? 'active' : ' '}} ">
                <a href="{{route('active.employer')}}" class="menu-link">
                  <div data-i18n="Without menu">Active Employ</div>
                </a>
              </li>
            </ul>

            <ul class="menu-sub">
              <li class="menu-item {{($route == 'add.employer')? 'active' : ' '}}">
                <a href="{{route('add.employer')}}" class="menu-link">
                  <div data-i18n="Without menu">Add Employ</div>
                </a>
              </li>
            </ul>

            <ul class="menu-sub">
              <li class="menu-item {{($route == 'all.employer')? 'active' : ' '}} ">
                <a href="{{route('all.employer')}}" class="menu-link">
                  <div data-i18n="Without menu">All Employ</div>
                </a>
              </li>
            </ul>
            
          </li> --}}
{{-- employ mgt system end--}}


































  
              <!-- Forms & Tables -->
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
              <!-- Forms -->
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-detail"></i>
                  <div data-i18n="Form Elements">Form Elements</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="forms-basic-inputs.html" class="menu-link">
                      <div data-i18n="Basic Inputs">Basic Inputs</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="forms-input-groups.html" class="menu-link">
                      <div data-i18n="Input groups">Input groups</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-detail"></i>
                  <div data-i18n="Form Layouts">Form Layouts</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="form-layouts-vertical.html" class="menu-link">
                      <div data-i18n="Vertical Form">Vertical Form</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="form-layouts-horizontal.html" class="menu-link">
                      <div data-i18n="Horizontal Form">Horizontal Form</div>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Tables -->
              <li class="menu-item">
                <a href="tables-basic.html" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">Tables</div>
                </a>
              </li>
              <!-- Misc -->
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
              <li class="menu-item">
                <a
                  href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                  target="_blank"
                  class="menu-link"
                >
                  <i class="menu-icon tf-icons bx bx-support"></i>
                  <div data-i18n="Support">Support</div>
                </a>
              </li>
              <li class="menu-item">
                <a
                  href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                  target="_blank"
                  class="menu-link"
                >
                  <i class="menu-icon tf-icons bx bx-file"></i>
                  <div data-i18n="Documentation">Documentation</div>
                </a>
              </li>
            </ul>
          </aside>
          <!-- / Menu -->
  