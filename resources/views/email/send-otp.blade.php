<p>Dear User,</p>
<p>Your OTP for password reset is: <strong>{{ $otp }}</strong></p>
<p>This OTP will expire in 10 minutes.</p>
<p>Thank you!</p>
Mail::raw('This is a test email', function ($message) {
    $message->to('patidargovind2203@gmail.com')
            ->subject('Test Email');
});