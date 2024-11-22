@extends('jobportal.layouts.master')
@section('title', 'Paymemt')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Paymemt') }}
            @endslot
            @slot('menu2')
                {{ __('Paymemt') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <form id="gstForm" novalidate>
                        <div class="row">
                            <!-- GST Number -->
                            <div class="form-group mb-3 col-lg-6">
                                <label for="gstNumber" class="form-label">GST Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-padding_10" id="gstNumber"
                                    name="gst_number" placeholder="Enter your GST Number" required>
                                <div class="invalid-feedback">
                                    GST Number is required.
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group mb-3 col-lg-6">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-padding_10" id="address"
                                    name="address" placeholder="Enter your address" required>
                                <div class="invalid-feedback">
                                    Address is required.
                                </div>
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
