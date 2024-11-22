@extends('jobportal.layouts.master')
@section('title', 'Company Details')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Company Details') }}
            @endslot
            @slot('menu2')
                {{ __('Company Details') }}
            @endslot
            @slot('button')
                <div class="col-md-6 col-lg-6">
                    <div class="widget-button">
                        <a type="button" class="btn btn-primary me-2" title="{{ __('Back') }}" data-bs-toggle="modal"
                            data-bs-target="#bulk_delete"><i class="fa-solid fa-arrow-left"></i>
                            {{ __('Back') }}</a>
                    </div>
                </div>
            @endslot
        @endcomponent
        <div class="contentbar ">
            <!-- form code start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-area">
                        @if (!$compnyDetail)
                            <h4 class="mb-3">
                                {{ __('You haven`t posted a job before, so you`ll need to create an employer account.') }}
                            </h4>

                            <!-- Option to select if you're posting a job -->
                            <div class="mb-4">
                                <div class="body">
                                    <h5>Not here to post a job?</h5>
                                    <p><a href="#">Search for a job</a> (People looking for jobs)</p>
                                </div>
                            </div>
                        @endif

                        <!-- Start of Form -->
                        <form action="{{ route('savecompanydetails') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Company Name -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="company_name" class="form-label">Your company's name <span
                                                class="required">*</span></label>
                                        <input type="text"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            id="company_name" name="company_name"
                                            value="{{ old('company_name', $compnyDetail->company_name ?? '') }}"
                                            placeholder="Enter your company name">
                                        <div class="form-control-icon"><i class="fa-regular fa-building"></i></div>
                                        @error('company_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Company Size -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="company_size" class="form-label">Your company's number of
                                            employees</label>
                                            <select class="form-control" id="company_size" name="employees">
                                                <option value="">Select an option</option>
                                                <option value="1-10"
                                                    {{ old('employees', $compnyDetail->employees ?? '') == '1-10' ? 'selected' : '' }}>
                                                    1-10</option>
                                                <option value="11-50"
                                                    {{ old('employees', $compnyDetail->employees ?? '') == '11-50' ? 'selected' : '' }}>
                                                    11-50</option>
                                                <option value="51-100"
                                                    {{ old('employees', $compnyDetail->employees ?? '') == '51-100' ? 'selected' : '' }}>
                                                    51-100</option>
                                                <option value="100+"
                                                    {{ old('employees', $compnyDetail->employees ?? '') == '100+' ? 'selected' : '' }}>
                                                    100+</option>
                                            </select>
                                        <div class="form-control-icon"><i class="fa-solid fa-users"></i></div>
                                    </div>
                                </div>

                                <!-- First and Last Name -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="full_name" class="form-label">Your first and last name <span
                                                class="required">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="full_name" name="name" value="{{ old('name', $compnyDetail->name ?? '') }}"
                                            placeholder="Enter your full name">
                                        <div class="form-control-icon"><i class="fa-solid fa-t"></i></div>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- How You Heard About Us -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="heard_about_us" class="form-label">How you heard about us</label>
                                        <select class="form-control" id="heard_about_us" name="heard_about_us">
                                            <option value="">Select how you heard about us</option>
                                            @foreach (['Online Ad', 'Social Media', 'Friend/Referral', 'Search Engine', 'TV Advertisement', 'Radio Advertisement', 'Email Campaign', 'Event/Conference', 'News Article', 'Other'] as $option)
                                                <option value="{{ $option }}"
                                                    {{ old('heard_about_us', $compnyDetail->heard_about_us ?? '') == $option ? 'selected' : '' }}>
                                                    {{ $option }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon"><i class="fa-solid fa-volume-high"></i></div>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-label">Your phone number</label>
                                        <div class="country-code d-flex">
                                            <div class="col-3">
                                                <select class="form-control form-control-padding_10" id="country_code"
                                                    name="country_code">
                                                    @php($countries = App\Models\Allcountry::where('phonecode', '!=', null)->get())
                                                    @foreach ($countries as $item)
                                                        <option value="+{{ $item->phonecode }}"
                                                            {{ old('country_code', $compnyDetail->country_code ?? '') == "+{$item->phonecode}" ? 'selected' : '' }}>
                                                            +{{ $item->phonecode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" class="form-control form-control-padding_10"
                                                    name="phone" id="phone_number"
                                                    value="{{ old('phone', $compnyDetail->phone ?? '') }}"
                                                    placeholder="Enter phone number">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->name }}"
                                                    {{ old('country', $compnyDetail->country ?? '') == $item->name ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon"><i class="fa-solid fa-globe"></i></div>
                                    </div>
                                </div>

                                <!-- Language -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="language" class="form-label">Language</label>
                                        <select class="form-control" id="language" name="language">
                                            @php($languages = App\Models\Jobportal\Language::all())
                                            @foreach ($languages as $item)
                                                <option value="{{ $item->code }}"
                                                    {{ old('language', $compnyDetail->language ?? '') == $item->code ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon"><i class="fa-solid fa-language"></i></div>
                                    </div>
                                </div>

                                <!-- Industry -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="industry" class="form-label">Industry</label>
                                        <select name="industry" id="industry" class="form-control">
                                            <option value="">Select Industry</option>
                                            @php($industries = App\Models\Jobportal\Industries::all())
                                            @foreach ($industries as $item)
                                                <option value="{{ $item->name }}" data-id="{{$item->id}}"
                                                    {{ old('industry', $compnyDetail->industry ?? '') == $item->name ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon"><i class="fa-solid fa-industry"></i></div>
                                    </div>
                                </div>

                                <!-- Sub Industries -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sub_industry" class="form-label">Sub Industry</label>
                                        <select name="sub_industry" id="sub_industry" class="form-control">
                                            <option value="">Select Industry First</option>
                                            <option value="{{  $compnyDetail->sub_industry ?? ''}}"
                                                {{ old('sub_industry', $compnyDetail->sub_industry ?? '')}} selected>
                                                {{  $compnyDetail->sub_industry ?? '' }}</option>
                                        </select>
                                        <div class="form-control-icon"><i class="fa-solid fa-industry"></i></div>
                                    </div>
                                </div>

                                <!-- GST Number -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="gst_number" class="form-label">{{ __('GSTIN Number') }}</label>
                                        <input type="text" name="gst_number" id="gst_number" class="form-control"
                                            value="{{ old('gst_number', $compnyDetail->gst_number ?? '') }}"
                                            placeholder="{{ __('Enter Your GST Number') }}">
                                        <div class="form-control-icon"><i class="fa-solid fa-file-invoice"></i></div>
                                    </div>
                                </div>

                                <!-- Founded -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="year" class="form-label">{{ __('Founded In') }}</label>
                                        <input type="number" id="year" name="founded" min="1900"
                                            max="{{ date('Y') }}"
                                            value="{{ old('founded', $compnyDetail->founded ?? '') }}" class="form-control"
                                            placeholder="YYYY" />
                                        <div class="form-control-icon"><i class="fa-solid fa-file-invoice"></i></div>
                                    </div>
                                </div>

                                <!-- Website -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="website" class="form-label">{{ __('Company Website') }}</label>
                                        <input type="url" name="website" id="website" class="form-control"
                                            value="{{ old('website', $compnyDetail->website ?? '') }}"
                                            placeholder="Enter your company website">
                                        <div class="form-control-icon"><i class="fa-solid fa-file-invoice"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#industry').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var id = selectedOption.data('id');
                $.ajax({
                    url: '/jobportal/subindustry',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#sub_industry').empty();
                        $.each(response.subindustries, function(index, subindustry) {
                            $('#sub_industry').append(new Option(subindustry.name,
                                subindustry.name));
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
