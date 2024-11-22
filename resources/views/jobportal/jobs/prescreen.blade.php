@extends('jobportal.layouts.master')
@section('title', 'PreScreening For Job')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('PreScreening') }}
            @endslot
            @slot('menu2')
                {{ __('PreScreening') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <div class="container form-container">
                        <h2 class="text-center mb-4">Application Form</h2>

                        <form id="application-form" action="{{ route('jobportal.job_precsreensave') }}" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <!-- Education Question Added by Default -->
                            <div class="form-section" id="education-question">
                                <input type="hidden" name="type[]" value="education">
                                <label class="form-label">What is the highest level of education you have completed?</label>
                                <div class="input-group">
                                    <select class="form-control form-control-padding_10" name="education">
                                        <option value="secondary">Secondary (10th Pass)</option>
                                        <option value="highersecondary">Higher Secondary (12th Pass)</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="bachelors">Bachelor's</option>
                                        <option value="masters">Master's</option>
                                        <option value="doctorate">Doctorate</option>
                                    </select>
                                    <button class="btn btn-danger" onclick="removeQuestion(this,'education')"
                                        title="remove">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamically Added Questions Section -->
                            <div id="dynamic-questions"></div>

                            <!-- Browse More Questions Section -->
                            <div class="browse-options form-section">
                                <h5>Browse more questions</h5>
                                <div class="row">
                                    <div class="col-6 col-md-4" onclick="addQuestion('education')">+ Education</div>
                                    <div class="col-6 col-md-4" onclick="addQuestion('experience')">+ Experience</div>
                                    <div class="col-6 col-md-4" onclick="addQuestion('interview')">+ Interview availability
                                    </div>
                                    <div class="col-6 col-md-4" onclick="addQuestion('language')">+ Language</div>
                                    <div class="col-6 col-md-4" onclick="addQuestion('license')">+ License/Certification
                                    </div>
                                    @if ( $job->type == 'on-site')
                                      <div class="col-6 col-md-4" onclick="addQuestion('location')">+ Location</div>
                                    @endif
                                    <div class="col-6 col-md-4" onclick="addQuestion('shift')">+ Shift availability</div>
                                    <div class="col-6 col-md-4" onclick="addQuestion('travel')">+ Willingness to travel
                                    </div>
                                    <div class="col-6 col-md-4" onclick="addQuestion('custom')">+ Create custom question
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Continue</button>
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
        let addedQuestions = {
            education: true,
            interview: false,
            location: false,
            shift: false,
            travel: false
        };

        function addQuestion(type) {
            let questionHtml = '';

            // Only allow certain questions to be added once
            if (addedQuestions[type]) {
                toastr.error(type.charAt(0).toUpperCase() + type.slice(1) + " question has already been added.");
                return;
            }

            switch (type) {
                case 'education':
                    questionHtml = `
                <div class="form-section">
                    <label class="form-label">What is the highest level of education you have completed?</label>
                    <input type="hidden" name="question[]" value="What is the highest level of education you have completed?">
                    <div class="input-group">
                        <select class="form-control form-control-padding_10" name="atleast[]">
                            <option>Secondary (10th Pass)</option>
                            <option>Higher Secondary (12th Pass)</option>
                            <option>Diploma</option>
                            <option>Bachelor's</option>
                            <option>Master's</option>
                            <option>Doctorate</option>
                        </select>
                        <button class="btn btn-danger" onclick="removeQuestion(this,'education')">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                </div>`;
                    addedQuestions.education = true;
                    break;

                case 'experience':
                    questionHtml = `
                <div class="form-section">
                   <label>Application question: How many years of ______ experience do you have?</label>
                   <div class="form-inline mt-2">
                       <label for="years" class="mr-2">At least</label>
                       <div class="input-group">
                            <input type="hidden" name="type[]" value="experience">
                       <select id="years" class="form-control form-width_0 mr-2" name="year[]">
                           <option value="1">1 year</option>
                           <option value="2">2 years</option>
                           <option value="3">3 years</option>
                           <option value="5">5+ years</option>
                       </select>
                       <label for="experience-type" class="mx-2">of</label>
                       <input type="text" name="field[]" id="experience-type" class="form-control form-width_0 mr-2" placeholder="Enter experience type">
                       <label class="mx-2">experience</label>
                        <button class="btn btn-danger" onclick="removeQuestion(this,'experience')">
                            <i class="fa-solid fa-x"></i>
                        </button>
                        </div>
                   </div>
               </div>`;
                    break;

                case 'interview':
                    questionHtml = `
                <div class="form-section">
                        <input type="hidden" name="type[]" value="interview">
                        <label class="me-5 form-label">Please list 2-3 dates and time ranges that you could do an interview.</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-padding_10" value="Ask applicants to list some dates and times they could do an interview" readonly>
                            <button class="btn btn-danger" onclick="removeQuestion(this,'interview')">
                                <i class="fa-solid fa-x"></i>
                            </button>
                    </div>
                </div>`;
                    addedQuestions.interview = true;
                    break;

                case 'language':
                    questionHtml = `
                <div class="form-section">
                        <input type="hidden" name="type[]" value="language">
                    <label class="form-label">Do you speak _________ ?</label>
                    <div class="input-group">
                    <input type="text" name="language[]" class="form-control form-control-padding_10" placeholder="Enter languages">
                    <button class="btn btn-danger" onclick="removeQuestion(this,'language')">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    </div>
                </div>`;
                    break;

                case 'license':
                    questionHtml = `
                <div class="form-section">
                     <input type="hidden" name="type[]" value="certificate">
                    <label class="form-label">Do you have a valid _________ ?</label>
                    <div class="input-group">
                    <input type="text" class="form-control form-control-padding_10" name="certificate[]" placeholder="Enter license/certification">
                    <button class="btn btn-danger" onclick="removeQuestion(this,'license')">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    </div>
                </div>`;
                    break;

                case 'location':
                    questionHtml = `
                    <input type="hidden" name="type[]" value="location">
                <div class="form-section">
                    <label class="form-label">Are you located in {{ $job->type == 'on-site' ? $job->city : 'Remote' }}?</label>
                    <div class="input-group">
                    <input type="text" class="form-control form-control-padding_10" name="location" value="Located in {{ $job->type == 'on-site' ? $job->city : 'Remote' }}" readonly>
                    <button class="btn btn-danger" onclick="removeQuestion(this,'location')">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    </div>
                </div>`;
                    addedQuestions.location = true;
                    break;

                case 'shift':
                    questionHtml = `
                <div class="form-section">
                        <input type="hidden" name="type[]" value="shift">
                    <label class="form-label">What is your shift availability?</label>
                    <input type="text" class="form-control form-control-padding_10" value="Available to work the following shift(s)">
                    <div class="input-group">
                        <label class="form-control" for="day_shift" value="Day Shift">
                            <input type="checkbox" name="shift[]" id="day_shift" value="Day Shift">
                            Day Shift
                        </label>
                        <label class="form-control" for="night_shift">
                            <input type="checkbox" name="shift[]" id="night_shift" value="Night Shift">
                            Night Shift
                        </label>
                        <label class="form-control" for="overnight_shift">
                            <input type="checkbox" name="shift[]" id="overnight_shift" value="Overnight Shift">
                            Overnight Shift
                        </label>
                    <button class="btn btn-danger" onclick="removeQuestion(this,'shift')">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    </div>
                </div>`;
                    addedQuestions.shift = true;
                    break;

                case 'travel':
                    questionHtml = `
                <div class="form-section">
                    <label class="form-label">Are you willing to travel for this position?</label>
                    <div class="input-group">
                        <input type="hidden" name="type[]" value="travel">
                    <select class="form-control form-control-padding_10" name="travel">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <button class="btn btn-danger" onclick="removeQuestion(this,'travel')">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    </div>
                </div>`;
                addedQuestions.travel = true;
                    break;

                case 'custom':
                    questionHtml = `
                <div class="form-section">
                        <input type="hidden" name="type[]" value="custom">
                    <label class="form-label">Create a custom question</label>
                    <div class="input-group">
                    <input type="text" class="form-control form-control-padding_10" name="custom_question[]" placeholder="Enter your custom question" name="custom_question">
                    <button class="btn btn-danger" onclick="removeQuestion(this,'custom')">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    </div>
                </div>`;
                    break;
            }

            // Append the new question to the dynamic questions section
            document.getElementById('dynamic-questions').insertAdjacentHTML('beforeend', questionHtml);
        }

        function removeQuestion(button, questionType) {
            // Remove the question section
            button.closest('.form-section').remove();
            // Allow re-adding the question
            addedQuestions[questionType] = false;
        }
    </script>
@endsection
