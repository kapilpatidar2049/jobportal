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
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f9f9f9;
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-image: url({{ url('assets/images/loginbg.png') }});
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
            {{-- <p class="alert-success alert">{{ __('OTP Was sent Successfully ') }}</p>   --}}
            <div class="loginform">
                <div class="logo">
                    <img src="{{ url('admin_theme/marketplace/images/bloomlogo.png') }}" alt="{{ __('Logo') }}">
                </div>
                <form action="{{route('jobportal.checkotp')}}" method="post" novalidate>
                    @csrf
                    <div class="form-group">
                        <input type="hidden" readonly class="form-control" id="email" name="email" value="{{ old('email', $email) }}" placeholder="{{ __('Enter Your Email') }}">
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-label">{{ __('Register For') }}</label>
                        <select name="role" id="role" class="form-control">
                            <option value="jobseeker" @if(old('role') == 'jobseeker') selected @endif>{{ __('Job Seeker') }}</option>
                            <option value="employee" @if(old('role') == 'employee') selected @endif>{{ __('Employee') }}</option>
                        </select>
                        <div class="form-control-icon"><i class="fa-solid fa-briefcase"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="otp" class="form-label">{{ __('OTP') }}</label>
                        <input type="text" class="form-control" id="otp" maxlength="6" name="otp"
                            placeholder="{{ __('Enter Your OTP') }}" pattern="\d{6}" title="Please enter a 6-digit OTP"
                            required>
                        <div class="form-control-icon"><i class="fa-solid fa-lock"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="password">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="{{ __('Enter Your Password') }}">
                            <div class="eye">
                                <i class="fa-solid fa-eye-slash" onclick="passwordToggle('password', this)"></i>
                            </div>
                        </div>
                        <div class="form-control-icon"><i class="fa-solid fa-lock"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">{{ __('Confirm Password') }}</label>
                        <div class="password">
                            <input type="password" class="form-control" id="confirm_password" name="password_confirmation"
                                placeholder="{{ __('Re-enter Your Password') }}">
                            <div class="eye">
                                <i class="fa-solid fa-eye-slash" onclick="passwordToggle('confirm_password', this)"></i>
                            </div>
                        </div>
                        <div class="form-control-icon"><i class="fa-solid fa-lock"></i></div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
                    </div>
                </form>
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
