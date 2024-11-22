"use strict"

$(document).ready(function () {
    let timerDuration = 30;
    let timer = setInterval(function () {
        if (timerDuration <= 0) {
            clearInterval(timer);
            $('#timerSection').hide();
            $('#resendSection').show();
        } else {
            $('#timer').text(timerDuration);
            timerDuration--;
        }
    }, 1000);

    $('#resendLink').on('click', function () {
        $.ajax({
            url: '{{ route('otp.resend') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: "{{ session('email') }}"
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    timerDuration = 30;
                    $('#resendSection').hide();
                    $('#timerSection').show();
                    timer = setInterval(function () {
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
            }
        });
    });
});