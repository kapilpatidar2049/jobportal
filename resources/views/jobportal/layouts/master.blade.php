<!DOCTYPE html>
<html lang="en">
    <?php
    $language = Session::get('changed_language');
    $rtl = ['ar', 'he', 'ur', 'arc', 'az', 'dv', 'ku', 'fa'];
    ?>
    @if (in_array($language, $rtl))
        <html lang="ar" dir="rtl">
        @else
            <html lang="en">
    @endif

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        @include('jobportal.layouts.header')

    </head>

    <body>
        @include('jobportal.layouts.flash_msg')
        <div class="leftbar">
            <div class="sidebar">
                <div class="logo">
                    <img src="{{ url('admin_theme/marketplace/images/bloomlogo.png') }}" class="img-fluid"
                        alt="{{ __('Logo') }}">
                </div>
                @include('jobportal.layouts.sidebar')
                <div class="profile-section ">
                    <div class="user-info">
                        <i class="fas fa-user"></i>
                        <span
                            class="loginuser-name">{{ substr(Auth::guard('jobportal')->user()->email, 0, 15) }}...</span>
                    </div>
                    <div class="more-options">
                        <div class="dropdown">
                            <a class="btn topbar-item dropdown-toggle" type="button" id="profile"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                                <li>
                                    <a class="dropdown-item" href="{{route('jobportal.billing')}}">
                                        {{ __('Billing & Invoice') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('jobportal.profile')}}">
                                        {{ __('Profile Setting') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('jobportal.company.register')}}">
                                        {{ __('Employers Setting') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('jobportal.logout') }}">{{ __('Logout') }}
                                    </a>
                                </li>
                            </ul>
                            {{-- <a href="{{ route('jobportal.logout') }}" title="{{ __('Logout') }}"><i
                                class="fa-solid fa-right-from-bracket"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="rightbar">

                <div class="menubar-smallscreen">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <div class="menubar-content-left">
                                    <div class="hamburger-menu">
                                        <span onclick="openNav()" class="hamburger">&#9776; </span>
                                        <div id="mySidenav" class="sidenav">
                                            <a href="javascript:void(0)" title="{{ __('Close') }}" class="closebtn"
                                                onclick="closeNav()">&times;</a>
                                            <hr class="mt-5">
                                            @include('jobportal.layouts.sidebar')
                                        </div>
                                    </div>
                                    <div class="sidebar-logo py-3">
                                        <a href="javascript:void(0)" title="{{ __('logo') }}">
                                            @if (isset($setting->favicon_logo) && !empty($setting->favicon_logo))
                                                <img src="{{ asset('images/favicon/' . $setting->favicon_logo) }}"
                                                    alt="{{ __('Favicon Logo') }}">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="menubar-content-right">
                                    <div>
                                        <div class="infobar">
                                            <ul class="topbar-options">
                                                <li>
                                                    <a href="" class="topbar-item"
                                                        title="{{ __('Notification') }}">
                                                        <i class="fa-solid fa-bell"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="" class="topbar-item" title="{{ __('Message') }}">
                                                        <i class="fa-regular fa-message"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="topbar-item" title="{{ __('Currency') }}">
                                                        <i class="fa-solid fa-dollar-sign"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="btn topbar-item dropdown-toggle" type="button"
                                                            id="languageDropdown" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa-solid fa-language"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('lang.switch', 'en') }}">English</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('lang.switch', 'ar') }}">Arabic</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('lang.switch', 'hi') }}">Hindi</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="topbar-item fullscreen-icon"
                                                        title="{{ __('Full Screen') }}">
                                                        <i class="fa-solid fa-expand"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="btn topbar-item dropdown-toggle" type="button"
                                                            id="profile" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa-solid fa-user"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="profile">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('lang.switch', 'en') }}">{{ __('My Account') }}</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('jobportal.logout') }}">{{ __('Logout') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('jobportal.layouts.topbar')
                <div class="main-container">
                    @yield('main-container')
                </div>
            </div>
            @include('jobportal.layouts.script')
    </body>

</html>
