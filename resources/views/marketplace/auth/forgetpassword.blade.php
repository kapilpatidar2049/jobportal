<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Forgot Password') }}</title>
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Include Ionic Icons for ion-icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body class="container-login">
  
    <!-- Start Login -->
    <div class="row w-100">
        <div class="col-md-5 col-12 bg-white login_form_box"><div class="box mx-2">
            @include('marketplace.layouts.msg')
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <form action="{{ route('forget.password.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="bloomlogo">
                    <img src="{{ url('/admin_theme/marketplace/images/bloomlogo.png') }}" alt="{{ __('logo') }}">
                    </div>
                    <h4 class="text-center mb-5">{{ __('Forgot Password') }}</h4>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                        <label for="email">{{__('Email')}}</label>
                    </div>
        
                    <button type="submit" class="btn btn-primary w-100">{{__('Reset')}}</button>
        
                    <div class="register mt-3 text-center">
                        <p><a href="{{ route('login') }}">{{__('Back to Login')}}</a></p>
                    </div>
                </form></div>
                <div class="col-lg-3"></div>
            </div>
            
        </div></div>
        <div class="col-md-7 Forgot-img d-none d-md-block"></div>
    </div>

    
    <!-- End Login -->

    <script src="{{ url('admin_theme/marketplace/js/login.js') }}"></script>
</body>
<!-- body end -->

</html>
