@extends('jobportal.layouts.master')
@section('title', ' Job Review Live')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Job Review Live') }}
            @endslot
            @slot('menu2')
                {{ __('Job Review Live') }}
            @endslot
        @endcomponent
    </div>
    @php($company = App\Models\Jobportal\CompnyDetail::where('user_id', Auth::guard('jobportal')->user()->id)->first())
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <h4>{{ __('Job details') }}</h4>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <h6>{{ __('Job Title') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div>
                                <span id="jobtitle">{{ $job->title }}</span>
                            </div>
                            <div>
                                <i class="fa-regular fa-pen-to-square" type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#titleModal"></i>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Number of openings') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <span id="openings">{{ $job->numberofpeople }}</span>
                            <i class="fa-regular fa-pen-to-square" type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#numberofopeningModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Country and language') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div>
                                <p>
                                    <span id="jobloc">{{ $job->country }}</span>
                                    <br>
                                    <span id="joblang">{{ $job->language }}</span>
                                </p>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#langcountry"></i>
                        </div>
                        @if ($job->type == 'remote')
                            <div class="col-4 mb-3">
                                <h6>{{ __('Advertising location') }} </h6>
                            </div>
                            <div class="col-8 d-flex justify-content-between mb-3">
                                {{ $job->adscity ? $job->adscity : $job->country }}
                                <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                    data-bs-target="#settingModal"></i>
                            </div>
                        @else
                            <div class="col-4 mb-3">
                                <h6>{{ __('Location') }} </h6>
                            </div>
                            <div class="col-8 d-flex justify-content-between mb-3">
                                <span id="city_display">{{ $job->city }}</span>
                                <i class="fa-regular fa-pen-to-square" type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#locationModal"></i>
                            </div>
                        @endif
                        <div class="col-4 mb-3">
                            <h6>{{ __('Job Type') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div>
                                <ul class="list-group" id="job_type_list">
                                    @foreach ($job->job_type as $job_type)
                                        <li>{{ $job_type }}</li>
                                    @endforeach
                                </ul>
                                <span id="selectedJobType"></span>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#jobtypeModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Schedule') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <ul class="list-group" id="schedualelist">
                                @foreach ($job->schedule as $schedule)
                                    <li>{{ $schedule }}</li>
                                @endforeach
                            </ul>
                            <span id="selectedScheduale"></span>
                            <i class="fa-regular fa-pen-to-square" type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#scheduleModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Pay') }}</h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div>
                                <span id="selectedPayDetails"></span>
                                <div id="jobpayment">
                                    @if ($job->pay == 'Range')
                                        @php($changedCurrency = Session::get('changed_currency'))
                                        {{ currency($job->minimumamount, $job->currency, $changedCurrency) }} -
                                        {{ currency($job->maximumamount, $job->currency, $changedCurrency) }}
                                        {{ $job->rate }}
                                    @elseif($job->pay == 'Exact Amount')
                                        @php($changedCurrency = Session::get('changed_currency'))
                                        {{ currency($job->exactamount, $job->currency, $changedCurrency) }}
                                        {{ $job->rate }}
                                    @elseif($job->pay == 'Minimum')
                                        @php($changedCurrency = Session::get('changed_currency'))
                                        {{ currency($job->minimumamount, $job->currency, $changedCurrency) }}
                                        {{ $job->rate }}
                                    @else
                                        @php($changedCurrency = Session::get('changed_currency'))
                                        {{ currency($job->maximumamount, $job->currency, $changedCurrency) }}
                                        {{ $job->rate }}
                                    @endif
                                </div>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#payModal" class="btn"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Supplemental Pay') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div>
                                <ul class="list-group" id="supplementlist">
                                    @foreach ($job->supplement as $supplement)
                                        <li>{{ $supplement }}</li>
                                    @endforeach
                                </ul>
                                <div id="selectedSupplements"></div>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-target="#supplementpayModal"
                                data-bs-toggle="modal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Benefits') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div>
                                <div id="selectedBenefits"></div>
                                <ul class="list-group" id="benefitlist">
                                    @foreach ($job->benefit as $benefit)
                                        <li>{{ $benefit }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#benefitModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Job Description') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div id="jobDescription">
                                <div id="shortDescription" class="d-block">{!! \Illuminate\Support\Str::words($job->job_description, 50, '...') !!}</div>
                                <div id="fullDescription" class="d-none">{!! $job->job_description !!}</div>
                                <a href="javascript:void(0);" id="toggleDescription" onclick="toggleText()">Show Full
                                    Text</a>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#descriptionModal"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @php($emails = App\Models\Jobportal\JobPreference::where('job_id', $job->id)->first())
                        <h4>{{ __('Settings') }}</h4>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Require CV') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div id="updatedcv">
                                {{ $emails->requirecv }}
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#settingModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Application updates') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">

                            @php($emailArray = $emails ? json_decode($emails->email, true) : [])
                            <div id="newemail">
                                <ul class="list-group" id="emailist">
                                    @foreach ($emailArray as $email)
                                        <li>{{ $email }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#settingModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Candidates contact you (email)') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            @if ($emails->contactmail == 1)
                                By email to the address provided
                            @else
                                No
                            @endif
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#settingModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Application deadline') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div id="updateddeadline">
                                {{ $emails->deadline }}
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#settingModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Recruitment timeline') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div id="updatedrecruitment_timeline">
                                {{ $job->recruitment_timeline }}
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#requirementModal"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <h6>{{ __('Expected start date') }} </h6>
                        </div>
                        <div class="col-8 d-flex justify-content-between mb-3">
                            <div id="updateddeadlinetime">
                                {{ $emails->deadlinetime }}
                            </div>
                            <i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
                                data-bs-target="#settingModal"></i>
                        </div>
                    </div>
                    <!-- Edit Title Modal -->
                    <div class="modal fade" id="titleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="jobTitleForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __('Job Title') }} </label>
                                            <input type="text" id="title"
                                                class="form-control form-control-padding_10" value="{{ $job->title }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Number of Opening Modal -->
                    <div class="modal fade" id="numberofopeningModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="numberOfOpeningsForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="numberofpeople" class="form-label">{{ __('Number of Openings') }}
                                            </label>
                                            <select name="numberofpeople" id="numberofpeople"
                                                class="form-control form-control-padding_10 form-select @error('numberofpeople') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('Select an Option') }}
                                                </option>
                                                @foreach (range(1, 10) as $number)
                                                    <option value="{{ $number }}"
                                                        @if ($job->numberofpeople) == $number) selected @endif>
                                                        {{ $number }}
                                                    </option>
                                                @endforeach
                                                <option value="10+" @if ($job->numberofpeople == '10+') selected @endif>
                                                    {{ __('10+') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit language and country Modal -->
                    <div class="modal fade" id="langcountry" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="langcountryLabel">
                                        {{ __('Edit language and country') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" id="languageCountryForm">
                                    <div class="modal-body">
                                        @php($languages = App\Models\Jobportal\Language::all())
                                        <div class="form-group">
                                            <label for="language"
                                                class="form-label">{{ __('Language of job post') }}</label>
                                            <select name="language" id="language"
                                                class="form-control form-control-padding_10 form-select">
                                                @foreach ($languages as $item)
                                                    <option value="{{ $item->name }}"
                                                        @if (old('language', $job->language) == $item->code) selected @endif>
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
                                                        @if ($job->country == $item->name) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Done') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Location Modal -->
                    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="jobtype" class="form-label">
                                                    {{ __('Which option best describes this Job`s location?') }} <span
                                                        class="required">*</span>
                                                </label>
                                                <select name="type" id="jobtype"
                                                    class="form-control form-control-padding_10 form-select">
                                                    <option value="on-site"
                                                        @if ($job->type == 'on-site') selected @endif>
                                                        On-Site</option>
                                                    <option value="remote"
                                                        @if ($job->type == 'remote') selected @endif>Remote
                                                    </option>
                                                </select>
                                                @error('type')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 @if ($job->type == 'remote') d-none @endif"
                                            id="city">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="cityfeild" class="form-label">
                                                            {{ __('City') }} <span class="required">*</span>
                                                        </label>
                                                        <input type="text" name="city" id="cityfeild"
                                                            class="form-control @error('city') is-invalid @enderror"
                                                            value="{{ $job->city }}"
                                                            placeholder="{{ __('Enter City Name') }}">
                                                        <div class="form-control-icon">
                                                            <i class="fa-solid fa-city"></i>
                                                        </div>
                                                        @error('city')
                                                            <span class="invalid-feedback">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="area" class="form-label">
                                                            {{ __('Area') }}
                                                        </label>
                                                        <input type="text" name="area" id="area"
                                                            class="form-control @error('area') is-invalid @enderror"
                                                            value="{{ $job->area }}"
                                                            placeholder="{{ __('Enter Area') }}">
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
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address" class="form-label">
                                                            {{ __('Address') }}
                                                        </label>
                                                        <input type="text" name="address" id="address"
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            value="{{ $job->address }}"
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
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pincode" class="form-label">
                                                            {{ __('Pincode') }}
                                                        </label>
                                                        <input type="text" name="pincode" id="pincode"
                                                            class="form-control form-control-padding_10 @error('pincode') is-invalid @enderror"
                                                            value="{{ $job->pincode }}"
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
                                            <div class="row @if ($job->type == 'on-site') d-none @endif"
                                                id="ads">
                                                <div class="form-group">
                                                    <h6 class="form-label">
                                                        {{ __('Do you want to advertise your job in a specific city? ') }}
                                                        <span class="required">*</span>
                                                    </h6>
                                                    <input type="radio" id="yes" value="yes" name="ads"
                                                        @if ($job->ads == 'yes') checked @endif>
                                                    <label for="yes">Yes</label>
                                                    <input type="radio" id="no" value="no" name="ads"
                                                        @if ($job->ads == 'no') checked @endif checked>
                                                    <label for="no">No(Anywhere in
                                                        <span
                                                            class="selectcountry">{{ $company->country }}</span>)</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-none" id="adsloc">
                                                <div class="form-group">
                                                    <label for="adscity"
                                                        class="form-label">{{ __('Where do you want to advertise this job?') }}
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-padding_10"
                                                        name="adscity" value="{{ $job->adscity }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Job Type Modal -->
                    <div class="modal fade" id="jobtypeModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="jobTypeForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __('Job Type') }} </label>
                                            <div class="job-buttons my-3">
                                                @foreach (['Full-time', 'Permanent', 'Fresher', 'Part-time', 'Internship', 'Contractual/Temporary', 'Freelance', 'Volunteer'] as $type)
                                                    <label
                                                        class="job-btn  @if (in_array($type, $job->job_type)) selected @endif">
                                                        @if (in_array($type, $job->job_type))
                                                            <i class="fas fa-check"></i>
                                                        @else
                                                            <i class="fas fa-plus"></i>
                                                        @endif

                                                        <input type="checkbox" name="job_type[]"
                                                            value="{{ $type }}"
                                                            @if (in_array($type, $job->job_type)) checked  class="form-control @error('job_type') is-invalid @enderror" @endif>
                                                        {{ $type }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Schedual Modal -->
                    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __('Schedual') }} </label>
                                            <div class="job-buttons my-3">
                                                @foreach (['Day Shift', 'Morning Shift', 'Rotational Shift', 'Night Shift', 'Monday To Friday', 'Evening Shift', 'Weekend Availability', 'US Shift', 'UK Shift', 'Weekend Only', 'Other'] as $schedule)
                                                    <label
                                                        class="job-btn  @if (in_array($schedule, $job->schedule)) selected @endif">
                                                        @if (in_array($schedule, $job->schedule))
                                                            <i class="fas fa-check"></i>
                                                        @else
                                                            <i class="fas fa-plus"></i>
                                                        @endif

                                                        <input type="checkbox" name="scheduale[]"
                                                            value="{{ $schedule }}"
                                                            @if (in_array($schedule, $job->schedule)) checked  class="form-control @error('schedule') is-invalid @enderror" @endif>
                                                        {{ $schedule }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="SUBMIT" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Pay Modal -->
                    <div class="modal fade" id="payModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="row align-items-center">
                                                <h6>{{ __('Expected hours') }}</h6>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="payby"
                                                            class="form-label">{{ __('Show by') }}</label>
                                                        <select name="pay" id="payby"
                                                            class="form-control form-control-padding_10 form-select @error('pay') is-invalid @enderror">
                                                            <option value="Range"
                                                                @if ($job->pay == 'Range') selected @endif>
                                                                Range</option>
                                                            <option value="Exact Amount"
                                                                @if ($job->pay == 'Exact Amount') selected @endif>Exact
                                                                Amount
                                                            </option>
                                                            <option value="Minimum"
                                                                @if ($job->pay == 'Minimum') selected @endif>Minimum
                                                            </option>
                                                            <option value="Maximum"
                                                                @if ($job->pay == 'Maximum') selected @endif>Maximum
                                                            </option>
                                                        </select>
                                                        @error('pay')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 @if ($job->pay != 'Exact Amount') d-none @endif"
                                                    id="exact">
                                                    <div class="form-group">
                                                        <label for="exactamount"
                                                            class="form-label">{{ __('Exact Amount') }}</label>
                                                        <input type="number"
                                                            class="form-control form-control-padding_10 @error('exactamount') is-invalid @enderror"
                                                            placeholder="{{ __('Enter Amount') }}" name="exactamount"
                                                            id="exactamount"
                                                            value="{{ old('exactamount', $job->exactamount) }}">
                                                        @error('exactamount')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-auto @if ($job->pay == 'Exact Amount') d-none @endif"
                                                    id="amountrange">
                                                    <div class="row">
                                                        <div class="col-auto" id="minimumamountdiv">
                                                            <div class="form-group">
                                                                <label for="minimumamount"
                                                                    class="form-label">{{ __('Minimum Amount') }}</label>
                                                                <input type="number"
                                                                    class="form-control form-control-padding_10 @if ($job->pay == 'Maximum') d-none @endif @error('minimumamount') is-invalid @enderror"
                                                                    name="minimumamount" id="minimumamount"
                                                                    value="{{ old('minimumamount', $job->minimumamount) }}">
                                                                @error('minimumamount')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-auto " id="maximumamountdiv">
                                                            <div class="form-group">
                                                                <label for="maximumamount"
                                                                    class="form-label">{{ __('Maximum Amount') }}</label>
                                                                <input type="number"
                                                                    class="form-control form-control-padding_10  @if ($job->pay == 'Minimum') d-none @endif @error('maximumamount') is-invalid @enderror"
                                                                    name="maximumamount" id="maximumamount"
                                                                    value="{{ old('maximumamount', $job->maximumamount) }}">
                                                                @error('maximumamount')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="rate"
                                                            class="form-label">{{ __('Rate') }}</label>
                                                        <select name="rate" id="rate"
                                                            class="form-control form-control-padding_10 form-select @error('rate') is-invalid @enderror">
                                                            <option value="per hour"
                                                                @if (old('rate') == 'per hour') selected @endif> per
                                                                hour</option>
                                                            <option value="per day"
                                                                @if (old('rate') == 'per day') selected @endif> per day
                                                            </option>
                                                            <option value="per week"
                                                                @if (old('rate') == 'per week') selected @endif> per
                                                                week</option>
                                                            <option value="per month"
                                                                @if (old('rate') == 'per month') selected @endif> per
                                                                month</option>
                                                            <option value="per year"
                                                                @if (old('rate') == 'per year') selected @endif> per
                                                                year</option>
                                                        </select>
                                                        @error('rate')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit SupplementPay Modal -->
                    <div class="modal fade" id="supplementpayModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="supplementForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __('Supplement') }} </label>
                                            <div class="job-buttons my-3">
                                                @foreach (['Performance bonus', 'Yearly bonus', 'Commission pay', 'Overtime pay', 'Quarterly bonus', 'Shift allowance', 'Joining bonus', 'Other'] as $supplement)
                                                    <label
                                                        class="job-btn  @if (in_array($supplement, $job->supplement)) selected @endif">
                                                        @if (in_array($supplement, $job->supplement))
                                                            <i class="fas fa-check"></i>
                                                        @else
                                                            <i class="fas fa-plus"></i>
                                                        @endif

                                                        <input type="checkbox" name="supplement[]"
                                                            value="{{ $supplement }}"
                                                            @if (in_array($supplement, $job->supplement)) checked @endif
                                                            class="form-control @error('supplement') is-invalid @enderror">
                                                        {{ $supplement }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Benefits Modal -->
                    <div class="modal fade" id="benefitModal" tabindex="-1"
                        role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="benfitsForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __('Benefits') }} </label>
                                            <div class="job-buttons my-3">
                                                @foreach (['Health insurance', 'Provident Fund', 'Cell phone reimbursement', 'Paid sick time', 'Work from home', 'Paid time off', 'Food provided', 'Life insurance', 'Internet reimbursement', 'Commuter assistance', 'Leave encashment', 'Flexible schedule', 'Other'] as $benefit)
                                                    <label
                                                        class="job-btn  @if (in_array($benefit, $job->benefit)) selected @endif">
                                                        @if (in_array($benefit, $job->benefit))
                                                            <i class="fas fa-check"></i>
                                                        @else
                                                            <i class="fas fa-plus"></i>
                                                        @endif

                                                        <input type="checkbox" name="benefit[]"
                                                            value="{{ $benefit }}"
                                                            @if (in_array($benefit, $job->benefit)) checked  class="form-control @error('schedule') is-invalid @enderror" @endif>
                                                        {{ $benefit }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Job Description Modal -->
                    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="desc" class="form-label">{{ __('Job Description') }}
                                            </label>
                                            <textarea name="job_description" id="desc" cols="30" rows="10"
                                                class="@error('job_description') is-invalid @enderror">{!! $job->job_description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Requirement Modal -->
                    <div class="modal fade" id="requirementModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{ __('Recruitment timeline for this job') }} <span class="required">*</span>
                                            </label>
                                            <input type="hidden" name="type" value="recruitment_timeline">
                                            <select name="recruitment_timeline" id="recruitment_timeline"
                                                class="form-control form-control-padding_10 form-select @error('recruitment_timeline') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('Select an Option') }}
                                                </option>
                                                <option value="1 to 3 days"
                                                    @if ($job->recruitment_timeline == '1 to 3 days') selected @endif>
                                                    {{ __('1 to 3 days') }}
                                                </option>
                                                <option value="3 to 7 days"
                                                    @if ($job->recruitment_timeline == '3 to 7 days') selected @endif>
                                                    {{ __('3 to 7 days') }}
                                                </option>
                                                <option value="1 to 2 weeks"
                                                    @if ($job->recruitment_timeline == '1 to 2 weeks') selected @endif>
                                                    {{ __('1 to 2 weeks') }}</option>
                                                <option value="2 to 4 weeks"
                                                    @if ($job->recruitment_timeline == '2 to 4 weeks') selected @endif>
                                                    {{ __('2 to 4 weeks') }}</option>
                                                <option value="More than 4 weeks"
                                                    @if ($job->recruitment_timeline == 'More than 4 weeks') selected @endif>
                                                    {{ __('More than 4 weeks') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Setting Modal -->
                    <div class="modal fade" id="settingModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-center" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit The Job Details') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form" id="settingForm">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" name="job_id" id="id"
                                            value="{{ $job->id }}">
                                        <div class="form-group">
                                            <div class="row mb-2">
                                                <div class="col-8">
                                                    <label for="email" class="form-label">
                                                        {{ __('Send daily updates to') }}
                                                        <span class="required">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button type="button" class="btn btn-primary" id="add-email"><i
                                                            class="fa-solid fa-plus"></i></button>
                                                </div>
                                            </div>

                                            <div id="email-wrapper">
                                                @php($emails = App\Models\Jobportal\JobPreference::where('job_id', $job->id)->first())
                                                @php($emailArray = $emails ? json_decode($emails->email, true) : [])
                                                <div class="email-input-group">
                                                    @php($i = 1)
                                                    @foreach ($emailArray as $email)
                                                        <div class="email-input-group mb-2">
                                                            <div class="input-group">
                                                                <input type="email" name="email[]"
                                                                    class="form-control form-control-padding_10"
                                                                    value="{{ $email }}"
                                                                    placeholder="Enter email">
                                                                @if ($i > 1)
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-email"><i
                                                                            class="fa-solid fa-minus"></i></button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @php($i++)
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" name="sendmail" id="sendmail" @if($emails->sendmail == 1) checked @endif>
                                            <label for="sendmail" class="form-label">send an individual email update each
                                                time someone applies.</label>
                                        </div>
                                        <h5>{{ __('Let potential candidates contact you about this job') }}</h5>
                                        <div class="form-group">
                                            <input type="checkbox" name="contactmail" id="contactmail" @if($emails->contactmail == 1) checked @endif>
                                            <label for="contactmail" class="form-label">By email to the address
                                                provided</label>
                                        </div>
                                        <h4>{{ __('Application preferences') }} </h4>
                                        <div class="form-group">
                                            <label for="requirecv">{{ __('Ask potential candidates for a CV?') }}</label>
                                            <select name="requirecv" id="requirecv"
                                                class="form-control form-control-padding_10">
                                                <option value="yes" @if($emails->requirecv == 'yes') selected @endif>Yes, require a CV</option>
                                                <option value="no" @if($emails->requirecv == 'no') selected @endif>No, don't ask for a CV</option>
                                                <option value="Give the option to include a CV" @if($emails->requirecv == 'Give the option to include a CV') selected @endif>Give the option to include
                                                    a CV</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <h6>{{ __('Is there an application deadline?') }}</h6>
                                            <input type="radio" name="deadline" id="yes" value="yes" @if($emails->deadline == 'yes') checked @endif
                                                class="form-radio deadlinetime">
                                            <label for="yes" class="form-label">Yes</label>
                                            <input type="radio" name="deadline" id="no" value="no"
                                                class="form-radio deadlinetime" @if($emails->deadline == 'no') checked @endif>
                                            <label for="no" class="form-label">No</label>
                                        </div>
                                        <div class="col-lg-4  @if($emails->deadline == 'no') d-none @endif" id="deadlinetime">
                                            <input type="date" name="deadlinetime" min="{{ date('Y-m-d') }}"
                                                class="form-control form-control-padding_10 form-calender">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-end">
                        <a href="{{route('jobportal.job_skill',$job->id)}}" class="btn btn-primary">{{ __('Next') }} <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('jobportal/js/createjob.js') }}"></script>
    <script src="{{ url('jobportal/js/preferances.js') }}"></script>
    <script>
        function toggleText() {
            var shortDesc = $('#shortDescription');
            var fullDesc = $('#fullDescription');
            var toggleLink = $('#toggleDescription');

            // Toggle classes and text between full and short descriptions
            if (shortDesc.hasClass('d-block')) {
                shortDesc.addClass('d-none').removeClass('d-block');
                fullDesc.removeClass('d-none');
                toggleLink.text('Hide Full Text');
            } else {
                fullDesc.addClass('d-none');
                shortDesc.removeClass('d-none').addClass('d-block');
                toggleLink.text('Show Full Text');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // General AJAX function for form submission
            function updateJobDetails(data, modalId) {
                $.ajax({
                    url: '/jobportal/update-job-details', // Unified route for all updates
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        $(modalId).modal('hide'); // Close the respective modal
                        toastr.success(response.message); // Show a success message
                    },
                    error: function(xhr) {
                        toastr.error('Error updating job details');
                    }
                });
            }

            // Job Title Form Submission
            $('#jobTitleForm').submit(function(e) {
                e.preventDefault();
                jobtitle = $('#title').val();
                let data = {
                    _token: '{{ csrf_token() }}',
                    type: 'title',
                    id: '{{ $job->id }}',
                    title: $('#title').val()
                };
                $('#jobtitle').text(jobtitle);
                updateJobDetails(data, '#titleModal');
            });
            // Number of Openings Form Submission
            $('#numberOfOpeningsForm').submit(function(e) {
                e.preventDefault();
                const val = $('#numberofpeople').val();
                let data = {
                    _token: '{{ csrf_token() }}',
                    type: 'openings',
                    id: '{{ $job->id }}',
                    number_of_openings: $('#numberofpeople').val()
                };
                $('#openings').text(val);

                updateJobDetails(data, '#numberofopeningModal');
            });
            // Language and Country Form Submission
            $('#languageCountryForm').submit(function(e) {
                e.preventDefault();

                let data = {
                    _token: '{{ csrf_token() }}',
                    type: 'lang_country',
                    id: '{{ $job->id }}',
                    language: $('#language').val(),
                    country: $('#country').val()
                };
                $('#joblang').text($('#language').val());
                $('#jobloc').text($('#country').val());

                updateJobDetails(data, '#langcountry');
            });
            $('#locationModal form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Prepare the data object with values from the form
                let data = {
                    _token: '{{ csrf_token() }}',
                    type: 'job_location',
                    id: '{{ $job->id }}',
                    job_type: $('#jobtype').val(),
                    city: $('#cityfeild').val(),
                    area: $('#area').val(),
                    address: $('#address').val(),
                    pincode: $('#pincode').val(),
                    ads: $('input[name="ads"]:checked').val(),
                    adscity: $('input[name="adscity"]').val(),
                };

                // Update any relevant UI elements after form submission
                $('#jobtype_display').text($('#jobtype').val());
                $('#city_display').text($('#cityfeild').val());
                // Call a function to update the job details, similar to the previous one
                updateJobDetails(data, '#locationModal');
            });
            $('#jobTypeForm').submit(function(e) {
                e.preventDefault();

                let jobTypes = [];
                $("input[name='job_type[]']:checked").each(function() {
                    jobTypes.push($(this).val());
                });

                let data = {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    type: 'job_type', // Indicating that job types are being updated
                    id: '{{ $job->id }}', // Pass the job ID
                    job_type: jobTypes // Include selected job types
                };

                // Generate the list of selected job types as <li> elements
                let jobTypesList = jobTypes.map(function(jobType) {
                    return `<li>${jobType}</li>`;
                }).join(''); // Join them as a single string of <li> elements

                // Update the #selectedJobType element with the list
                $('#selectedJobType').html(
                    `<ul class="list-group">${jobTypesList}</ul>`); // Wrap them inside a <ul>

                // Optionally, hide the #job_type_list element
                $('#job_type_list').addClass('d-none');

                // Close the modal if necessary and update the job details
                updateJobDetails(data, '#jobtypeModal');
            });

            $('#scheduleModal form').submit(function(e) {
                e.preventDefault();

                let schedules = [];
                $("input[name='scheduale[]']:checked").each(function() {
                    schedules.push($(this).val());
                });

                let data = {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    type: 'schedule', // Specify the type of data being sent
                    id: '{{ $job->id }}', // Pass the job ID
                    schedule: schedules // Include the selected schedules
                };

                // Generate the list of selected schedules as <li> elements
                let scheduleList = schedules.map(function(schedule) {
                    return `<li>${schedule}</li>`;
                }).join(''); // Join the list items into a single string

                // Update the #selectedScheduale element with the list of schedules
                $('#selectedScheduale').html(
                    `<ul class="list-group">${scheduleList}</ul>`); // Wrap the list items inside a <ul>

                // Optionally, hide the #schedualelist element
                $('#schedualelist').addClass('d-none');

                // Close the modal
                $('#scheduleModal').modal('hide');

                // Update job details (function should be defined elsewhere in your code)
                updateJobDetails(data, '#scheduleModal');
            });

            $('#payModal form').submit(function(e) {
                e.preventDefault();

                // Capture the selected values
                let payType = $('#payby').val();
                let exactAmount = $('#exactamount').val();
                let minimumAmount = $('#minimumamount').val();
                let maximumAmount = $('#maximumamount').val();
                let rate = $('#rate').val();
                let symbol = '{{ Session::get('changed_currency_symbol') }}';

                let data = {
                    _token: '{{ csrf_token() }}', // Include CSRF token for security
                    type: 'pay', // Specify the type of data being sent
                    id: '{{ $job->id }}', // Pass the job ID
                    pay: payType,
                    exactamount: exactAmount,
                    minimumamount: minimumAmount,
                    maximumamount: maximumAmount,
                    rate: rate
                };
                if (payType == 'Exact Amount') {
                    $('#selectedPayDetails').text(symbol + $('#exactamount').val() + `${rate}`);
                    $('#jobpayment').addClass('d-none');
                } else if (payType == 'Minimum') {
                    $('#selectedPayDetails').text(symbol + $('#minimumamount').val() + ` ${rate}`);
                    $('#jobpayment').addClass('d-none');
                } else if (payType == 'Maximum') {
                    $('#selectedPayDetails').text(symbol + $('#maximumamount').val() + ` ${rate}`);
                    $('#jobpayment').addClass('d-none');
                } else {
                    $('#selectedPayDetails').text(symbol + $('#minimumamount').val() + ' - ' + symbol + $(
                        '#maximumamount').val() + ` ${rate}`);
                    $('#jobpayment').addClass('d-none');

                }

                // Update the UI with the submitted payment details (optional)
                // $('#selectedPayDetails').text(`Pay: ${payType}, Rate: ${rate}`);
                $('#payModal').modal('hide'); // Hide the modal after submission

                // Call your function to update job details with the collected data
                updateJobDetails(data, '#payModal');
            });
            $('#supplementForm').submit(function(e) {
                e.preventDefault();

                let supplements = [];
                $("input[name='supplement[]']:checked").each(function() {
                    supplements.push($(this).val());
                });

                let data = {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    type: 'supplement', // Indicating that supplements are being updated
                    id: '{{ $job->id }}', // Pass the job ID
                    supplement: supplements // Include selected supplements
                };

                // Generate the list of selected supplements as <li> elements
                let supplementsList = supplements.map(function(supplement) {
                    return `<li>${supplement}</li>`;
                }).join(''); // Join them as a single string of <li> elements

                // Hide the #supplementlist element if necessary
                $('#supplementlist').addClass('d-none');

                // Update the #selectedSupplements element with the list
                $('#selectedSupplements').html(
                    `<ul class="list-group">${supplementsList}</ul>`); // Wrap them inside a <ul>

                // Close the modal
                $('#supplementpayModal').modal('hide');

                // Call the function to update job details
                updateJobDetails(data, '#supplementpayModal');
            });
            $('#benefitModal form').submit(function(e) {
                e.preventDefault();

                let benefits = [];
                $("input[name='benefit[]']:checked").each(function() {
                    benefits.push($(this).val());
                });

                let data = {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    type: 'benefit', // Indicating that benefits are being updated
                    id: '{{ $job->id }}', // Pass the job ID
                    benefit: benefits // Include selected benefits
                };

                // Generate the list of selected benefits as <li> elements
                let benefitsList = benefits.map(function(benefit) {
                    return `<li>${benefit}</li>`;
                }).join(''); // Join them as a single string of <li> elements

                // Hide the #benefitlist element if necessary
                $('#benefitlist').addClass('d-none');

                // Update the #selectedBenefits element with the list
                $('#selectedBenefits').html(
                    `<ul class="list-group">${benefitsList}</ul>`); // Wrap them inside a <ul>

                // Close the modal
                $('#benefitModal').modal('hide');

                // Call the function to update job details
                updateJobDetails(data, '#benefitModal');
            });
            $('#descriptionModal form').submit(function(e) {
                e.preventDefault();

                let jobDescription = $('#desc').val(); // Get the updated job description

                let data = {
                    _token: '{{ csrf_token() }}',
                    type: 'description',
                    id: '{{ $job->id }}',
                    job_description: jobDescription
                };
                $('#jobDescription').html(`
                    <div id="shortDescription" class="d-block">${jobDescription.substring(0, 250)}...</div>
                    <div id="fullDescription" class="d-none">${jobDescription}</div>
                    <a href="javascript:void(0);" id="toggleDescription" onclick="toggleText()">Show Full Text</a>
                `);
                $('#descriptionModal').modal('hide'); // Hide the modal after updating
                updateJobDetails(data, '#descriptionModal');
            });
            $('#settingForm').submit(function(e) {
                e.preventDefault();
                let emails = [];
                $("input[name='email[]']").each(function() {
                    emails.push($(this).val());
                });

                let sendmail = $('#sendmail').is(':checked') ? 1 : 0;
                let contactmail = $('#contactmail').is(':checked') ? 1 : 0;
                let requirecv = $('#requirecv').val();
                let deadline = $('input[name="deadline"]:checked').val();
                let deadlinetime = deadline === 'yes' ? $('input[name="deadlinetime"]').val() : null;

                // Prepare data to be sent via AJAX
                let data = {
                    _token: '{{ csrf_token() }}',
                    job_id: '{{ $job->id }}',
                    email: emails,
                    sendmail: sendmail,
                    contactmail: contactmail,
                    requirecv: requirecv,
                    deadline: deadline,
                    deadlinetime: deadlinetime // Only include deadline time if the option is yes
                };

                // Display email inputs as a list in the element with ID newemail
                let emailList = emails.map(email => `<li>${email}</li>`).join('');
                $('#newemail').html(`<ul class="list-group">${emailList}</ul>`);
                $('#emailist').addClass('d-none');
                $('#updatedcv').text(requirecv);
                $('#updateddeadline').text(deadline);
                $('#updateddeadlinetime').text(deadlinetime);
                updateJobSettings(data);
            });
            $('#requirementModal form').submit(function(e) {
                e.preventDefault();
                let recruitment_timeline = $('#recruitment_timeline').val();
                let data = {
                    _token: '{{ csrf_token() }}',
                    type: 'recruitment_timeline',
                    recruitment_timeline: recruitment_timeline,
                    id: "{{ $job->id }}"
                };
                $('#updatedrecruitment_timeline').text(recruitment_timeline);
                updateJobDetails(data, '#requirementModal');
            });
        });

        function updateJobSettings(data) {
            $.ajax({
                url: '{{ route('jobportal.savepreferences') }}', // Adjust this route accordingly
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message)
                        $('#settingModal').modal('hide'); // Close the modal
                    } else {
                        alert('There was an error updating the job settings.');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseText)
                }
            });
        }
    </script>
@endsection
