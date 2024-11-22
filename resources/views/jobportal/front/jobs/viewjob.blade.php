@extends('jobportal.front.layouts.master')
@section('title', $job->title)
@section('main-container')
    <div class="container mt-4">
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <h4>{{ $job->title }}</h4>
                @php($company = App\Models\Jobportal\CompnyDetail::where('user_id', $job->user_id)->first())
                <a href="{{ $company->website }}" class="text-dark company_website" target="_blank">
                    <p>{{ $company->company_name }}
                        <svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" fill="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true" class="redirect_icon">
                            <path
                                d="M14.504 3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3.085l-9.594 9.594a.5.5 0 000 .707l.707.708a.5.5 0 00.707 0l9.594-9.595V9.5a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-6a.5.5 0 00-.5-.5h-6z">
                            </path>
                            <path
                                d="M5 3.002a2 2 0 00-2 2v13.996a2 2 0 001.996 2.004h14a2 2 0 002-2v-6.5a.5.5 0 00-.5-.5h-1a.5.5 0 00-.5.5v6.5L5 18.998V5.002L11.5 5a.495.495 0 00.496-.498v-1a.5.5 0 00-.5-.5H5z">
                            </path>
                        </svg>
                    </p>
                </a>
                @if ($job->type == 'on-site')
                    {{ $job->city }}, {{ $job->state }}
                @else
                    {{ __('Remote') }}
                @endif
                <p>
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
                </p>
            </div>
            <div class="col-lg-6 ">
                <div class="d-flex float-end ">
                    <a href="{{route('jobportal.contact-info',base64_encode($job->id))}}" class="btn btn-primary me-2">{{ __('Appply Now') }}</a>
                    <button class="btn btn-secondary mx-2 save-job" data-jobid="{{ $job ->id }}" type="button"
                                        title="{{ __('Save Job') }}"><i class="fa-regular fa-bookmark"></i></button>
                    <button class="btn btn-secondary ms-2 notintrested" data-jobid="{{ $job->id }}" title="{{ __('Not Interested') }}"><i class="fa-solid fa-ban"></i></button>
                </div>
            </div>
            <hr>
            <div class="row my-3">
                <h5>{{ __('Job Insights') }}</h5>
                <div class="col-1">
                    <svg style="width: 25px" xmlns="http://www.w3.org/2000/svg" focusable="false" role="img"
                        fill="currentColor" viewBox="0 0 20 20" data-testid="section-icon" aria-hidden="true"
                        class="js-match-insights-provider-1pdva1a eac13zx0">
                        <path
                            d="M9.75 1a.5.5 0 00-.5.5v2a.5.5 0 00.5.5h.5a.5.5 0 00.5-.5v-2a.5.5 0 00-.5-.5h-.5zM16 10.25a.5.5 0 00.5.5h2a.5.5 0 00.5-.5v-.5a.5.5 0 00-.5-.5h-2a.5.5 0 00-.5.5v.5zm-14.5.5a.5.5 0 01-.5-.5v-.5a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v.5a.5.5 0 01-.5.5h-2zm2.379-6.518a.5.5 0 000 .707l.707.707a.5.5 0 00.707 0l.354-.353a.5.5 0 000-.707l-.707-.707a.5.5 0 00-.708 0l-.353.353zm12.242.708a.5.5 0 000-.708l-.353-.353a.5.5 0 00-.708 0l-.707.707a.5.5 0 000 .707l.354.353a.5.5 0 00.707 0l.707-.707zM7.5 16v1.5a.5.5 0 00.5.5h4a.5.5 0 00.5-.5V16h-5zm5-2.877a4 4 0 10-5 0V14.5h5v-1.377z">
                        </path>
                    </svg>
                </div>
                <div class="col-10">
                    <h6>{{ __('Skills') }}</h6>
                    <p>
                        @php($skills = App\Models\JobSkill::where('job_id', $job->id)->get())
                        @foreach ($skills as $skill)
                            <span class="job_type_front my-3">{{ $skill->skill }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
            <hr>
            <h5>{{ __('Job Details') }}</h5>
            <div class="row mt-4">
                <div class="col-1">
                    <svg style="width: 25px" xmlns="http://www.w3.org/2000/svg" focusable="false" role="img"
                        fill="currentColor" viewBox="0 0 20 20" data-testid="section-icon" aria-hidden="true"
                        class="js-match-insights-provider-1pdva1a eac13zx0">
                        <path fill-rule="evenodd"
                            d="M4.452 9.604a2.5 2.5 0 00-.952-.19V7.586A2.5 2.5 0 005.996 5.09h5.094a2.5 2.5 0 002.5 2.5v1.836a2.5 2.5 0 00-2.488 2.482H5.995a2.5 2.5 0 00-1.543-2.304zM2 4.09a.5.5 0 01.5-.5h12.09a.5.5 0 01.5.5v8.818a.5.5 0 01-.5.5H2.5a.5.5 0 01-.5-.5V4.09zm6.544 6.41a2 2 0 100-4 2 2 0 000 4zM16.6 7.8v7.11H4.76a.5.5 0 00-.5.5v.5a.5.5 0 00.5.5h12.663c.442 0 .677-.222.677-.663V7.8a.5.5 0 00-.5-.5h-.5a.5.5 0 00-.5.5z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="col-10">
                    <h6>{{ __('Pay') }}</h6>
                    <p class="job_content">
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
                    </p>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-1">
                <svg style="width:25px" xmlns="http://www.w3.org/2000/svg" focusable="false" role="img"
                    fill="currentColor" viewBox="0 0 20 20" data-testid="section-icon" aria-hidden="true"
                    class="js-match-insights-provider-1pdva1a eac13zx0">
                    <path fill-rule="evenodd"
                        d="M10 3C7 3 6 6 6 6H2.5a.5.5 0 00-.5.5V9h16V6.5a.5.5 0 00-.5-.5H14s-1-3-4-3zm2.5 3h-5s1-1.5 2.5-1.5S12.5 6 12.5 6z"
                        clip-rule="evenodd"></path>
                    <path d="M8 11H2v5.5a.5.5 0 00.5.5h15a.5.5 0 00.5-.5V11h-6c0 1-1 2-2 2s-2-1-2-2z"></path>
                </svg>
            </div>
            <div class="col-10">
                <h6>{{ __('Job Type') }}</h6>
                @foreach ($job->job_type as $job_type)
                    <span class="job_type_front">{{ $job_type }}</span>
                @endforeach
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-1">
                <svg style="width: 25px" xmlns="http://www.w3.org/2000/svg" focusable="false" role="img"
                    fill="currentColor" viewBox="0 0 20 20" data-testid="section-icon" aria-hidden="true"
                    class="js-match-insights-provider-1pdva1a eac13zx0">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.25 6.25A.25.25 0 019.5 6h1a.25.25 0 01.25.25v3.886l2.809 1.621a.25.25 0 01.091.341l-.5.866a.25.25 0 01-.341.092L9.25 11.002 9.252 11H9.25V6.25z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="col-10">
                <h6>{{ __('Shift and schedule') }}</h6>
                @foreach ($job->schedule as $schedule)
                    <span class="job_type_front">{{ $schedule }}</span>
                @endforeach
            </div>
        </div>
        <hr>
        <h5>{{ __('Location') }}</h5>
        <div class="row">
            <div class="col-1">
                <svg style="width: 25px" xmlns="http://www.w3.org/2000/svg" focusable="false" role="img"
                    fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" id="jobLocationIcon"
                    class="css-r72e78 eac13zx0">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 4.523 5.195 11.093 6.634 12.826a.47.47 0 00.732 0C13.805 20.093 19 13.523 19 9c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z">
                    </path>
                </svg>
            </div>
            <div class="col-10">
                @if ($job->type == 'on-site')
                    {{ $job->city }}, {{ $job->state }}
                @else
                    {{ __('Remote') }}
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <h5>{{ __('Benefits') }}</h5>
            <ul class="" id="benefitlist">
                @foreach ($job->benefit as $benefit)
                    <li>{{ $benefit }}</li>
                @endforeach
            </ul>
        </div>
        <hr>
        <div class="row">
            <h5>
                {{ __('Full job description') }}
            </h5>
            {!! $job->job_description !!}
        </div>
        <hr>
    </div>
@endsection
@section('scripts')
<script src="{{ url('/jobportal/js/savejob.js') }}"></script>
@endsection