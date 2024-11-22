@extends('marketplace.layouts.master')
@section('title', 'Profile')
@section('page-title', 'Profile')
@section('body')<body data-sidebar="colored">@endsection
    @section('content')
        <div class="container">
            <h2 class="my-5">{{ __('Create Profile') }}</h2>
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Profile Photo -->
                <div class="form-group mb-3 profile_image_background">
                    <div class="photo">
                        {{-- <label for="imageinput" class="form-group-lable">{{ __('Photo') }}</label> --}}
                        <input type="file" class="form-control" id="imageinput" name="image" accept="image/*">
                    </div>
                    <img id="preview-image4" src="{{ url('images/' . $profile->image) }}" alt="Image Preview">
                </div>
                <input type="hidden" name="id" id="id" value="{{$profile->id}}"> 
                @if ($profile->role == 'user')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="name">{{ __('Full Name') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="name" name="name"
                                    value="{{ $profile->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Skill -->
                            <div class="form-group">
                                <label for="skill">{{ __('Skill') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="skill" name="skill"
                                    value="{{ $profile->skill }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Experience -->
                            <div class="form-group">
                                <label for="experience">{{ __('Experience') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="experience" name="experience"
                                    value="{{ $profile->experience }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Project -->
                            <div class="form-group">
                                <label for="project">{{ __('Project') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="project" name="project"
                                    value="{{ $profile->project }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Remote Project -->
                            <div class="form-group">
                                <label for="remote_project">{{ __('Remote Project') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="remote_project" name="remote_project"
                                    value="{{ $profile->remote_project }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Country -->
                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="country" name="country"
                                    value="{{ $profile->country }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- City -->
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="city" name="city"
                                    value="{{ $profile->city }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Area -->
                            <div class="form-group">
                                <label for="area">{{ __('Area') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="area" name="area"
                                    value="{{ $profile->area }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Pin code -->
                            <div class="form-group">
                                <label for="pincode">{{ __('Pin Code') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="pincode" name="pin_code"
                                    value="{{ $profile->pin_code }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Street Address -->
                            <div class="form-group">
                                <label for="street">{{ __('Street Address') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="street" name="street_address"
                                    value="{{ $profile->street_address }}" required>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($profile->role == 'client')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="name">{{ __('Full Name') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="name" name="name"
                                    value="{{ $profile->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Project -->
                            <div class="form-group">
                                <label for="project">{{ __('Project') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="project" name="project"
                                    value="{{ $profile->project }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Remote Project -->
                            <div class="form-group">
                                <label for="remote_project">{{ __('Remote Project') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="remote_project" name="remote_project"
                                    value="{{ $profile->remote_project }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- Country -->
                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="country" name="country"
                                    value="{{ $profile->country }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- City -->
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="city" name="city"
                                    value="{{ $profile->city }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- City -->
                            <div class="form-group">
                                <label for="gst_number">{{ __('GST') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="gst_number" name="gst_number"
                                    value="{{ $profile->gst_number }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- City -->
                            <div class="form-group">
                                <label for="user_name">{{ __('User Name') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="user_name" name="user_name"
                                    value="{{ $profile->user_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- City -->
                            <div class="form-group">
                                <label for="company_name">{{ __('Company Name') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="company_name" name="company_name"
                                    value="{{ $profile->company_name }}" required>
                            </div>
                        </div>
                        <!-- Profile Photo -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="photo">
                                    <label for="company_logo" class="form-group-lable">{{ __('Company Logo') }}</label>
                                    <input type="file" class="form-control form_input_shadow" id="company_logo" name="company_logo"
                                        accept="image/*">
                                </div>
                                <img class="company_logo" src="{{ url('images/' . $profile->company_logo) }}"
                                    alt="Image Preview">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- City -->
                            <div class="form-group">
                                <label for="company_description">{{ __('Company Description') }}</label>
                                <input type="text" class="form-control form_input_shadow" id="company_description"
                                    name="company_description" value="{{ $profile->company_description }}" required>
                            </div>
                        </div>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary mt-5">{{ __('Save Profile') }}</button>
            </form>
        </div>
    @endsection
