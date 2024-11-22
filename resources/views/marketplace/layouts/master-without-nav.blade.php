<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | {{__('Tocly - Admin & Dashboard Template')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('admin_theme/marketplace/build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('marketplace.layouts.head-css')
</head>

<body>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
    @yield('content')

    <!-- vendor-scripts -->
    @include('marketplace.layouts.vendor-scripts')

</body>

</html>
