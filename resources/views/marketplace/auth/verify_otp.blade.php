<!-- resources/views/auth/verify-otp.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{__('Verify OTP')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="login-page">
        <div class="row w-100">
        <div class="col-lg-7 col-md-7 varify-img d-none d-md-block"></div>
        <div class="col-md-5 col-12 bg-white login_form_box">
            @include('marketplace.layouts.msg')
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="login-box">
                        <div class="register-logo mb-4">
                            <div class="bloomlogo">
                                <img src="{{ url('/admin_theme/marketplace/images/bloomlogo.png') }}"
                                    alt="{{ __('logo') }}">
                            </div>
                        </div>
                        <div class="register-dtls">
                            <h4 class="register-heading mb-4 text-center">{{ __('Verify OTP') }}</h4>

                            @if (session('success'))
                                <div class="alert alert-success success-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('verify.otp.post') }}" id="otpForm"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Hidden Email Field -->
                                <input type="hidden" name="email" value="{{ session('email') }}" id="email">

                                <div class="mb-3">
                                    <label for="otp" class="form-label">{{ __('Enter OTP') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="{{ __('OTP') }}"
                                        name="otp" required id="otp">
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary "
                                        title="Verify OTP">{{ __('Verify OTP') }}</button>
                                </div>
                            </form>

                            <!-- Timer and Resend OTP Sections -->
                            <div id="timerSection" class="text-center mb-3">
                                 {{__('Resend OTP in')}}<span id="timer" class="fw-bold text-primary">{{__(' 30')}}</span>
                                {{__('seconds')}}
                            </div>
                            <div id="resendSection" class="text-center" style="display: none;">
                                <a id="resendLink" class="text-primary text-decoration-none cursor-pointer">{{__('Resend OTP')}}
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Timer Logic
        $(document).ready(function() {
            let timerDuration = 30; // Set timer for 30 seconds
            let timer = setInterval(function() {
                if (timerDuration <= 0) {
                    clearInterval(timer);
                    $('#timerSection').hide();
                    $('#resendSection').show(); // Show the "Resend OTP" link after the timer ends
                } else {
                    $('#timer').text(timerDuration); // Update the timer countdown
                    timerDuration--;
                }
            }, 1000);

            // Resend OTP functionality via AJAX
            $('#resendLink').on('click', function() {
                let userEmail = $('#email').val(); // Get email from hidden input

                $.ajax({
                    url: '{{ route('otp.resend') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: userEmail
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Alert user that OTP has been resent
                            timerDuration = 30; // Restart the timer
                            $('#resendSection').hide(); // Hide resend link and show timer again
                            $('#timerSection').show();
                            timer = setInterval(function() {
                                if (timerDuration <= 0) {
                                    clearInterval(timer);
                                    $('#timerSection').hide();
                                    $('#resendSection').show();
                                } else {
                                    $('#timer').text(timerDuration);
                                    timerDuration--;
                                }
                            }, 1000);
                        } else {
                            alert('Failed to resend OTP. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while resending OTP. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>
