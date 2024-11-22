<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }}</title>
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="login-page">

        <div class="row w-100">
            <div class="col-md-7 login-img d-none d-md-block"></div>
            <div class="col-md-5 col-12 bg-white login_form_box">
                @include('marketplace.layouts.msg')
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-12"></div>
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="login-box">
                            <div class="bloomlogo"><img src="{{ url('/admin_theme/marketplace/images/bloomlogo.png') }}"
                                    alt="{{ __('logo') }}"></div>
                            <h3 class="text-center mb-4">{{ __('Login') }}</h3>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <a data-mdb-ripple-init class="btn w-100 googlebutton mb-4" href="#!"
                                    role="button">
                                    <img src="{{ url('/admin_theme/marketplace/images/google.png') }}" alt="google"
                                        class="googlelogo">
                                    <div class="githubicontext w-100">{{ __('Continue with Google') }}</div>
                                </a>
                                <a data-mdb-ripple-init class="btn w-100 githubbutton mb-4" href="#!"
                                    role="button">
                                    <i class="fa-brands fa-github githubicon"></i>
                                    <div class="githubicontext w-100">{{ __('Continue with GitHub') }}</div>
                                </a>

                                <div class="form-group mb-3">
                                    <label for="email" class="form_label">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form_label">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <span class="input-group-text" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggle-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary w-100"><b>{{ __('Log in') }}</b></button>
                            </form>
                            <hr>
                            <div class="my-4 text-center"><span>{{ __("Don't have an acount? ") }}</span><a
                                    href="{{ route('register') }}">{{ __('Register') }}</a></div>
                            <div class="my-4 text-center"><a
                                    href="{{ route('forget.password.get') }}">{{ __('Forget Password') }}</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 col-12"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('admin_theme/marketplace/js/login.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.alert').delay(3000);
            $('.alert').hide(4000);
        });
    </script>
 
 
</body>

</html>
