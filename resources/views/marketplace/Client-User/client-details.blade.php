<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Client Details') }}</title>
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="login-page">
        <div class="row w-100">
            <div class="col-md-6 col-12 bg-white login_form_box client_user_details">
                <div class="row">
                    <div class="col-12">
                        <div class="client-box">
                            <div class="bloomlogo"><img src="{{ url('/admin_theme/marketplace/images/bloomlogo.png') }}"
                                    alt="{{ __('logo') }}"></div>
                            <h3 class="text-center mb-4">{{ __('Client Login') }}</h3>
                            <form action="{{ route('client_details-store') }}" method="POST" class="mt-5 mx-3"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <input type="hidden" value="client" name="role">
                                <input type="hidden" value="MarketPlace" name="platform">
                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-group-lable">{{ __('Name') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $user->name }}" readonly>
                                        </div>
                                    </div>

                                    <!-- Profile Photo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <div class="photo">
                                                <label for="image"
                                                    class="form-group-lable">{{ __('Photo') }}</label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                    accept="image/*">
                                            </div>
                                            <img id="preview-image" src="#" alt="Image Preview"
                                                style="display:none;">
                                        </div>
                                    </div>

                                    <!-- Company Name -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_name"
                                                class="form-group-lable">{{ __('Company Name') }}</label>
                                            <input type="text" class="form-control" id="company_name"
                                                name="company_name" required>
                                        </div>
                                    </div>

                                    <!-- Project -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="Project"
                                                class="form-group-lable">{{ __('Project Type') }}</label>
                                            <select name="project" id="project" class="form-control">
                                                <option value="" disabled selected>{{ __('Select Any One') }}</option>
                                                <option value="project">{{ __('Project') }}</option>
                                                <option value="remote-project">{{ __('Remote Project') }}</option>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Create User name-->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="create_user_name"
                                                class="form-group-lable">{{ __('Create User name') }}</label>
                                            <input type="text" class="form-control create_user_name"
                                                id="create_user_name" name="user_name" required>
                                        </div>
                                    </div>
                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="city" class="form-group-lable">{{ __('City') }}</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                required>
                                        </div>
                                    </div>
                                    <!-- Country -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="country"
                                                class="form-group-lable">{{ __('Country') }}</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                required>
                                        </div>
                                    </div>
                                    <!-- Create User name-->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="gst_number"
                                                class="form-group-lable">{{ __('GST Number') }}</label>
                                            <input type="text" class="form-control" id="gst_number"
                                                name="gst_number" required>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit"
                                    class="btn btn-primary mt-3 "><b>{{ __('Submit') }}</b></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- resources/views/swiper.blade.php -->
            <div class="col-md-6 col-6 p-0 client_slider_box">
                <div class="swiper-container client_slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ url('/admin_theme/marketplace/images/register2.jpg') }}" alt="Image">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ url('/admin_theme/marketplace/images/register3.jpg') }}" alt="Image">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ url('/admin_theme/marketplace/images/register4.jpg') }}" alt="Image">
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ url('admin_theme/marketplace/js/login.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('admin_theme/marketplace/js/profile.js') }}"></script>
 
</body>

</html>
