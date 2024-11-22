<link rel="stylesheet" href="{{ url('/vendor/fontawesome/css/all.min.css') }}">
<link href="{{ url('assets/datatable/datatables.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ url('assets/datepicker/jquery-ui.css')}}">
<?php
$language = Session::get('changed_language');
$rtl = ['ar', 'he', 'ur', 'arc', 'az', 'dv', 'ku', 'fa'];
?>
@if (in_array($language, $rtl))
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.rtl.min.css') }}" type="text/css" />
    <!-- bootstrap rtl css -->
@else
    <link href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap css -->
@endif
<link rel="stylesheet" href="{{ url('/assets/toastr/toastr.min.css') }}">
@if (in_array($language, $rtl))
    <link href="{{ url('jobportal/css/style_rtl.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom rtl css -->
@else
    <link rel="stylesheet" href="{{ url('/jobportal/css/style.css') }}">
@endif

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@yield('page-style')