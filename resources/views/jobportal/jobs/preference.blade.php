@extends('jobportal.layouts.master')
@section('title', 'Set preferences')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Set preferences') }}
            @endslot
            @slot('menu2')
                {{ __('Set preferences') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <h3>{{ __('Set preferences') }}</h3>
                    <h4>{{__('Communication preferences')}} </h4>
                    <form action="{{route('jobportal.savepreferences')}}" class="form" method="POST">
                        @csrf
                        <input type="hidden" name="job_id" id="id" value="{{$job->id}}">
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
                                <div class="email-input-group">
                                    <input type="email" name="email[]" class="form-control form-control-padding_10 mb-2" value="{{Auth::guard('jobportal')->user()->email}}" placeholder="Enter email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="sendmail" id="sendmail" checked>
                            <label for="sendmail" class="form-label">send an individual email update each time someone applies.</label>
                        </div>
                        <h5>{{__('Let potential candidates contact you about this job')}}</h5>
                        <div class="form-group">
                            <input type="checkbox" name="contactmail" id="contactmail" checked>
                            <label for="contactmail" class="form-label">By email to the address provided</label>
                        </div>
                        <h4>{{__('Application preferences')}} </h4>
                        <div class="form-group">
                            <label for="requirecv">{{__('Ask potential candidates for a CV?')}}</label>
                            <select name="requirecv" id="requirecv" class="form-control form-control-padding_10">
                                <option value="yes">Yes, require a CV</option>
                                <option value="no">No, don't ask for a CV</option>
                                <option value="Give the option to include a CV">Give the option to include a CV</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h6>{{__('Is there an application deadline?')}}</h6>
                            <input type="radio" name="deadline" id="yes" value="yes" class="form-radio deadlinetime">
                            <label for="yes" class="form-label">Yes</label>
                            <input type="radio" name="deadline" id="no" value="no" class="form-radio deadlinetime" checked>
                            <label for="no" class="form-label">No</label>
                        </div>
                        <div class="col-lg-4 d-none" id="deadlinetime">
                            <input type="date" name="deadlinetime" min="{{ date('Y-m-d') }}"  class="form-control form-control-padding_10 form-calender">
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Save Preferences')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ url('jobportal/js/preferances.js') }}"></script>
@endsection
