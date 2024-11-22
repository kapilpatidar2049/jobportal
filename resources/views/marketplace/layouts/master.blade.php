<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | {{ __('Tocly - Admin & Dashboard Template') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('admin_theme/marketplace/build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('marketplace.layouts.head-css')
</head>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('marketplace.layouts.topbar')

    <!-- sidebar components -->
    @include('marketplace.layouts.sidebar')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('marketplace.layouts.msg')
                <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('marketplace.layouts.footer')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- customizer -->
@include('marketplace.layouts.right-sidebar')

<!-- vendor-scripts -->
@include('marketplace.layouts.vendor-scripts')
<style>
    .alert {
        opacity: 1;
        /* Start fully visible */
        transition: opacity 0.5s ease;
        /* Smooth transition */
    }

    .fade-out {
        opacity: 0;
        /* End state */
    }
</style>
<script>
    $(document).ready(function() {
        $('.alert').delay(3000);
        $('.alert').hide(4000);
    });
</script>

<script>
 window.addEventListener('beforeunload', function (e) {
    const userId = document.getElementById('user-id').value;
    fetch('/user/logout-window', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user_id: userId })
    }).catch(error => console.error('Error marking user as offline:', error));
});
</script>

</body>

</html>
