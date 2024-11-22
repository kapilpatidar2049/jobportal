@extends('jobportal.front.layouts.master')
@section('title', 'Contact Information')
@section('main-container')
    <div class="container">
        @php($user = Auth::guard('jobportal')->user())
        <div class="client-area">
            @include('jobportal.layouts.flash_msg')
            <form action="{{ route('jobportal.updateinfo', $id) }}" class="form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <h3>{{ __('Add Contact Information') }}</h3>
                    <!-- Name -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('Name') }} <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Please Enter Your Name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon"><i class="fa-solid fa-n"></i></div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phone_number" class="form-label">{{ __('Your phone number') }} </label>
                            <div class="country-code d-flex">
                                <div class="col-3">
                                    <select class="form-control form-control-padding_10" id="country_code"
                                        name="country_code">
                                        @php($countries = App\Models\Allcountry::where('phonecode', '!=', null)->get())
                                        @foreach ($countries as $item)
                                            <option value="+{{ $item->phonecode }}"
                                                {{ old('country_code', $user->country_code) == '+' . $item->phonecode ? 'selected' : '' }}>
                                                +{{ $item->phonecode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-9">
                                    <input type="text"
                                        class="form-control form-control-padding_10 @error('phone') is-invalid @enderror"
                                        name="phone" id="phone_number" value="{{ old('phone', $user->phone) }}"
                                        placeholder="Enter phone number">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="email" class="form-label">{{ __('Email') }}
                                    </label>
                                </div>
                                <div class="col-4">
                                    <div class="suggestion-icon float-end">
                                        <div class="tooltip-icon">
                                            <div class="tooltip">
                                                <div class="credit-block">
                                                    <small
                                                        class="recommended-font-size">{{ __(' You Can Not Change Your Email') }}</small>
                                                </div>
                                            </div>
                                            <span class="float-end"><i class="fa-solid fa-info"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ old('email', Auth::guard('jobportal')->user()->email) }}" readonly>
                            <div class="form-control-icon"><i class="fa-solid fa-envelope"></i></div>
                        </div>
                    </div>
                    <!-- City -->
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="city" class="form-label">{{ __('City') }}</label>
                            <input class="form-control form-control-padding_10 city_id @error('city') is-invalid @enderror"
                                type="text" name="city" placeholder="{{ __('Please Enter Your City Name') }}"
                                value="{{ $user->city }}" aria-label="city" id="city"
                                onchange="get_state_country(this.value)" required>
                            <input type="hidden" name="city" class="city_id">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- State -->
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="state" class="form-label">{{ __('State') }}</label>
                            <input
                                class="form-control form-control-padding_10 state_id @error('state') is-invalid @enderror"
                                type="text" name="state" placeholder="{{ __('Please Enter Your State Name') }}"
                                value="{{ $user->state }}" aria-label="state" id="state" readonly>
                            <input type="hidden" name="state" class="state_id">
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Country -->
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="country" class="form-label">{{ __('Country') }}</label>
                            <input
                                class="form-control form-control-padding_10 country_id @error('country') is-invalid @enderror"
                                type="text" name="country" value="{{ $user->country }}"
                                placeholder="{{ __('Please Enter Your Country Name') }}" aria-label="country"
                                id="country" readonly>
                            <input type="hidden" name="country" class="country_id">
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary"> {{ __('Continue') }} <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </form>

        </div>
    </div>
@endsection
