<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<head>
    @include('frontend.layouts.header')
</head>

<body>
    @include('frontend.layouts.topbar')
    @yield('content')
    @include('frontend.layouts.footer')
    @include('frontend.layouts.script')
</body>

</html>
