<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('/images/logo/Minda.jpg') }}" type="image/x-icon">

    <!-- Scripts -->


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/amazeui.datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery.simple-dtpicker.js') }}"></script>
    <script src="{{ asset('js/picker.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/raphael.min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/jquery.vmap.min.js') }}"></script>

    <script src="{{ asset('js/azia.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        $(function(){
          'use strict'

            $('[data-toggle="tooltip"]').tooltip();

            // colored tooltip
            $('[data-toggle="tooltip-primary"]').tooltip({
                template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
            });

            $('[data-toggle="tooltip-secondary"]').tooltip({
                template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
            });


          $('.select2').select2({
                placeholder: 'Choose one',
                searchInputPlaceholder: 'Search'
            });

          $('.select2-no-search').select2({
              minimumResultsForSearch: Infinity,
              placeholder: 'Choose one'
          });

          $('.az-sidebar .with-sub').on('click', function(e){
            e.preventDefault();
            $(this).parent().toggleClass('show');
            $(this).parent().siblings().removeClass('show');
          })

          // $(document).on('click touchstart', function(e){
          //   e.stopPropagation();

          //   // closing of sidebar menu when clicking outside of it
          //   if(!$(e.target).closest('.az-header-menu-icon').length) {
          //     var sidebarTarg = $(e.target).closest('.az-sidebar').length;
          //     if(!sidebarTarg) {
          //       $('body').removeClass('az-sidebar-show');
          //     }
          //   }
          // });

          $('#azSidebarToggle').on('click', function(e){
            e.preventDefault();

            if(window.matchMedia('(min-width: 992px)').matches) {
              $('body').toggleClass('az-sidebar-hide');
            } else {
              $('body').toggleClass('az-sidebar-show');
            }
          })

          var Defaults = $.fn.select2.amd.require('select2/defaults');

            $.extend(Defaults.defaults, {
                searchInputPlaceholder: ''
            });

            var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

            var _renderSearchDropdown = SearchDropdown.prototype.render;

            SearchDropdown.prototype.render = function(decorated) {

                // invoke parent method
                var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

                this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

                return $rendered;

            }
        });

        function openAttendance() {
            window.open('{!! route('attendance.index') !!}', '_blank', 'width=1980, height=1300, fullscreen=true')
        }
      </script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/picker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
            <div class="az-img-user online"><img src="{{ asset('storage/'.(auth()->user()->photoURL ?: 'photos/image.gif') ) }}" alt=""></div>
            <div class="media-body">
              <h6>{{ auth()->user()->full_name }}</h6>
              <span>{{ auth()->user()->position->count() > 0 ? auth()->user()->position[0]->position : "No Position" }}</span>
            </div><!-- media-body -->
          </div><!-- az-sidebar-loggedin -->
          <div class="az-sidebar-body">
            <ul class="nav">
                <li class="nav-label">Main Menu</li>
                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('home') }}" class="nav-link"><i class="icon ion-md-home"></i>Home</a>
                    {{-- <ul class="nav-sub">
                    <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
            @if (auth()->user()->role == 'Employee')
                <li class="nav-item {{ Request::is('benefits/showAll') ? 'active' : '' }}">
                        {{-- <li>with-sub</li> --}}
                    <a href="{{ route('benefit.showAll') }}" class="nav-link"><i class="icon ion-md-cash"></i>Benefit</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item {{ Request::is('DTR/showAll') ? 'active' : '' }}">
                        {{-- <li>with-sub</li> --}}
                    <a href="#" class="nav-link"><i class="icon ion-md-stopwatch"></i>DTR</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item {{ Request::is('activities/showAll') ? 'active' : '' }}">
                        {{-- <li>with-sub</li> --}}
                    <a href="{{ route('activity.showAll') }}" class="nav-link"><i class="icon ion-md-construct"></i>Activity</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item {{ Request::is('leaves/showAll') ? 'active' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('leave.showAll') }}" class="nav-link"><i class="icon ion-md-airplane"></i>Leave</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item {{ Request::is('payslip/show') == 'benefit*' ? 'active' : '' }}">
                        {{-- <li>with-sub</li> --}}
                    <a href="#" class="nav-link"><i class="icon ion-md-list-box"></i>Payslip</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
            @elseif(auth()->user()->role == 'HRO')
                <li class="nav-item  {{ Request::is('deduction*') || Request::is('benefit*') || Request::is('compensation*')  ? 'active show' : '' }}">
                    {{-- <li>with-sub</li> --}}
                <a href="#" class="nav-link with-sub"><i class="icon ion-md-card"></i>Payroll</a>
                <ul class="nav-sub">
                    <li class="nav-sub-item {{ Request::is('deduction*') ? 'active' : '' }}"><a href="{{ route('deduction.index') }}" class="nav-sub-link">Deductions</a></li>
                    <li class="nav-sub-item {{ Request::is('benefit*') ? 'active' : '' }}"><a href="{{ route('benefit.index') }}" class="nav-sub-link">Benefits</a></li>
                    <li class="nav-sub-item {{ Request::is('compensation*') ? 'active' : '' }}"><a href="{{ route('compensation.index') }}" class="nav-sub-link">Compensations</a></li>
                </ul>
                </li><!-- nav-item -->
                <li class="nav-item {{ Request::is('users/employee*') ? 'active' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('user.index') }}" class="nav-link"><i class="icon ion-md-contact"></i>Employee</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Web Analytics</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item  {{ Request::is('activity*') ? 'active' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('activity.index') }}" class="nav-link"><i class="icon ion-md-star"></i>Activity</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                        <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item  {{ Request::is('leave*') ? 'active show' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('leave.index') }}" class="nav-link"><i class="icon ion-md-airplane"></i>Leave</a>
                    {{-- <ul class="nav-sub">
                    <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                    <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
            @elseif(auth()->user()->role == 'Admin')
                <li class="nav-item  {{ Request::is('users/employee*') || Request::is('users/admin*')  ? 'active show' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="#" class="nav-link with-sub"><i class="icon ion-md-contact"></i>Users</a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item {{ Request::is('users/employee*') ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                        <li class="nav-sub-item {{ Request::is('users/admin*') ? 'active' : '' }}"><a href="{{ route('admin.index') }}" class="nav-sub-link">Admin</a></li>
                    </ul>
                </li><!-- nav-item -->
                <li class="nav-item  {{ Request::is('position*') ? 'active show' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('position.index') }}" class="nav-link"><i class="icon ion-md-trophy"></i>Positions</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                        <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item  {{ Request::is('department*') ? 'active show' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('department.index') }}" class="nav-link"><i class="icon ion-md-filing"></i>Department</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                        <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
                <li class="nav-item  {{ Request::is('type*') ? 'active show' : '' }}">
                    {{-- <li>with-sub</li> --}}
                    <a href="{{ route('leaveType.index') }}" class="nav-link"><i class="icon ion-md-airplane"></i>Leave Type</a>
                    {{-- <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="dashboard-one.html" class="nav-sub-link">Admin</a></li>
                        <li class="nav-sub-item {{ Request::path() == 'users' || Request::path() == 'user/create' ? 'active' : '' }}"><a href="{{ route('user.index') }}" class="nav-sub-link">Employee</a></li>
                    </ul> --}}
                </li><!-- nav-item -->
            @endif
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
                  <a href="" class="az-img-user"><img src="{{ asset('storage/'.(auth()->user()->photoURL ?: 'photos/image.gif')) }}" alt=""></a>
                  <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                      <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-dropdown-circle"></i></a>
                    </div>
                    <div class="az-header-profile">
                      <div class="az-img-user">
                            {!! QrCode::size(100)->generate(auth()->user()->id); !!}
                      </div><!-- az-img-user -->
                      <h6>{{ auth()->user()->full_name }}</h6>
                      <span class="tx-center">{{ auth()->user()->position->count() > 0 ? auth()->user()->position[0]->position : "No Position" }}</span>
                    </div><!-- az-header-profile -->

                    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="#" class="dropdown-item" onclick="openAttendance()"><i class="typcn typcn-edit"></i> Open Attendance Tab</a>
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
            <div id="app">
                  @yield('content')
                  @yield('modal')
            </div>
            @include('sweetalert::alert')
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


        @stack('script')
      </body>
            {{-- <main class="py-4">
                @yield('content')
            </main> --}}
        </div>
</html>
