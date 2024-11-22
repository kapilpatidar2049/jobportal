@extends('jobportal.layouts.master')
@section('title', 'Sponser')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Sponser') }}
            @endslot
            @slot('menu2')
                {{ __('Sponser') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <p>
                        Choosing the <strong>recommended budget</strong> means your listing will get<strong> better
                            visibility</strong> and show up more often in search results, making it easier for people
                        looking for a job like yours to apply.
                    </p>
                    <form action="{{route('job_sponser')}}" method="post">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="duration" class="form-label">{{ __('Add Duration') }}</label>
                                    </div>
                                    <div class="col-4">
                                        <div class="suggestion-icon float-end">
                                            <div class="tooltip-icon">
                                                <div class="tooltip">
                                                    <div class="credit-block">
                                                        <small class="recommended-font-size">
                                                            {{ __('For how long do you want your job to be visible?') }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <span class="float-end"><i class="fa-solid fa-info"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <select name="duration" id="duration" class="form-control form-select">
                                    <option value="Run continuously">Run continuously</option>
                                    <option value="14 days">14 days</option>
                                    <option value="30 days">30 days</option>
                                    <option value="Custom end date">Custom end date</option>
                                </select>
                                <div class="form-control-icon"><i class="fa-regular fa-clock"></i></div>
                            </div>
                            <div id="customdate" class="d-none">
                                <input type="date" class="form-date" name="customdate">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="budget" class="form-label">{{ __('Ad budget') }}</label>
                                <div class="d-flex">
                                    <span class="form-control form-width_0"
                                        style="border-top-right-radius: 0;border-bottom-right-radius: 0;">{{ Session::get('changed_currency_symbol') }}</span>
                                    <div class="input-group">
                                        <input type="hidden" name="currency" value="{{ Session::get('changed_currency') }}">
                                        <input type="number" name="budget" style="border-radius: 0" min="0"
                                            id="budget"class=" form-control form-control-padding_10 no-outline">
                                        <select name="budget_type" id="budget_type"
                                            class="form-control form-select form-padding_10 no-outline">
                                        <option value="daily">daily average</option>
                                        <option value="monthly">per month</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 my-5">
                            <div class="box ">
                                <span class="label">Urgently needed</span><br>
                                <div class="label0"></div>
                                <div class="label2"></div>
                                <div class="label1"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 my-5">
                            <strong>Looks like you need to hire fast</strong>
                            <p class="mt-3">You can add an urgently hiring label to your Sponsored Job at no additional charge.</p>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="addlabel" value="1" id="addlabel">
                                    <label class="form-check-label form-label" for="addlabel">
                                        Add label
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a type="button" class="btn btn-secondary"><strong>Free Job Post</strong></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#duration').on('change', function() {
                let val = $(this).val();
                if (val == 'Custom end date') {
                    $('#customdate').removeClass('d-none');
                } else {
                    $('#customdate').addClass('d-none');

                }
            });
        });
    </script>
@endsection
