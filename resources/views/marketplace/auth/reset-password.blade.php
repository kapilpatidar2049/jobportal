<!-- resources/views/auth/reset-password.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Reset Password')}}</title>
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
                            <div class="container mt-5">
                                <h3>{{__('Reset Password')}}</h3>

                                <!-- Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Error Message -->
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <!-- Display Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('password.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    <div class="mb-3">
                                        <label for="password" class="form-label"> {{__('New Password')}}<span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required minlength="8">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label"> {{__('Confirm Password')}}<span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required minlength="8">
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('Update Password')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 col-12"></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
