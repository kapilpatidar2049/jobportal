<!-- Layout config Js -->
<script src="{{ URL::asset('admin_theme/marketplace/build/js/layout.js') }}"></script>
@yield('css')
<!-- Bootstrap Css -->

<link href="{{ URL::asset('admin_theme/marketplace/build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App Css-->

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
<link rel="stylesheet" href="{{ url('/vendor/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ url('/assets/toastr/toastr.min.css') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" rel="stylesheet">
<link href="{{ url('assets/datatable/datatables.min.css') }}" rel="stylesheet">


<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = ['ar', 'he', 'ur', 'arc', 'az', 'dv', 'ku', 'fa']; //make a list of rtl languages
?>
@if (in_array($language, $rtl))
<link href="{{ URL::asset('admin_theme/marketplace/build/css/bootstrap.min.rtl.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap rtl css -->
@else
<link href="{{ URL::asset('admin_theme/marketplace/build/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap css -->
@endif

@if (in_array($language, $rtl))
<link href="{{ URL::asset('admin_theme/marketplace/build/css/style.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin_theme/marketplace/css/style.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin_theme/marketplace/build/css/app.min.rtl.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- custom rtl css -->
@else
<link href="{{ URL::asset('admin_theme/marketplace/build/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin_theme/marketplace/build/css/chat.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin_theme/marketplace/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('admin_theme/marketplace/build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endif

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>