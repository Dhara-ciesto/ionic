<style>
    .navbar-brand-box {
    display: flex;
}

</style>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                {{-- <a href="{{ route('submission.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="50">
                    </span>
                </a>

                <a href="{{ route('submission.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/small_logo.png') }}" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="50">
                    </span>
                </a> --}}
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> --}}

        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item fs-5" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Welcome,  @if(Auth::user()->name)
                    {{ucfirst(Auth::user()->name)}}
                    @else
                    {{ucfirst(Auth::user()->username)}}
                    @endif
                </button>
            </div>

            {{-- <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @switch(Session::get('lang'))
                    @case('ru')
                        <img src="{{ URL::asset('/assets/images/flags/russia.jpg')}}" alt="Header Language" height="16">
            @break
            @case('it')
            <img src="{{ URL::asset('/assets/images/flags/italy.jpg')}}" alt="Header Language" height="16">
            @break
            @case('de')
            <img src="{{ URL::asset('/assets/images/flags/germany.jpg')}}" alt="Header Language" height="16">
            @break
            @case('es')
            <img src="{{ URL::asset('/assets/images/flags/spain.jpg')}}" alt="Header Language" height="16">
            @break
            @default
            <img src="{{ URL::asset('/assets/images/flags/us.jpg')}}" alt="Header Language" height="16">
            @endswitch
            </button>
            <div class="dropdown-menu dropdown-menu-end">

                <!-- item-->
                <a href="{{ url('index/en') }}" class="dropdown-item notify-item language" data-lang="eng">
                    <img src="{{ URL::asset ('/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                </a>
                <!-- item-->
                <a href="{{ url('index/es') }}" class="dropdown-item notify-item language" data-lang="sp">
                    <img src="{{ URL::asset ('/assets/images/flags/spain.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="{{ url('index/de') }}" class="dropdown-item notify-item language" data-lang="gr">
                    <img src="{{ URL::asset ('/assets/images/flags/germany.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="{{ url('index/it') }}" class="dropdown-item notify-item language" data-lang="it">
                    <img src="{{ URL::asset ('/assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="{{ url('index/ru') }}" class="dropdown-item notify-item language" data-lang="ru">
                    <img src="{{ URL::asset ('/assets/images/flags/russia.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                </a>
            </div>
        </div> --}}

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- <img class="rounded-circle header-profile-user" src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="Header Avatar"> --}}
                {{-- <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->name)}}</span> --}}
                <span class="d-none d-xl-inline-block ms-1" key="t-henry"><i class='bx bx-cog bx-sm'></i></span>
                {{-- <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i> --}}
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
            <a class="dropdown-item" href="{{route('user.change_password')}}"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-profile">Change Password</span></a>


                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    </div>
</header>
