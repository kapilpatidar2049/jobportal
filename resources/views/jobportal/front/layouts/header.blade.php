<link rel="stylesheet" href="{{ url('/vendor/fontawesome/css/all.min.css') }}">
<link href="{{ url('assets/datatable/datatables.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ url('assets/datepicker/jquery-ui.css')}}">
<link href="{{url('assets/select2/select2.min.css')}}" rel="stylesheet" />
<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = ['ar', 'he', 'ur', 'arc', 'az', 'dv', 'ku', 'fa']; //make a list of rtl languages
?>
@if (in_array($language, $rtl))
    <!-- bootstrap rtl css -->
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.rtl.min.css') }}" type="text/css" />
    <!-- custom rtl css -->
    <link href="{{ url('jobportal/css/style_rtl.css') }}" rel="stylesheet" type="text/css" />

@else
    <link href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('/jobportal/css/style.css') }}">
    <!-- bootstrap css -->
@endif
<link rel="stylesheet" href="{{ url('/assets/toastr/toastr.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@yield('page-style')