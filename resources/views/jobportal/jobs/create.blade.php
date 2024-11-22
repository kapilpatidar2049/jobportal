@extends('jobportal.layouts.master')
@section('title', 'Create New Job')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Create New Job') }}
            @endslot
            @slot('menu2')
                {{ __('Create New Job') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <form id="multiStepForm" action="{{ route('jobportal.jobstore') }}" method="post">
                        @csrf
                        <!-- Step 1 -->
                        <div class="step active">
                            <div class="row">
                                @php($company = App\Models\Jobportal\CompnyDetail::where('user_id', Auth::guard('jobportal')->user()->id)->first())
                                <h3>{{ __('Add job basics') }}</h3>
                                @php($language = App\Models\Jobportal\Language::where('code', $company->language)->first())
                                <div class="text-center">
                                    <p>
                                        {{ __('The job post will be in ') }} <span class="fs-5" id="selectlang">
                                            {{ $language->name }}</span>
                                        {{ __('in ') }}<span class="fs-5 selectcountry"
                                            id="selectcountry">{{ $company->country }}</span>
                                        <button class="btn" type="button" data-bs-toggle="modal"
                                            data-bs-target="#langcountry"><i class="fa-solid fa-pen"></i></button>
                                    </p>
                                    <!-- Modal -->
                                    <div class="modal fade" id="langcountry" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="langcountryLabel">
                                                        {{ __('Edit language and country') }}</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @php($languages = App\Models\Jobportal\Language::all())
                                                    <div class="form-group">
                                                        <label for="language"
                                                            class="form-label">{{ __('Language of job post') }}</label>
                                                        <select name="language" id="language"
                                                            class="form-control form-control-padding_10 form-select">
                                                            @foreach ($languages as $item)
                                                                <option value="{{ $item->name }}"
                                                                    @if (old('language', $company->language) == $item->code) selected @endif>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country"
                                                            class="form-label">{{ __('Country where job post is shown') }}</label>
                                                        @php($countries = App\Models\Allcountry::where('phonecode', '!=', null)->get())
                                                        <select name="country" id="country"
                                                            class="form-control form-control-padding_10 form-select">
                                                            @foreach ($countries as $item)
                                                                <option value="{{ $item->name }}"
                                                                    @if (old('country', $company->country) == $item->name) selected @endif>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" data-bs-dismiss="modal" id="savelang"
                                                        class="btn btn-primary">{{ __('Done') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">
                                            {{ __('Job Title') }} <span class="required">*</span>
                                        </label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" placeholder="{{ __('Enter Job Title') }}">
                                        <div class="form-control-icon">
                                            <i class="fa-solid fa-heading"></i>
                                        </div>
                                        @error('title')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="jobtype" class="form-label">
                                            {{ __('Which option best describes this Job`s location?') }} <span
                                                class="required">*</span>
                                        </label>
                                        <select name="type" id="jobtype"
                                            class="form-control form-control-padding_10 form-select">
                                            <option value="on-site" @if (old('type') == 'on-site') selected @endif>
                                                On-Site</option>
                                            <option value="remote" @if (old('type') == 'remote') selected @endif>Remote
                                            </option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 @if (old('type') == 'remote') d-none @endif" id="city">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="city" class="form-label">{{ __('City') }}
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        class="form-control form-control-padding_10 city_id @error('city') is-invalid @enderror"
                                                        type="text" name="city" placeholder="{{ __('Please Enter Your City Name') }}"
                                                        aria-label="city" id="city" onchange="get_state_country(this.value)" required>
                                                    <input type="hidden" name="city" class="city_id">
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="state" class="form-label">{{ __('State') }}
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        class="form-control form-control-padding_10 state_id @error('state') is-invalid @enderror"
                                                        type="text" name="state" placeholder="{{ __('Please Enter Your State Name') }}"
                                                        aria-label="state" id="state" readonly>
                                                    <input type="hidden" name="state" class="state_id">
                                                    @error('state')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="country" class="form-label">{{ __('Country') }}
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input
                                                        class="form-control form-control-padding_10 country_id @error('country') is-invalid @enderror"
                                                        type="text" name="country"
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

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="area" class="form-label">
                                                    {{ __('Area') }}
                                                </label>
                                                <input type="text" name="area" id="area"
                                                    class="form-control @error('area') is-invalid @enderror"
                                                    value="{{ old('area') }}" placeholder="{{ __('Enter Area') }}">
                                                <div class="form-control-icon">
                                                    <i class="fa-solid fa-chart-area"></i>
                                                </div>
                                                @error('area')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="address" class="form-label">
                                                    {{ __('Address') }}
                                                </label>
                                                <input type="text" name="address" id="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    value="{{ old('address') }}"
                                                    placeholder="{{ __('Enter Address') }}">
                                                <div class="form-control-icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                @error('address')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="pincode" class="form-label">
                                                    {{ __('Pincode') }}
                                                </label>
                                                <input type="text" name="pincode" id="pincode"
                                                    class="form-control form-control-padding_10 @error('pincode') is-invalid @enderror"
                                                    value="{{ old('pincode') }}"
                                                    placeholder="{{ __('Enter PinCode') }}">
                                                @error('pincode')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row @if (old('type') == 'on-site') d-none @endif" id="ads">
                                        <div class="form-group">
                                            <h6 class="form-label">
                                                {{ __('Do you want to advertise your job in a specific city? ') }}
                                                <span class="required">*</span>
                                            </h6>
                                            <input type="radio" id="yes" value="yes" name="ads"
                                                @if (old('ads') == 'yes') checked @endif>
                                            <label for="yes">Yes</label>
                                            <input type="radio" id="no" value="no" name="ads"
                                                @if (old('ads') == 'no') checked @endif checked>
                                            <label for="no">No(Anywhere in
                                                <span class="selectcountry">{{ $company->country }}</span>)</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-none" id="adsloc">
                                        <div class="form-group">
                                            <label for="adscity"
                                                class="form-label">{{ __('Where do you want to advertise this job?') }}
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control form-control-padding_10"
                                                name="adscity" value="{{ old('adscity') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary next-btn ">{{ __('Next ') }}<i
                                        class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step">
                            <h3>{{ __('Add job details') }}</h3>
                            <h6>{{ __('Job Type') }} <span class="required">*</span></h6>
                            <div class="job-buttons my-3">
                                @foreach (['Full-time', 'Permanent', 'Fresher', 'Part-time', 'Internship', 'Contractual/Temporary', 'Freelance', 'Volunteer'] as $type)
                                    <label class="job-btn">
                                        <i class="fas fa-plus"></i>
                                        <input type="checkbox" name="job_type[]" value="{{ $type }}"
                                            class="form-control @error('job_type') is-invalid @enderror"
                                            @if (is_array(old('job_type')) && in_array($type, old('job_type'))) checked @endif>
                                        {{ $type }}
                                    </label>
                                @endforeach
                            </div>
                            @error('job_type')
                                <span class="text-danger d-block">{{ $message }}</span>
                            @enderror
                            <div class="col-lg-6">
                                <div class="row @if (!is_array(old('job_type')) || !in_array('Freelance', old('job_type'))) d-none @endif" id="freelancediv">
                                    <h6>{{ __('How long is the contract?') }}</h6>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="timelength" class="form-label">{{ __('Length') }}</label>
                                            <input type="number" name="timelength" id="timelength"
                                                class="form-control form-control-padding_10 @error('timelength') is-invalid @enderror"
                                                value="{{ old('timelength') }}">
                                            @error('timelength')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="timeperiod" class="form-label">{{ __('Length') }}</label>
                                            <select name="timeperiod" id="timeperiod"
                                                class="form-control form-control-padding_10 form-select @error('timeperiod') is-invalid @enderror">
                                                <option value="days" @if (old('timeperiod') == 'days') selected @endif>
                                                    {{ __('days') }}</option>
                                                <option value="weeks" @if (old('timeperiod') == 'weeks') selected @endif>
                                                    {{ __('weeks') }}</option>
                                                <option value="months" @if (old('timeperiod') == 'months') selected @endif>
                                                    {{ __('months') }}</option>
                                            </select>
                                            @error('timeperiod')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Part time Div -->
                            <div class="col-lg-12">
                                <div class="row align-items-center @if (!is_array(old('job_type')) || !in_array('Part-time', old('job_type'))) d-none @endif"
                                    id="parttimediv">
                                    <h6>{{ __('Expected hours') }}</h6>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="showby" class="form-label">{{ __('Show by') }}</label>
                                            <select name="showby" id="showby"
                                                class="form-control form-control-padding_10 form-select">
                                                <option value="fixed hours"
                                                    @if (old('showby') == 'fixed hours') selected @endif>
                                                    {{ __('Fixed Hours') }}</option>
                                                <option value="Range" @if (old('showby') == 'Range') selected @endif>
                                                    {{ __('Range') }}</option>
                                                <option value="Minimum"
                                                    @if (old('showby') == 'Minimum') selected @endif>{{ __('Minimum') }}
                                                </option>
                                                <option value="Maximum"
                                                    @if (old('showby') == 'Maximum') selected @endif>{{ __('Maximum') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="fixed">
                                        <div class="form-group">
                                            <label for="fixedhours" class="form-label">{{ __('Fixed at') }}</label>
                                            <input type="text" class="form-control form-control-padding_10"
                                                name="minimumhours" id="fixedhours" value="{{ old('minimumhours') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-auto @if (old('showby') != 'Range') d-none @endif"
                                        id="range">
                                        <div class="row">

                                            <div class="col-auto">
                                                <div id="minimumdiv">
                                                    <div class="form-group">
                                                        <label for="minimum"
                                                            class="form-label">{{ __('Minimum') }}</label>
                                                        <input type="text" class="form-control form-control-padding_10"
                                                            name="minimumhours" id="minimum"
                                                            value="{{ old('minimumhours') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <div id="maximumdiv">
                                                    <div class="form-group">
                                                        <label for="maximum"
                                                            class="form-label">{{ __('Maximum') }}</label>
                                                        <input type="text" class="form-control form-control-padding_10"
                                                            name="maximumhours" id="maximum"
                                                            value="{{ old('maximumhours') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>{{ __('Hours per week') }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h6>{{ __('Schedule') }} <span class="required">*</span></h6>
                            <div class="job-buttons my-3">
                                @foreach (['Day Shift', 'Morning Shift', 'Rotational Shift', 'Night Shift', 'Monday To Friday', 'Evening Shift', 'Weekend Availability', 'US Shift', 'UK Shift', 'Weekend Only', 'Other'] as $schedule)
                                    <label class="job-btn">
                                        <i class="fas fa-plus"></i>
                                        <input type="checkbox" name="schedule[]" value="{{ $schedule }}"
                                            @if (is_array(old('schedule')) && in_array($schedule, old('schedule'))) checked @endif>
                                        {{ $schedule }}
                                    </label>
                                @endforeach
                            </div>
                            @error('schedule')
                                <span class="text-danger d-block">{{ $message }}</span>
                            @enderror

                            <hr>

                            <h6>{{ __('Is there a planned start date for this job?') }}</h6>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input type="radio" id="startdateyes" value="yes" name="startdate"
                                            @if (old('startdate') == 'yes') checked @endif>
                                        <label for="startdateyes">{{ __('Yes') }}</label>
                                        <input type="radio" id="startdateno" value="no" name="startdate"
                                            @if (old('startdate', 'no') == 'no') checked @endif>
                                        <label for="startdateno">{{ __('No') }}</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 @if (old('startdate') != 'yes') d-none @endif" id="startdate">
                                    <div class="form-group">
                                        <input type="date" min="{{ date('Y-m-d') }}" name="startdatefield"
                                            class="form-control form-control-padding_10 @error('startdatefield') is-invalid @enderror"
                                            value="{{ old('startdatefield') }}">
                                        @error('startdatefield')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="numberofpeople" class="form-label">
                                            {{ __('Number of people you wish to hire for this job') }} <span
                                                class="required">*</span>
                                        </label>
                                        <select name="numberofpeople" id="numberofpeople"
                                            class="form-control form-control-padding_10 form-select @error('numberofpeople') is-invalid @enderror">
                                            <option value="" disabled selected>{{ __('Select an Option') }}</option>
                                            @foreach (range(1, 10) as $number)
                                                <option value="{{ $number }}"
                                                    @if (old('numberofpeople') == $number) selected @endif>{{ $number }}
                                                </option>
                                            @endforeach
                                            <option value="10+" @if (old('numberofpeople') == '10+') selected @endif>
                                                {{ __('10+') }}</option>
                                        </select>
                                        @error('numberofpeople')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="recruitment_timeline" class="form-label">
                                            {{ __('Recruitment timeline for this job') }} <span class="required">*</span>
                                        </label>
                                        <select name="recruitment_timeline" id="recruitment_timeline"
                                            class="form-control form-control-padding_10 form-select @error('recruitment_timeline') is-invalid @enderror">
                                            <option value="" disabled selected>{{ __('Select an Option') }}</option>
                                            <option value="1 to 3 days"
                                                @if (old('recruitment_timeline') == '1 to 3 days') selected @endif>{{ __('1 to 3 days') }}
                                            </option>
                                            <option value="3 to 7 days"
                                                @if (old('recruitment_timeline') == '3 to 7 days') selected @endif>{{ __('3 to 7 days') }}
                                            </option>
                                            <option value="1 to 2 weeks"
                                                @if (old('recruitment_timeline') == '1 to 2 weeks') selected @endif>
                                                {{ __('1 to 2 weeks') }}</option>
                                            <option value="2 to 4 weeks"
                                                @if (old('recruitment_timeline') == '2 to 4 weeks') selected @endif>
                                                {{ __('2 to 4 weeks') }}</option>
                                            <option value="More than 4 weeks"
                                                @if (old('recruitment_timeline') == 'More than 4 weeks') selected @endif>
                                                {{ __('More than 4 weeks') }}</option>
                                        </select>
                                        @error('recruitment_timeline')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary back-btn">
                                    <i class="fa-solid fa-arrow-left"></i> {{ __('Back') }}
                                </button>
                                <button type="button" class="btn btn-primary next-btn">{{ __('Next') }} <i
                                        class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="step">
                            <h3>{{ __('Add pay and benefits') }}</h3>
                            <div class="col-lg-12">
                                <div class="row align-items-center">
                                    <h6>{{ __('Expected hours') }}</h6>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="payby" class="form-label">{{ __('Show by') }}</label>
                                            <select name="pay" id="payby"
                                                class="form-control form-control-padding_10 form-select @error('pay') is-invalid @enderror">
                                                <option value="Range" @if (old('pay') == 'Range') selected @endif>
                                                    Range</option>
                                                <option value="Exact Amount"
                                                    @if (old('pay') == 'Exact Amount') selected @endif>Exact Amount
                                                </option>
                                                <option value="Minimum"
                                                    @if (old('pay') == 'Minimum') selected @endif>Minimum</option>
                                                <option value="Maximum"
                                                    @if (old('pay') == 'Maximum') selected @endif>Maximum</option>
                                            </select>
                                            @error('pay')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 @if (old('pay') != 'Exact Amount') d-none @endif"
                                        id="exact">
                                        <div class="form-group">
                                            <label for="exactamount" class="form-label">{{ __('Exact Amount') }}</label>
                                            <input type="text"
                                                class="form-control form-control-padding_10 @error('exactamount') is-invalid @enderror"
                                                placeholder="{{ __('Enter Amount') }}" name="exactamount"
                                                id="exactamount" value="{{ old('exactamount') }}">
                                            @error('exactamount')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-auto" id="amountrange">
                                        <div class="row">
                                            <div class="col-auto" id="minimumamountdiv">
                                                <div class="form-group">
                                                    <label for="minimumamount"
                                                        class="form-label">{{ __('Minimum Amount') }}</label>
                                                    <input type="text"
                                                        class="form-control form-control-padding_10 @error('minimumamount') is-invalid @enderror"
                                                        name="minimumamount" id="minimumamount"
                                                        value="{{ old('minimumamount') }}">
                                                    @error('minimumamount')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-auto" id="maximumamountdiv">
                                                <div class="form-group">
                                                    <label for="maximumamount"
                                                        class="form-label">{{ __('Maximum Amount') }}</label>
                                                    <input type="text"
                                                        class="form-control form-control-padding_10 @error('maximumamount') is-invalid @enderror"
                                                        name="maximumamount" id="maximumamount"
                                                        value="{{ old('maximumamount') }}">
                                                    @error('maximumamount')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="rate" class="form-label">{{ __('Rate') }}</label>
                                            <select name="rate" id="rate"
                                                class="form-control form-control-padding_10 form-select @error('rate') is-invalid @enderror">
                                                <option value="per hour"
                                                    @if (old('rate') == 'per hour') selected @endif> per hour</option>
                                                <option value="per day"
                                                    @if (old('rate') == 'per day') selected @endif> per day</option>
                                                <option value="per week"
                                                    @if (old('rate') == 'per week') selected @endif> per week</option>
                                                <option value="per month"
                                                    @if (old('rate') == 'per month') selected @endif> per month</option>
                                                <option value="per year"
                                                    @if (old('rate') == 'per year') selected @endif> per year</option>
                                            </select>
                                            @error('rate')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h6>{{ __('Supplement Pay') }}</h6>
                            <div class="job-buttons my-3">
                                @foreach (['Performance bonus', 'Yearly bonus', 'Commission pay', 'Overtime pay', 'Quarterly bonus', 'Shift allowance', 'Joining bonus', 'Other'] as $supplement)
                                    <label class="job-btn">
                                        <i class="fas fa-plus"></i>
                                        <input type="checkbox" name="supplement[]" value="{{ $supplement }}"
                                            @if (is_array(old('supplement')) && in_array($supplement, old('supplement'))) checked @endif>
                                        {{ $supplement }}
                                    </label>
                                @endforeach
                            </div>
                            <hr>
                            <h6>{{ __('Benefits') }} </h6>
                            <div class="job-buttons my-3">
                                @foreach (['Health insurance', 'Provident Fund', 'Cell phone reimbursement', 'Paid sick time', 'Work from home', 'Paid time off', 'Food provided', 'Life insurance', 'Internet reimbursement', 'Commuter assistance', 'Leave encashment', 'Flexible schedule', 'Other'] as $benefit)
                                    <label class="job-btn">
                                        <i class="fas fa-plus"></i>
                                        <input type="checkbox" name="benefit[]" value="{{ $benefit }}"
                                            @if (is_array(old('benefit')) && in_array($benefit, old('benefit'))) checked @endif>
                                        {{ $benefit }}
                                    </label>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary back-btn">
                                    <i class="fa-solid fa-arrow-left"></i>{{ __(' Back ') }}
                                </button>
                                <button type="button" class="btn btn-primary next-btn">{{ __('Next ') }}
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="step">
                            <h6>{{ __('Job Description') }} <span class="required">*</span></h6>
                            <textarea name="job_description" id="desc" cols="30" rows="10"
                                class="@error('job_description') is-invalid @enderror">{{ old('job_description') }}</textarea>
                            @error('job_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div class="d-flex justify-content-between my-3">
                                <button type="button" class="btn btn-secondary back-btn">
                                    <i class="fa-solid fa-arrow-left"></i>{{ __(' Back ') }}
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-floppy-disk"></i>{{ __(' Submit ') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('jobportal/js/multistepform.js') }}"></script>
    <script src="{{ url('jobportal/js/createjob.js') }}"></script>
@endsection
