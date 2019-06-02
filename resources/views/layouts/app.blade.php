<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="shortcut icon" href="{{ asset('/images/logo/Minda.jpg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/azia.css') }}" rel="stylesheet">
</head>
<body class="az-body az-body-sidebar">

        <div class="az-sidebar">
          <div class="az-sidebar-header">
            <a href="{{ url('/') }}" class="az-logo">
                <div class="pr-2"><img src="{{ asset('images/logo/Minda.jpg') }}" style="height:50px;"></div>
                <div>MDSHHRM</div>
            </a>
          </div><!-- az-sidebar-header -->
          <div class="az-sidebar-loggedin">
            <div class="az-img-user online"><img src="{{ asset('images/photos/image.gif') }}" alt=""></div>
            <div class="media-body">
              <h6>{{ auth()->user()->full_name }}</h6>
              <span>Premium Member</span>
            </div><!-- media-body -->
          </div><!-- az-sidebar-loggedin -->
          <div class="az-sidebar-body">
            <ul class="nav">
              <li class="nav-label">Main Menu</li>
              <li class="nav-item {{ Request::path() == 'home' ? 'active' : '' }}">
                  {{-- <li>with-sub</li> --}}
                <a href="{{ route('home') }}" class="nav-link"><i class="typcn typcn-clipboard"></i>Home</a>
                {{-- <ul class="nav-sub">
                  <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                </ul> --}}
              </li><!-- nav-item -->
              <li class="nav-item  {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active show' : '' }}">
                  {{-- <li>with-sub</li> --}}
                <a href="{{ route('home') }}" class="nav-link with-sub"><i class="typcn typcn-clipboard"></i>User</a>
                <ul class="nav-sub">
                  <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                  <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                </ul>
              </li><!-- nav-item -->
              <li class="nav-item  {{ Request::path() == 'positions' || Request::path() == 'position/create' ? 'active show' : '' }}">
                  {{-- <li>with-sub</li> --}}
                <a href="{{ route('position.index') }}" class="nav-link"><i class="typcn typcn-clipboard"></i>Positions</a>
                {{-- <ul class="nav-sub">
                  <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                  <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                </ul> --}}
              </li><!-- nav-item -->
            </ul><!-- nav -->
          </div><!-- az-sidebar-body -->
        </div><!-- az-sidebar -->

        <div class="az-content az-content-dashboard-two">
          <div class="az-header">
            <div class="container-fluid">
              <div class="az-header-left">
                    <div class="pt-2"><h4>Mindalano Specialist Hospital Human Resource Management</h4></div>
              </div><!-- az-header-left -->
              <div class="az-header-right">
                <div class="dropdown az-profile-menu">
                  <a href="" class="az-img-user"><img src="{{ asset('images/photos/image.gif') }}" alt=""></a>
                  <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                      <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                      <div class="az-img-user">
                        <img src="{{ asset('images/photos/image.gif') }}" alt="">
                      </div><!-- az-img-user -->
                      <h6>{{ auth()->user()->full_name }}</h6>
                      <span>Premium Member</span>
                    </div><!-- az-header-profile -->

                    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="typcn typcn-power-outline"></i>{{ __('Signout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div><!-- dropdown-menu -->
                </div>
              </div><!-- az-header-right -->
            </div><!-- container -->
          </div><!-- az-header -->
          <div class="az-content-header d-block d-md-flex">
            <div>
              <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">@yield('title')</h2>
            </div>
            <div class="az-dashboard-header-right">
              {{-- <div>
                <label class="tx-13">All Sales (Offline)</label>
                <h5>932,210</h5>
              </div> --}}
            </div><!-- az-dashboard-header-right -->
          </div><!-- az-content-header -->
          <div class="az-content-body">
            @yield('content')
          </div><!-- az-content-body -->
          <div class="az-footer ht-40">
            <div class="container-fluid pd-t-0-f ht-100p">
              <span>&copy; 2019 Developed by <a href="https://www.linkedin.com/in/LonerJey"><b>LonerJey</b></a></span>
              <div class="ml-auto">
                Mindalano Specialist Hospital Foundation, Inc., Panggao Saduc, Marawi City
              </div>
            <div>

            </div>
            </div><!-- container -->
          </div><!-- az-footer -->
        </div><!-- az-content -->


        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('js/responsive.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/ionicons.js') }}"></script>
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('js/raphael.min.js') }}"></script>
        <script src="{{ asset('js/morris.min.js') }}"></script>
        <script src="{{ asset('js/jquery.vmap.min.js') }}"></script>

        <script src="{{ asset('js/azia.js') }}"></script>
        <script>
          $(function(){
            'use strict'

            $('.az-sidebar .with-sub').on('click', function(e){
              e.preventDefault();
              $(this).parent().toggleClass('show');
              $(this).parent().siblings().removeClass('show');
            })

            $(document).on('click touchstart', function(e){
              e.stopPropagation();

              // closing of sidebar menu when clicking outside of it
              if(!$(e.target).closest('.az-header-menu-icon').length) {
                var sidebarTarg = $(e.target).closest('.az-sidebar').length;
                if(!sidebarTarg) {
                  $('body').removeClass('az-sidebar-show');
                }
              }
            });


            $('#azSidebarToggle').on('click', function(e){
              e.preventDefault();

              if(window.matchMedia('(min-width: 992px)').matches) {
                $('body').toggleClass('az-sidebar-hide');
              } else {
                $('body').toggleClass('az-sidebar-show');
              }
            })

            /* ----------------------------------- */
            /* Dashboard content */

            $('#compositeline').sparkline('html', {
              lineColor: '#cecece',
              lineWidth: 2,
              spotColor: false,
              minSpotColor: false,
              maxSpotColor: false,
              highlightSpotColor: null,
              highlightLineColor: null,
              fillColor: '#f9f9f9',
              chartRangeMin: 0,
              chartRangeMax: 10,
              width: '100%',
              height: 20,
              disableTooltips: true
            });

            $('#compositeline2').sparkline('html', {
              lineColor: '#cecece',
              lineWidth: 2,
              spotColor: false,
              minSpotColor: false,
              maxSpotColor: false,
              highlightSpotColor: null,
              highlightLineColor: null,
              fillColor: '#f9f9f9',
              chartRangeMin: 0,
              chartRangeMax: 10,
              width: '100%',
              height: 20,
              disableTooltips: true
            });

            $('#compositeline3').sparkline('html', {
              lineColor: '#cecece',
              lineWidth: 2,
              spotColor: false,
              minSpotColor: false,
              maxSpotColor: false,
              highlightSpotColor: null,
              highlightLineColor: null,
              fillColor: '#f9f9f9',
              chartRangeMin: 0,
              chartRangeMax: 10,
              width: '100%',
              height: 20,
              disableTooltips: true
            });

            $('#compositeline4').sparkline('html', {
              lineColor: '#cecece',
              lineWidth: 2,
              spotColor: false,
              minSpotColor: false,
              maxSpotColor: false,
              highlightSpotColor: null,
              highlightLineColor: null,
              fillColor: '#f9f9f9',
              chartRangeMin: 0,
              chartRangeMax: 10,
              width: '100%',
              height: 20,
              disableTooltips: true
            });


            var morrisData = [
              { y: 'Oct 01', a: 95000, b: 70000 },
              { y: 'Oct 05', a: 75000,  b: 55000 },
              { y: 'Oct 10', a: 50000,  b: 40000 },
              { y: 'Oct 15', a: 75000,  b: 65000 },
              { y: 'Oct 20', a: 50000,  b: 40000 },
              { y: 'Oct 25', a: 80000, b: 90000 },
              { y: 'Oct 30', a: 75000,  b: 65000 }
            ];

            new Morris.Bar({
              element: 'morrisBar1',
              data: morrisData,
              xkey: 'y',
              ykeys: ['a', 'b'],
              labels: ['Online', 'Offline'],
              barColors: ['#560bd0', '#00cccc'],
              preUnits: '$',
              barSizeRatio: 0.55,
              gridTextSize: 11,
              gridTextColor: '#494c57',
              gridTextWeight: 'bold',
              gridLineColor: '#999',
              gridStrokeWidth: 0.25,
              hideHover: 'auto',
              resize: true,
              padding: 5
            });

            // $('#vmap2').vectorMap({
            //   map: 'usa_en',
            //   showTooltip: true,
            //   backgroundColor: '#fff',
            //   color: '#60adff',
            //   colors: {
            //     mo: '#9fceff',
            //     fl: '#60adff',
            //     or: '#409cff',
            //     ca: '#005cbf',
            //     tx: '#005cbf',
            //     wy: '#005cbf',
            //     ny: '#007bff'
            //   },
            //   hoverColor: '#222',
            //   enableZoom: false,
            //   borderWidth: 1,
            //   borderColor: '#fff',
            //   hoverOpacity: .85
            // });
          });
        </script>
        @stack('script')
      </body>
            {{-- <main class="py-4">
                @yield('content')
            </main> --}}
        </div>
</html>
