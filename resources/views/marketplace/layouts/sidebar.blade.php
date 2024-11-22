<!-- ========== Left Sidebar Start ========== -->
<div class="wrapper">

    <div class="vertical-menu" id="sidebar">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ URL::asset('admin_theme/marketplace/images/bloomlogo.png') }}" alt="logo-sm-dark"
                        height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('admin_theme/marketplace/images/bloomlogo.png') }}" alt="logo-dark"
                        height="50">
                </span>
            </a>
            <a href="index" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ URL::asset('admin_theme/marketplace/images/bloomlogo.png') }}" alt="logo-sm-light"
                        height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('admin_theme/marketplace/images/bloomlogo.png') }}" alt="logo-light"
                        height="50">
                </span>
            </a>
        </div>
        <div data-simplebar class="vertical-scroll" id="sidebarContent">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">{{ __('Menu') }}</li>
                    <li class="menu_item_color">
                        <a href="javascript:void(0);" class="waves-effect">
                            <img src="{{ URL::asset('admin_theme/marketplace/images/home.svg') }}" alt=""
                                width="25px">
                            <span>{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu_item_color">
                        <a href="javascript:void(0);" class="waves-effect" id="startTracking">
                            <img src="{{ URL::asset('admin_theme/marketplace/images/video-camera.svg') }}" alt="" width="25px">
                            <span>{{ __('Tracking screen') }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">{{ __('Project') }}</li>
                            <li class="menu_item_color">
                                <a href="{{route('project.show')}}" class="waves-effect">
                                    <i class="fa-solid fa-hand-holding-hand"></i>
                                    <span>{{ __('Project Upload') }}</span>
                                </a>
                            </li>
                </ul>

                <ul class="metismenu list-unstyled" id="side-menu">
                    
                    <li class="menu_item_color">
                        <a href="{{ route('chats.index', ['receiver_id' =>Auth::user()->id]) }}" class="waves-effect">
                            
                            <i class="fa-regular fa-comment-dots "></i>
                            <span>{{ __('Chat') }}</span>
                        </a>
                    </li>
                    <li class="menu_item_color">
                        <a href="{{route('bid.proposal')}}" class="waves-effect">
                            <i class="fa-solid fa-file-invoice"></i> <span>{{ __('Proposal') }}</span>
                        </a>
                    </li>
                    <li class="menu_item_color">
                        <a href="{{route('invoices.create')}}" class="waves-effect">
                            <i class="fa-solid fa-file-invoice"></i> <span>{{ __('Invoice Create') }}</span>
                        </a>
                    </li>
                    <li class="menu_item_color">
                        <a href="javascript:void(0);" class="waves-effect">
                            <img src="{{ URL::asset('admin_theme/marketplace/images/payment.svg') }}" alt=""
                                width="25px" class="img_color" id="paymentImage">
                            <span>{{ __('Payment Gateway') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
