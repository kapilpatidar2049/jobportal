<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-sm-dark.png') }}" alt="logo-sm-dark" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-dark.png') }}" alt="logo-dark" height="22">
                    </span>
                </a>
                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-sm-light.png') }}" alt="logo-sm-light"
                            height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-light.png') }}" alt="logo-light" height="22">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse"
                data-bs-target="#topnav-menu-content">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- start page title -->
            <div class="page-title-box align-self-center d-none d-md-block">
                <h4 class="page-title mb-0">@yield('page-title')</h4>
            </div>
            <!-- end page title -->
        </div>

        <div class="d-flex">
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="" src="{{ URL::asset('admin_theme/marketplace/build/images/flags/us.jpg') }}" alt="Header Language"
                        height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/flags/spain.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">{{__('Spanish')}}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/flags/germany.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">{{__('German')}}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/flags/italy.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">{{__('Italian')}}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('admin_theme/marketplace/build/images/flags/russia.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">{{__('Russian')}}</span>
                    </a>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ri-apps-2-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('admin_theme/marketplace/build/images/brands/github.png') }}" alt="Github">
                                    <span>{{__('GitHub')}}</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('admin_theme/marketplace/build/images/brands/bitbucket.png') }}" alt="bitbucket">
                                    <span>{{__('Bitbucket')}}</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('admin_theme/marketplace/build/images/brands/dribbble.png') }}" alt="dribbble">
                                    <span>{{__('Dribbble')}}</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('admin_theme/marketplace/build/images/brands/dropbox.png') }}" alt="dropbox">
                                    <span>{{__('Dropbox')}}</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('admin_theme/marketplace/build/images/brands/mail_chimp.png') }}"
                                        alt="mail_chimp">
                                    <span>{{__('Mail Chimp')}}</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('admin_theme/marketplace/build/images/brands/slack.png') }}" alt="slack">
                                    <span>{{__('Slack')}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> {{__('Notifications')}}</h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> {{__('View All')}}</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">{{__('Your order is placed')}}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{__('If several languages coalesce the grammar')}}</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{__('3 min ago')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ URL::asset('admin_theme/marketplace/build/images/users/avatar-3.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">{{__('James Lemire')}}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{__('It will seem like simplified English.')}}</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{__('1 hours ago')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">{{__('Your item is shipped')}}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{__('If several languages coalesce the grammar')}}</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{__('3 min ago')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ URL::asset('admin_theme/marketplace/build/images/users/avatar-4.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">{{__('Salena Layfieldv')}}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{__('As a skeptical Cambridge friend of mine occidental.')}}</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{__('1 hours ago')}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> {{__('View More..')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user avatar-sm"
                        src="{{ URL::asset('admin_theme/marketplace/build/images/users/avatar-2.jpg') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{__('Steven')}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="javascript:void(0)"><i
                            class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">{{__('Profile')}}</span></a>
                    <a class="dropdown-item" href="javascript:void(0)"><i
                            class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">{{__('Messages')}}</span></a>
                    <a class="dropdown-item" href="javascript:void(0)"><i
                            class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">{{__('Help')}}</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)"><i
                            class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">{{__('Balance :')}} <b>{{__('$5971.67')}}</b></span></a>
                    <a class="dropdown-item" href="javascript:void(0)"><span
                            class="badge bg-primary mt-1 float-end">{{__('New')}}</span><i
                            class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">{{__('Settings')}}</span></a>
                    <a class="dropdown-item" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">{{__('Logout')}}</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="index">
                            <i class="uim uim-airplay"></i> {{__('Dashboard')}}
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                            role="button">
                            <i class="uim uim-box"></i>  {{__('Extra Pages')}}<div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-more">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                    role="button">
                                     {{__('Authentication')}}<div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="auth-login" class="dropdown-item">{{__('Login')}}</a>
                                    <a href="auth-register" class="dropdown-item">{{__('Register')}}</a>
                                    <a href="auth-recoverpw" class="dropdown-item">{{__('Recover Password')}}</a>
                                    <a href="auth-lock-screen" class="dropdown-item">{{__('Lock Screen')}}</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-extra-pages" role="button">
                                    {{__('Extra Pages')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-extra-pages">
                                    <a href="pages-starter" class="dropdown-item">{{__('Starter Page')}}</a>
                                    <a href="pages-maintenance" class="dropdown-item">{{__('Maintenance')}}</a>
                                    <a href="pages-comingsoon" class="dropdown-item">{{__('Coming Soon')}}</a>
                                    <a href="pages-404" class="dropdown-item">{{__('Error 404')}}</a>
                                    <a href="pages-500" class="dropdown-item">{{__('Error 500')}}</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                            role="button">
                            <i class="uim uim-window-grid"></i> <span>{{__('Layouts')}}</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-layout-verti" role="button">
                                    <span key="t-vertical">{{__('Vertical')}}</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-layout-verti">
                                    <a href="layouts-dark-sidebar" class="dropdown-item">{{__('Dark Sidebar')}}</a>
                                    <a href="layouts-light-sidebar" class="dropdown-item">{{__('Light Sidebar')}}</a>
                                    <a href="layouts-compact-sidebar" class="dropdown-item">{{__('Compact Sidebar')}}</a>
                                    <a href="layouts-icon-sidebar" class="dropdown-item">{{__('Icon Sidebar')}}</a>
                                    <a href="layouts-boxed" class="dropdown-item">{{__('Boxed Width')}}</a>
                                    <a href="layouts-preloader" class="dropdown-item">{{__('Preloader')}}</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-layout-hori" role="button">
                                    <span key="t-horizontal">{{__('Horizontal')}}</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-layout-hori">
                                    <a href="layouts-horizontal" class="dropdown-item">{{__('Horizontal')}}</a>
                                    <a href="layouts-hori-topbar-dark" class="dropdown-item">{{__('Topbar Dark')}}</a>
                                    <a href="layouts-hori-light-header" class="dropdown-item">{{__('Light Header')}}</a>
                                    <a href="layouts-hori-boxed-width" class="dropdown-item">{{__('Boxed width')}}</a>
                                    <a href="layouts-hori-preloader" class="dropdown-item">{{__('Preloader')}}</a>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
