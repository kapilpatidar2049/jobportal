<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('jobportal.front.layouts.header')
</head>
<body>
    @include('jobportal.front.layouts.topbar')
    @include('jobportal.layouts.flash_msg')
    @yield('main-container')
    @include('jobportal.front.layouts.script')
</body>
</html>