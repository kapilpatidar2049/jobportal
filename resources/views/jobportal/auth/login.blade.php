<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('/vendor/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ url('/assets/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ url('/jobportal/css/style.css') }}">
        <title>{{ __('Login To Job Portal') }}</title>
        <style>
            .main {
                position: relative;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f9f9f9;
                background-position: fixed;
                background-repeat: no-repeat;
                background-size: cover;
                background-image: url({{ url('assets/images/loginbg.png') }})
            }

            .loginform {
                position: absolute;
                top: 50%;
                left: 80%;
                transform: translate(-50%, -50%);
                width: 350px;
                /* border-radius: 5px; */
                background-color: #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                padding: 30px;
                box-sizing: border-box;
                border-bottom-left-radius: 40px;
                border-top-right-radius: 40px;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .main {
                    background-image: url({{ url('assets/images/mobile-bg.jpg') }})
                }

                .loginform {
                    width: 90%;
                    /* Make it responsive */
                    height: auto;
                    left: 50%
                }
            }
        </style>
    </head>

    <body>
        @include('jobportal.layouts.flash_msg')
        <div class="main">

            <div class="loginform">
                <div class="logo">
                    <img src="{{ url('admin_theme/marketplace/images/bloomlogo.png') }}" alt="{{ __('Logo') }}">
                </div>
                <div class="saparator">
                    <div class="line"></div>
                    <h4 class="saprator-text mx-1">{{ __('Login') }}</h4>
                    <div class="line"></div>
                </div>
                <form action="{{ route('jobportal.checkemail') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="{{ __('Enter Your Email') }}">
                        <div class="form-control-icon"><i class="fa-solid fa-envelope"></i></div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
                    </div>
                </form>
                <div class="saparator">
                    <div class="line"></div>
                    <span class="saprator-text">{{ __('OR') }}</span>
                    <div class="line"></div>
                </div>
                <div class="row">
                    <button class="btn btn-primary d-flex justify-content-evenly mb-3">
                        <img src="{{ url('/admin_theme/marketplace/images/google.png') }}" alt="Login With Google"
                            width="25px">
                        {{ __('Login With Google') }}
                    </button>
                    <button class="btn bg-dark text-white d-flex justify-content-evenly ">
                        <img src="{{ url('assets/images/apple.png') }}" alt="" width="25px">
                        {{ __('Login With Apple ID') }}
                    </button>
                </div>
            </div>
        </div>
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/toastr/toastr.js') }}"></script>
        <script>
            function passwordToggle(id, element) {
                const passwordField = document.getElementById(id);
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                element.classList.toggle('fa-eye-slash');
                element.classList.toggle('fa-eye');
            }
        </script>
        <script>
            $(document).ready(function() {
                $('.alert').delay(5000);
                $('.alert').hide(5000);
            });
        </script>
    </body>

</html>
