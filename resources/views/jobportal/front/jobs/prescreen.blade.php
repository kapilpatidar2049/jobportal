@extends('jobportal.front.layouts.master')
@section('title', 'Job Prescreen')
@section('main-container')
    <div class="container">
        <div class="client-area">
            <h4>{{ __('Job Prescreen ') }}</h4>
            <form action="{{ route('prescreentest.save',$currentjob->id) }}" method="post">
                @csrf
                @foreach ($jobs as $job)
                    @if ($job->type == 'education')
                        <input type="hidden" name="question[]"
                            value="what is the highest level of education you have completed?">
                        <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                        <p>what is the highest level of education you have completed? </p>
                        <select class="form-control form-select form-control-padding_10 my-3 bg-white" name="answer[]">
                            <option value="secondary">Secondary (10th Pass)</option>
                            <option value="highersecondary">Higher Secondary (12th Pass)</option>
                            <option value="diploma">Diploma</option>
                            <option value="bachelors">Bachelor's</option>
                            <option value="masters">Master's</option>
                            <option value="doctorate">Doctorate</option>
                        </select>
                    @endif
                    @if ($job->type == 'experience')
                        <div class="my-3">
                            <input type="hidden" name="question[]"
                                value="How many years of {{ $job->field }} experience do you have?">
                            <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                            <p>How many years of {{ $job->field }} experience do you have?</p>
                            <input type="number" value="{{ $job->year }}" name="answer[]" min="0"
                                placeholder="0">
                        </div>
                    @endif

                    @if ($job->type == 'interview')
                        <div class="my-3">
                            <input type="hidden" name="question[]"
                                value="Please list 2-3 dates and time ranges that you could do an interview ?">
                            <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                            <p>Please list 2-3 dates and time ranges that you could do an interview ?</p>
                            <textarea name="answer[]" cols="30" rows="10"></textarea>
                        </div>
                    @endif

                    @if ($job->type == 'language')
                        <div class="my-3">
                            <input type="hidden" name="question[]" value="Do you speak {{ $job->language }} ?">
                            <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                            <p>Do you speak {{ $job->language }} ?</p>
                            <select name="answer[]" class="form-control form-select form-control-padding_10 bg-white">
                                <option value="yes">Yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>
                    @endif
                    @if ($job->type == 'certificate')
                        <div class="my-3">
                            <input type="hidden" name="question[]" value=" Do you have a valid {{ $job->certificate }} ?">
                            <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                            <p> Do you have a valid {{ $job->certificate }} ?</p>
                            <select name="answer[]" class="form-control form-select form-control-padding_10 bg-white">
                                <option value="yes">Yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>
                    @endif
                    @if ($job->type == 'location')
                        @if ($currentjob->type == 'on-site')
                            <div class="my-3">
                                <input type="hidden" name="question[]"
                                    value=" Are You Locate in  {{ $currentjob->city }} ?">
                                <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                                <p>Are You Locate in {{ $currentjob->city }} ?</p>
                                <select name="answer[]" class="form-control form-select form-control-padding_10 bg-white">
                                    <option value="yes">Yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                        @endif
                    @endif
                    @if ($job->type == 'shift')
                        <input type="hidden" name="question[]" value="What is your shift availability?">
                        <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                        <p>What is your shift availability?</p>
                        <input type="hidden" name="answer[]" value="shifts">
                        <label class="form-checkbox-label" for="day_shift">
                            <input type="checkbox" class="form-checkbox" name="shift[]" id="day_shift" value="Day Shift">
                            Day Shift
                        </label>
                        <label class="form-checkbox-label" for="night_shift">
                            <input type="checkbox" class="form-checkbox" name="shift[]" id="night_shift"
                                value="Night Shift">
                            Night Shift
                        </label>
                        <label class="form-checkbox-label" for="overnight_shift">
                            <input type="checkbox" class="form-checkbox" name="shift[]" id="overnight_shift"
                                value="Overnight Shift">
                            Overnight Shift
                        </label>
                    @endif
                    @if ($job->type == 'travel')
                        <input type="hidden" name="question[]" value="Are you willing to travel for this position?">
                        <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                        <p>Are you willing to travel for this position?</p>
                        <select name="answer[]" class="form-control form-select form-control-padding_10 bg-white">
                            <option value="yes">Yes</option>
                            <option value="no">no</option>
                        </select>
                    @endif
                    @if ($job->type == 'custom')
                        <input type="hidden" name="question[]" value="{{ $job->custom_question }}">
                        <input type="hidden" name="question_id[]" value="{{ $job->id }}">
                        <p>{{ $job->custom_question }}</p>
                        <textarea name="answer[]" cols="30" rows="10"></textarea>
                    @endif
                @endforeach
                <input type="hidden" name="job_id" value="{{$currentjob->id}}">
                <button class="btn btn-primary" type="submit">Continue</button>
            </form>
        </div>
    </div>
@endsection
