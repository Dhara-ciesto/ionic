<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>CONNECTING YOU TO THE BEST | Estimate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Tira" name="description" />
    <meta content="Tira" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('/assets/images/favicon.png') }}">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    @include('layouts.head-css')
    @stack('css')

    <style>
        .navigation.navbar-background {
            background-image: linear-gradient(to right bottom, #fbb202, #fcbd16, #fdc724, #fed231, #ffdc3d);
        }
        .footer-links .footer-link {
            color : #9598a9
        }
        .topbar-color{
            color: #ffc200;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#topnav-menu" data-bs-offset="60">

<nav class="navbar navbar-expand-lg navigation" style="z-index:1000000000000000000000000000000;">
    <div class="">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('home')}}" class="logo logo-dark">
                <span class="logo-sm" >
                     <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" class="auth-logo-dark">
                </span>
            </a>
            <a href="{{route('home')}}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="75" class="auth-logo-light">
                </span>
            </a>
                {{-- <a href="{{route('home')}}" class="logo logo-dark link-light fs-1 ">
                    Tira
                </a>

                <a href="{{route('home')}}" class="logo logo-light link-light fs-1 topbar-color">
                    Tira
                </a> --}}
            </div>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> --}}

        </div>


        {{-- <div class="collapse navbar-collapse" id="topnav-menu-content">
            <!-- LOGO -->
            <div class="navbar-brand-box ms-auto">

                <a href="{{route('home')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo2.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo2.png') }}" alt="" height="50">
                    </span>
                </a>
                <a href="{{route('home')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo2.png') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo2.png') }}" alt="" height="50">
                    </span>
                </a>

            </div> --}}

            {{-- <ul class="navbar-nav ms-auto" id="topnav-menu">

                <li class="nav-item">
                    <a class="nav-link" href="#"><i class='bx bx-export bx-sm'></i></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown d-inline-block ">
                        <button type="button" class="btn header-item waves-effect nav-link" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry"><i class='bx bxs-cog bx-sm'></i></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Privacy Policy</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                </li>
            </ul> --}}
        </div>
    </div>

</nav>

    @yield('content')

    <!-- Footer start -->
    <footer class="landing-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <!-- © {{date('Y')}} Tira. All rights reserved -->
                    {{-- <image src="{{ asset('/images/logo.png') }}" height="60px" width="60px" /> --}}
                    <image src="{{ asset('assets/images/logo.png') }}" height="60px" width="60px" />
                </div>
                <div class="col-md-10 footer-links">
                    <div class="row">
                        <!-- <div class="col-md-3">
                            <a href="{{route('privacy_policy')}}" class="footer-link">Privacy Policy</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('terms_and_conditions')}}" class="footer-link">Terms and Conditions</a>
                        </div> -->
                        <div class="col-md-4">
                            <b>Contact Details</b><br/>
                            <a style="color:gray;" href="mailto:kutchiking@outlook.com">kutchiking@outlook.com</a><br/>
                            <a style="color:gray;" href="tel:+447956027174">+447956027174</a>
                        </div>
                        <div class="col-md-4">
                            <b>Address</b><br/>
                            <span>
                                77 New Cavendish St, London W1W 6XB
                            </span>
                        </div>
                        <div class="col-md-4">
                            <b>Policies</b><br/>
                            <a href="{{route('privacy_policy')}}" class="footer-link">Privacy Policy</a><br/>
                            <a href="{{route('terms_and_conditions')}}" class="footer-link">Terms and Conditions</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-sm-6">
                    <div class="mb-4 mb-lg-0">
                        <h5 class="mb-3 footer-list-title">CONTACT DETAILS</h5>
                        <ul class="list-unstyled footer-list-menu">
                            <li><a href="mailto:toptierhire@outlook.com">toptierhire@outlook.com</a></li>
                            <li><a href="#">+447956027174</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="mb-4 mb-lg-0">
                        <h5 class="mb-3 footer-list-title">ADDRESS</h5>
                        <ul class="list-unstyled footer-list-menu">
                            <li>
                                <address>
                                    7 New Cavendish St,
                                    London W1W 6XB
                                </address>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="mb-4 mb-lg-0">
                        <h5 class="mb-3 footer-list-title">POLICIES</h5>
                        <ul class="list-unstyled footer-list-menu">
                            <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                            <li><a href="{{route('terms_and_conditions')}}">Terms and Conditions</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>

            <!-- end row -->
        </div>
        <!-- end container -->
    </footer>
    <!-- Footer end -->
    <script>
        let baseUrl = "{{url('/')}}";

    </script>
    @include('layouts.vendor-scripts')

    <script src="{{ URL::asset('/assets/libs/jquery.easing/jquery.easing.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ URL::asset('/assets/libs/jquery-countdown/jquery-countdown.min.js') }}"></script>

    <!-- owl.carousel js -->
    <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- ICO landing init -->
    <script src="{{ URL::asset('/assets/js/pages/ico-landing.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    @stack('js')

    </body>

    </html>

