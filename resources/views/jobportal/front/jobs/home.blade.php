@extends('jobportal.front.layouts.master')
@section('title', 'All Jobs')
@section('main-container')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-5">
                <div class="form-group2">
                    <input type="text" id="title" class="form-control bg-white"
                        placeholder="Job title, keywords, or company">
                    <div class="form-control-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group2">
                    <input type="text" id="cities" class="form-control bg-white"
                        placeholder="City, state, zip code, or 'remote'">
                    <div class="form-control-icon"><i class="fa-solid fa-location-dot"></i></div>
                </div>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary" type="button" id="findjobs">Find jobs</button>
            </div>
            <div class="col-lg-12 d-flex flex-wrap align-items-center justify-content-center mt-5">
                <select name="date" id="date" class="form-control custom-filter-button">
                    <option value="" disabled selected>Date Posted</option>
                    <option value="24 hours">Last 24 hours</option>
                    <option value="3 days">Last 3 Days</option>
                    <option value="7 days">Last 7 Days</option>
                    <option value="30 days">Last 30 days</option>
                </select>
                <!-- Minimum Amount Input -->
                <input type="number" id="minimumamount" class="form-control custom-filter-button form-control-padding_10"
                    placeholder="Min Amount" min="0" max="9999999">

                <!-- Maximum Amount Input -->
                <input type="number" id="maximumamount" class="form-control custom-filter-button form-control-padding_10"
                    placeholder="Max Amount" min="0" max="9999999">

                <select id="job_type" name="job_type" class="form-control custom-filter-button">
                    <option value="" disabled selected>Job Type</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Freelance">Freelance</option>
                </select>

                <select id="type" name="type" class="form-control custom-filter-button">
                    <option value=""selected disabled>Remote</option>
                    <option value="remote">Remote</option>
                    <option value="on-site">On-site</option>
                </select>

                <select id="lang" name="lang" class="form-control custom-filter-button">
                    <option value=""selected disabled>Job Language</option>
                    @php($langs = App\Models\Jobportal\Jobs::select('language', \DB::raw('count(*) as total'))
                    ->groupBy('language')
                    ->get())
                    @foreach ($langs as $lang)
                        <option value="{{$lang->language}}">{{$lang->language}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row mt-5" id="filteredjobs">
            <!-- Find Jobs button -->
            @foreach ($jobs as $item)
                <div class="col-lg-4 job_box">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="btn  dropdown-toggle" type="button" id="profile" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                                <li>
                                    <a class="dropdown-item save-job" data-jobid="{{ $item->id }}" type="button"
                                        title="{{ __('Save Job') }}">
                                        <i class="fa-regular fa-bookmark"></i> {{ __('Save Job') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item notintrested" data-jobid="{{ $item->id }}" title="{{ __('Not Interested') }}">
                                        <i class="fa-solid fa-ban"></i> {{ __('Not Interested') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{ route('jobportal.job.view', base64_encode($item->id)) }}" class="nav-link2 text-dark">
                        <h5 class="job_title">{{ $item->title }}</h5>
                        @php($company = App\Models\Jobportal\CompnyDetail::where('user_id', $item->user_id)->first())
                        <p>{{ $company->company_name }}</p>
                        @if ($item->type == 'on-site')
                            {{ $item->city }}, {{ $item->state }}
                        @else
                            {{ __('Remote') }}
                        @endif
                        <div class="mt-2 d-flex">
                            @php($i = 0)
                            @foreach ($item->job_type as $job_type)
                                @if ($i == 1)
                                    <span class="job_type_front">{{ $job_type }}</span>
                                @endif
                                @php($i++)
                            @endforeach
                            <span class="job_type_front">+{{ $i - 1 }} More</span>
                        </div>
                        <div class="mt-2">
                            <p>{!! \Illuminate\Support\Str::words($item->job_description, 10, '...') !!}</p>
                            <p>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('/jobportal/js/savejob.js') }}"></script>
    <script src="{{ url('/jobportal/js/searchjob.js') }}"></script>
@endsection
