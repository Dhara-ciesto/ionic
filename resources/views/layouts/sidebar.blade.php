<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>
                <li>
                    <a href="{{ route('submission.dashboard') }}" class="waves-effect ">
                        <i class="fas fa-tachometer-alt"></i>
                        <span key="t-starter-page">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @if (Auth::user()->role == 1)
                <li>
                    <a href="{{ route('product.category.index') }}" class="waves-effect ">
                        <i class="fas fa-building"></i>
                        <span key="t-starter-page">{{ __('Category') }}</span>
                    </a>
                </li>
                 <li>
                        <a href="{{ route('product.index') }}" class="waves-effect">
                            <i class="fas fa-box"></i>
                            <span key="t-starter-page">{{ __('Product') }}</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-cog"></i>
                            <span key="t-layouts">{{ __('General Setting') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('email.config') }}" class="waves-effect ">
                                    <i class="fas fa-envelope"></i>
                                    <span key="t-starter-page">{{ __('Email Setting') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-layout"></i>
                            <span key="t-layouts">{{ __('Masters') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ route('product.brands.index') }}" class="waves-effect ">
                                    <i class="fas fa-building"></i>
                                    <span key="t-starter-page">{{ __('Brand Management') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('unit.index') }}" class="waves-effect ">
                                    <i class="fas fa-balance-scale"></i>
                                    <span key="t-starter-page">{{ __('Unit Management') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('scent_types.index') }}" class="waves-effect">
                                    <i class="fas fa-th-list"></i>
                                    <span key="t-starter-page">{{ __('Scent Types') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('fragrance_tone.index') }}" class="waves-effect ">
                                    <i class="fas fa-ankh"></i>
                                    <span key="t-starter-page">{{ __('Fragrance Tone') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('campaign.index') }}" class="waves-effect ">
                                    <i class="fas fa-box"></i>
                                    <span key="t-starter-page">{{ __('Campaign') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('logs') }}" target="_blank" class="waves-effect">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span key="t-starter-page">{{ __('Logs') }}</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                    <a href="{{route('bakery.index')}}" class="waves-effect ">
                       <i class="fas fa-hamburger"></i>
                        <span key="t-starter-page">{{__('Bakery')}}</span>
                    </a>
                    </li>
                    <li>
                        <a href="{{route('kitchen.index')}}" class="waves-effect ">
                            <i class="fas fa-utensils"></i>
                            <span key="t-starter-page">{{__('Kitchen')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('franchise.index')}}" class="waves-effect ">
                            <i class="fas fa-box"></i>
                            <span key="t-starter-page">{{__('Franchise')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('franchise_order.index')}}" class="waves-effect ">
                            <i class="fas fa-shopping-bag"></i>

                            <span key="t-starter-page">{{__('Franchise Order')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('order_report.index')}}" class="waves-effect ">
                            <i class="fas fa-file-alt"></i>
                            <span key="t-starter-page">{{__('Order Report')}}</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="{{route('user.index')}}" class="waves-effect">
                            <i class="fas fa-users"></i>
                            <span key="t-starter-page">{{__('Manage Admin')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('order.index') }}" class="waves-effect">
                            <i class="fas fa-list"></i>
                            <span key="t-starter-page">{{ __('Orders') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notification.index') }}" class="waves-effect">
                            <i class="fas fa-bell"></i>
                            <span key="t-starter-page">{{ __('Notification') }}</span>
                        </a>
                    </li>
                        {{-- <li>
                        <a href="{{route('client.index')}}" class="waves-effect">
                            <i class="fas fa-user-secret"></i>
                            <span key="t-starter-page">{{__('Client')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manager.index')}}" class="waves-effect">
                            <i class="fas fa-user-tie"></i>
                            <span key="t-starter-page">{{__('Manager')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('recruiter.index')}}" class="waves-effect">
                            <i class="fas fa-user-nurse"></i>
                            <span key="t-starter-page">{{__('Recruiter')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('privacy-policy')}}" class="waves-effect">
                            <i class='bx bx-key'></i>
                            <span key="t-starter-page">{{__('Privacy Policy')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('terms-and-condition')}}" class="waves-effect">
                            <i class='bx bx-notepad'></i>
                            <span key="t-starter-page">{{__('Terms and Condition')}}</span>
                        </a>
                    </li> --}}
                        {{-- <li>
                        <a href="{{route('submission.index')}}" class="waves-effect ">
                            <i class="fas fa-tachometer-alt"></i>
                            <span key="t-starter-page">{{__('Submission')}}</span>
                        </a>
                    </li> --}}
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
