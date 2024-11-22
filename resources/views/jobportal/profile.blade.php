@extends('jobportal.front.layouts.master')
@section('title', 'My Profile')
@section('main-container')
    <div class="container">
        <div class="client-area">
            @include('jobportal.layouts.flash_msg')
            <form action="{{ route('jobportal.saveProfile') }}" class="form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <h3>{{ __('My Profile') }}</h3>

                    <!-- Profile Image -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" accept="image/*" onchange="readURL(this);" class="form-control"
                                        id="profile_image" name="profile">
                                </div>
                                <div class="col-2">
                                    @if (!$user->image)
                                        <img src="{{ Avatar::create($user->email) }}" class="img-fluid" id="profile"
                                            alt="{{ $user->email }}">
                                    @else
                                        <img src="{{ url('jobportal/user/' . $user->image) }}" alt="{{ $user->email }}"
                                            id="profile" class="img-fluid form-control-padding_10">
                                    @endif
                                </div>
                            </div>
                            <div class="form-control-icon"><i class="fa-solid fa-upload"></i></div>
                        </div>
                    </div>

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
                            <label for="phone_number" class="form-label">{{ __('Your phone number') }} <span
                                    class="required">*</span></label>
                            <div class="country-code d-flex">
                                <div class="col-3">
                                    <select class="form-control form-control-padding_10" id="country_code"
                                        name="country_code">
                                        @php($countries = App\Models\Allcountry::where('phonecode', '!=', null)->get())
                                        @foreach ($countries as $item)
                                            <option value="+{{ $item->phonecode }}"
                                                {{ old('country_code',  $user->country_code) == '+' . $item->phonecode ? 'selected' : '' }}>
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
                            <label for="email" class="form-label">{{ __('Email') }} <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ old('email', Auth::guard('jobportal')->user()->email) }}" readonly>
                            <div class="form-control-icon"><i class="fa-solid fa-envelope"></i></div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address" class="form-label">{{ __('Street Address') }} <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" placeholder="Please Enter Your Address"
                                value="{{ old('address', $user->address) }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon"><i class="fa-solid fa-location-crosshairs"></i></div>
                        </div>
                    </div>

                    <!-- Pincode -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pincode" class="form-label">{{ __('Pincode') }} <span
                                    class="required">*</span></label>
                            <input type="number" class="form-control @error('pincode') is-invalid @enderror" id="pincode"
                                name="pincode" placeholder="Please Enter Your Pincode"
                                value="{{ old('pincode', $user->pincode) }}">
                                <div class="form-control-icon"><img src="{{url('jobportal/icon/zipcode.svg')}}" alt="" width="25px" class="img-fluid"></div>
                            @error('pincode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- City -->
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="city" class="form-label">{{ __('City') }}
                                <span class="required">*</span>
                            </label>
                            <input class="form-control form-control-padding_10 city_id @error('city') is-invalid @enderror"
                                type="text" name="city" placeholder="{{ __('Please Enter Your City Name') }}" value="{{$user->city}}"
                                aria-label="city" id="city" onchange="get_state_country(this.value)" required>
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
                            <label for="state" class="form-label">{{ __('State') }}
                                <span class="required">*</span>
                            </label>
                            <input
                                class="form-control form-control-padding_10 state_id @error('state') is-invalid @enderror"
                                type="text" name="state" placeholder="{{ __('Please Enter Your State Name') }}" value="{{$user->state}}"
                                aria-label="state" id="state" readonly>
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
                            <label for="country" class="form-label">{{ __('Country') }}
                                <span class="required">*</span>
                            </label>
                            <input
                                class="form-control form-control-padding_10 country_id @error('country') is-invalid @enderror"
                                type="text" name="country" value="{{$user->country}}"
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
                    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> {{ __('Save') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection

