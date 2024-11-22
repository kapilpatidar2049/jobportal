@extends('jobportal.front.layouts.master')
@section('title', 'Is Your Resume Ready')
@section('main-container')
    <div class="container">
        <div class="client-area">
            <div class="header text-left my-4">
                <h2>Is your resume ready?</h2>
                <p>Review and make any changes below.</p>
            </div>
            <!-- Contact Information -->
            <div class="section-card">
                <div class="d-flex justify-content-between ">
                    <div class="">
                        <h5>{{ $resume->name }}</h5>
                        <p>{{ $resume->contry_code }}{{ $resume->phone }} | {{ $resume->email }}</p>
                        <p>{{ $resume->address }},{{ $resume->city }}, {{ $resume->state }},{{ $resume->pincode }}</p>
                    </div>
                    <i class="fas fa-edit icon-right" data-bs-toggle="modal" data-bs-target="#profileModel"></i>
                </div>
            </div>

            <!-- Summary -->
            <div class="section-card">
                <div class="d-flex justify-content-between ">
                    <h6 class="section-title">{{ __('Summary') }}</h6>
                    <i class="fas fa-edit icon-right" data-bs-toggle="modal" data-bs-target="#summaryModal"></i>
                </div>
                @if ($resume->summary)
                    <p>
                        {{ $resume->summary }}
                    </p>
                @else
                    <p class="text-muted">Your summary will appear here</p>
                @endif
            </div>

            <!-- Personal Information -->
            <div class="section-card">
                <div class="d-flex justify-content-between ">
                    <h6 class="section-title">{{ __('Personal Information') }} </h6>
                    <i class="fas fa-edit icon-right" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#personalInformationModal"></i>
                </div>
                @if ($resume->dob && $resume->eligible_to_work && $resume->career_label && $resume->industries)
                    <div class="personalinfo">
                        <strong>{{ __('Date of Birth: ') }}</strong><span>{{ $resume->dob }}</span> <br>
                        <strong>{{ __('Eligible to work in: ') }}</strong><span>{{ $resume->eligible_to_work }}</span>
                        <br>
                        <strong>{{ __('Highest Career Level: ') }}</strong><span>{{ $resume->career_label }}</span> <br>
                        <strong>{{ __('Industry: ') }}</strong><span>{{ $resume->industries }}</span> <br>
                        <strong>{{ __('Tota years of experience: ') }}</strong><span>{{ $resume->year_of_experience }}</span>
                        <br>
                        <div class="icon">
                            <form action="{{ route('resume.deletepersonalinfo') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $resume->id }}">
                                <button type="submit" class="btn btn-danger"><i
                                        class="fas fa-trash icon-right text-white"></i></button>
                            </form>
                        </div>
                    </div>
                @else
                    <p class="text-muted">Your personal information will appear here</p>
                @endif

            </div>

            <!-- Work Experience -->
            <div class="section-card">
                <div class="d-flex justify-content-between">
                    <h6 class="section-title">Work Experience</h6>
                    <i class="fas fa-plus" title="{{ __('Add New Experience') }}"
                        data-bs-toggle="modal"data-bs-target="#experienceModal"></i>
                </div>
                @php($workExperience = App\Models\Jobportal\WorkExperience::where('resume_id', $resume->id)->get())
                @foreach ($workExperience as $experience)
                    <div class="p-3 bg-light border rounded mb-2 d-flex justify-content-between ">
                        <div>
                            <h6>{{ $experience->job_title }}</h6>
                            <p>{{ $experience->company_name }} - {{ $experience->city }}, {{ $experience->state }}</p>
                            <p>{{ $experience->job_type }} |
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M-Y') }} to
                                {{ $experience->present == 1 ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M-Y') }}
                            </p>
                            <p>{!! $experience->description !!}</p>
                        </div>
                        <div>
                            <i class="fas fa-edit icon-right mr-2" title="{{ __('Edit') }}" data-bs-toggle="modal"
                                data-bs-target="#experienceModal{{ $experience->id }}"></i>
                            <a href="{{ route('delete.experience', $experience->id) }}"><i
                                    class="fas fa-trash icon-right"title="{{ __('Delete') }}"></i></a>
                        </div>
                    </div>
                    <!-- Edit Work Experience Modal -->
                    <div class="modal fade" id="experienceModal{{ $experience->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="experienceModalLabel" aria-hidden="true">
                        <div class="modal-dialog profile-model" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="experienceModalLabel">{{ __('Add Work Experience') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('edit.experience') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $experience->id }}">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="job_title" class="form-label">Job Title</label>
                                                    <input type="text" name="job_title"
                                                        class="form-control form-control-padding_10 @error('job_title') is-invalid @enderror"
                                                        placeholder="Enter job title"
                                                        value="{{ $experience->job_title ?? old('job_title') }}" required>
                                                    @error('job_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="company_name" class="form-label">Company Name</label>
                                                    <input type="text" name="company_name"
                                                        class="form-control form-control-padding_10 @error('company_name') is-invalid @enderror"
                                                        placeholder="Enter company name"
                                                        value="{{ $experience->company_name ?? old('company_name') }}"
                                                        required>
                                                    @error('company_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="job_type" class="form-label">Job Type</label>
                                                    <input type="text" name="job_type"
                                                        class="form-control form-control-padding_10 @error('job_type') is-invalid @enderror"
                                                        placeholder="Enter job type"
                                                        value="{{ $experience->job_type ?? old('job_type') }}" required>
                                                    @error('job_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="addresses row">
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="city" class="form-label">City</label>
                                                        <input type="text" name="workcity"
                                                            class="form-control city_id form-control-padding_10 @error('workcity') is-invalid @enderror"
                                                            placeholder="Enter city" value="{{ old('workcity') }}"
                                                            required>
                                                        @error('workcity')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="state" class="form-label">State</label>
                                                        <input type="text" name="workstate"
                                                            class="form-control state form-control-padding_10 @error('workstate') is-invalid @enderror"
                                                            placeholder="Enter state" value="{{ old('workstate') }}"
                                                            readonly>
                                                        @error('workstate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="country" class="form-label">Country</label>
                                                        <input type="text" name="workcountry"
                                                            class="form-control country form-control-padding_10 @error('workcountry') is-invalid @enderror"
                                                            placeholder="Enter country" value="{{ old('workcountry') }}"
                                                            readonly>
                                                        @error('workcountry')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="enddate row">
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="workstart_date" class="form-label">Start Date</label>
                                                        <input type="text" name="workstart_date"
                                                            class="form-control form-control-padding_10 datepicker @error('workstart_date') is-invalid @enderror"
                                                            placeholder="yyyy-mm-dd"
                                                            value="{{ $experience->start_date ?? old('workstart_date') }}">
                                                        @error('workstart_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 enddatediv">
                                                    <div class="form-group mb-3 ">
                                                        <label for="workend_date" class="form-label">End Date</label>
                                                        <input type="text" name="workend_date"
                                                            class="form-control form-control-padding_10 datepicker @error('workend_date') is-invalid @enderror"
                                                            placeholder="yyyy-mm-dd"
                                                            value="{{ $experience->end_date ?? old('workend_date') }}">
                                                        @error('workend_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-check-input workingStatusYes m-3"
                                                                type="checkbox" name="present" value="1"
                                                                {{ old('present') || ($experience->present ?? false) ? 'checked' : '' }}>
                                                            <label class="form-label" for="workingStatusYes">Currently
                                                                working
                                                                here?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" class="form-control form-control-padding_10 @error('description') is-invalid @enderror"
                                                    placeholder="Enter job description" cols="30" rows="10">{{ $experience->description ?? old('description') }}</textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Education -->
            <div class="section-card">
                <div class="d-flex justify-content-between">
                    <h6 class="section-title">Education</h6>
                    <i class="fas fa-plus" title="{{ __('Add Education') }}" data-bs-toggle="modal"
                        data-bs-target="#educationModal"></i>
                </div>
                @php($educations = App\Models\Jobportal\Education::where('resume_id', $resume->id)->get())
                @foreach ($educations as $education)
                    <div class="p-3 bg-light border rounded mb-2 d-flex justify-content-between ">
                        <div>
                            <h6>{{ $education->degree }} in {{ $education->specialization }}</h6>
                            <p>{{ $education->insitution }}</p>
                            <p>{{ \Carbon\Carbon::parse($education->start_date)->format('M-Y') }} to
                                {{ \Carbon\Carbon::parse($education->end_date)->format('M-Y') }}</p>
                            <p>Scored {{ $education->percentage }}</p>
                        </div>
                        <div>
                            <i class="fas fa-edit icon-right mr-2" title="{{ __('Edit') }}" data-bs-toggle="modal"
                                data-bs-target="#educationModal{{ $education->id }}"></i>
                            <a href="{{ route('delete.education', $education->id) }}"><i class="fas fa-trash icon-right"
                                    title="{{ __('Delete') }}"></i></a>
                        </div>
                    </div>

                    <!-- Edit Education -->
                    <div class="modal fade" id="educationModal{{ $education->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="educationModalLabel" aria-hidden="true">
                        <div class="modal-dialog profile-model" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="educationModalLabel">{{ __('Add Education') }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('edit.education') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $education->id }}">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="degree" class="form-label">Degree</label>
                                                    <input type="text" name="degree"
                                                        class="form-control form-control-padding_10 @error('degree') is-invalid @enderror"
                                                        value="{{ old('degree', $education->degree ?? '') }}" required>
                                                    @error('degree')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="degree_specialization" class="form-label">Degree
                                                        Specialization</label>
                                                    <input type="text" name="degree_specialization"
                                                        class="form-control form-control-padding_10 @error('degree_specialization') is-invalid @enderror"
                                                        value="{{ old('degree_specialization', $education->specialization ?? '') }}"
                                                        required>
                                                    @error('degree_specialization')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="institution" class="form-label">Institution</label>
                                                    <input type="text" name="institution"
                                                        class="form-control form-control-padding_10 @error('institution') is-invalid @enderror"
                                                        value="{{ old('institution', $education->insitution ?? '') }}"
                                                        required>
                                                    @error('institution')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="year_of_passing" class="form-label">Year of
                                                        Passing</label>
                                                    <input type="number" name="year_of_passing"
                                                        class="form-control form-control-padding_10 @error('year_of_passing') is-invalid @enderror"
                                                        value="{{ old('year_of_passing', $education->year_of_passing ?? '') }}"
                                                        required>
                                                    @error('year_of_passing')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="percentage" class="form-label">Percentage/CGPA</label>
                                                    <input type="text" name="percentage"
                                                        class="form-control form-control-padding_10 @error('percentage') is-invalid @enderror"
                                                        value="{{ old('percentage', $education->percentage ?? '') }}"
                                                        required>
                                                    @error('percentage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="text" name="start_date"
                                                        class="form-control datepicker form-control-padding_10 @error('start_date') is-invalid @enderror"
                                                        value="{{ old('start_date', $education->start_date ?? '') }}"
                                                        required placeholder="yyyy-mm-dd">
                                                    @error('start_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="text" name="end_date"
                                                        class="form-control datepicker form-control-padding_10 @error('end_date') is-invalid @enderror"
                                                        value="{{ old('end_date', $education->end_date ?? '') }}" required
                                                        placeholder="yyyy-mm-dd">
                                                    @error('end_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Certifications -->
            <div class="section-card">
                <div class="d-flex justify-content-between ">
                    <h6 class="section-title">Certifications</h6>
                    <i class="fas fa-plus icon-right" title="{{ __('Add Certificate') }}" data-bs-toggle="modal"
                        data-bs-target="#certificateModal"></i>
                </div>
                @php($certificates = App\Models\Jobportal\Certification::where('resume_id', $resume->id)->get())
                @if (isset($certificates))
                    <ul class="list-group">
                        @foreach ($certificates as $certificate)
                            <li class="list-group-item d-flex justify-content-between ">
                                {{ $certificate->certificate }}
                                <a href="{{ route('delete.certificate', $certificate->id) }}"><i
                                        class="fas fa-trash icon-right"></i></a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Your certifications will appear here</p>
                @endif

            </div>

            <!-- Skills -->
            <div class="section-card">
                <div class="d-flex justify-content-between ">
                    <h6 class="section-title">Skills</h6>
                    <i class="fas fa-plus icon-right" title="{{ __('Add Skills') }}" data-bs-toggle="modal"
                        data-bs-target="#skillModal"></i>
                </div>
                @php($skills = App\Models\Jobportal\UserSkills::where('resume_id', $resume->id)->get())
                @if (isset($skills))
                    <ul class="list-group">
                        @foreach ($skills as $skill)
                            <li class="list-group-item d-flex justify-content-between ">
                                {{ $skill->skills }}
                                <a href="{{ route('delete.skills', $skill->id) }}"><i
                                        class="fas fa-trash icon-right"></i></a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Your Skills will appear here</p>
                @endif
            </div>

            <!-- Continue Button -->
            <div class="text-center my-4">
                <a href="{{route('searchable')}}" class="btn btn-primary btn-lg">Continue</a>
            </div>
        </div>
    </div>
    <!-- Contact Information -->
    <div class="modal fade" id="profileModel" tabindex="-1" role="dialog" aria-labelledby="profileModelLabel"
        aria-hidden="true">
        <div class="modal-dialog profile-model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModelLabel">{{ __('Contact Information') }} </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('resume.contactinfo') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Profile Image -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="file" accept="image/*" onchange="readURL(this);"
                                                class="form-control" id="profile_image" name="profile">
                                        </div>
                                        <div class="col-2">
                                            @if (!$resume->image)
                                                <img src="" class="img-fluid" id="profile"
                                                    alt="{{ $resume->email }}">
                                            @else
                                                <img src="{{ url('jobportal/user/' . $resume->image) }}"
                                                    alt="{{ $resume->email }}" id="profile"
                                                    class="img-fluid form-control-padding_10">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-control-icon"><i class="fa-solid fa-upload"></i></div>
                                </div>
                            </div>
                            <!-- Name -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder="Please Enter Your Name" value="{{ old('name', $resume->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-control-icon"><i class="fa-solid fa-n"></i></div>
                                </div>
                            </div>
                            <!-- Phone -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">{{ __('Your phone number') }}</label>
                                    <div class="country-code d-flex">
                                        <div class="col-3">
                                            <select class="form-control form-control-padding_10" id="country_code"
                                                name="country_code">
                                                @php($countries = App\Models\Allcountry::where('phonecode', '!=', null)->get())
                                                @foreach ($countries as $item)
                                                    <option value="+{{ $item->phonecode }}"
                                                        @if ($item->phonecode == $resume->contry_code) selected @endif>
                                                        +{{ $item->phonecode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9">
                                            <input type="text"
                                                class="form-control form-control-padding_10 @error('phone') is-invalid @enderror"
                                                name="phone" id="phone_number"
                                                value="{{ old('phone', $resume->phone) }}"
                                                placeholder="Enter phone number">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email', Auth::guard('jobportal')->user()->email) }}" readonly>
                                    <div class="form-control-icon"><i class="fa-solid fa-envelope"></i></div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Street Address') }}</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Please Enter Your Address"
                                        value="{{ old('address', $resume->address) }}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-control-icon"><i class="fa-solid fa-location-crosshairs"></i></div>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pincode" class="form-label">{{ __('Pincode') }}</label>
                                    <input type="number" class="form-control @error('pincode') is-invalid @enderror"
                                        id="pincode" name="pincode" placeholder="Please Enter Your Pincode"
                                        value="{{ old('pincode', $resume->pincode) }}">
                                    <div class="form-control-icon"><img src="{{ url('jobportal/icon/zipcode.svg') }}"
                                            alt="" width="25px" class="img-fluid"></div>
                                    @error('pincode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="addresses row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-label">{{ __('City') }}</label>
                                        <input class="form-control form-control-padding_10 city_id" type="text"
                                            name="city" placeholder="{{ __('Please Enter Your City Name') }}"
                                            value="{{ $resume->city }}" aria-label="city" id="city" required>
                                        <input type="hidden" name="city_id" class="city_id">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- State -->
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="state" class="form-label">{{ __('State') }}</label>
                                        <input
                                            class="form-control form-control-padding_10 state @error('state') is-invalid @enderror"
                                            type="text" name="state"
                                            placeholder="{{ __('Please Enter Your State Name') }}"
                                            value="{{ $resume->state }}" aria-label="state" id="state" readonly>
                                        <input type="hidden" name="state_id" class="state_id">
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="country" class="form-label">{{ __('Country') }}</label>
                                        <input
                                            class="form-control form-control-padding_10 country @error('country') is-invalid @enderror"
                                            type="text" name="country" value="{{ $resume->country }}"
                                            placeholder="{{ __('Please Enter Your Country Name') }}"
                                            aria-label="country" id="country" readonly>
                                        <input type="hidden" name="country_id" class="country_id">
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Summary Modal -->
    <div class="modal fade" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="summaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="summaryModalLabel">{{ __('Summary') }} </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('resume.summary') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <textarea name="summary" id="desc" cols="30" rows="10">{!! $resume->summary !!}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="modal fade" id="personalInformationModal" tabindex="-1"
        role="dialog"aria-labelledby="personalInformationModalLabel" aria-hidden="true">
        <div class="modal-dialog personal-imformation" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="personalInformationModalLabel">{{ __('Personal Information') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('resume.personalinfo') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Date of Birth Field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dob" class="form-label">{{ __('Date Of Birth') }}</label>
                                    <input type="text" name="dob" id="dob" class="form-control datepicker"
                                        value="{{ old('dob', $resume->dob) }}">
                                    <div class="form-control-icon"><i class="fa-regular fa-calendar"></i></div>
                                </div>
                            </div>

                            <!-- Career Label Dropdown -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="career_label"
                                        class="form-label">{{ __('Highest Career Label') }}</label>
                                    <select name="career_label" id="career_label" class="form-control form-select">
                                        <option value="">{{ __('Select') }}</option>
                                        <option value="No Experience / Student"
                                            @if (old('career_label', $resume->career_label) == 'No Experience / Student') selected @endif>
                                            {{ __('No Experience / Student') }}
                                        </option>
                                        <option value="Fresher" @if (old('career_label', $resume->career_label) == 'Fresher') selected @endif>
                                            {{ __('Fresher') }}
                                        </option>
                                        <option value="1-2 years experience"
                                            @if (old('career_label', $resume->career_label) == '1-2 years experience') selected @endif>
                                            {{ __('1-2 years experience') }}
                                        </option>
                                        <option value="2-5 years experience"
                                            @if (old('career_label', $resume->career_label) == '2-5 years experience') selected @endif>
                                            {{ __('2-5 years experience') }}
                                        </option>
                                        <option value="5+ years experience"
                                            @if (old('career_label', $resume->career_label) == '5+ years experience') selected @endif>
                                            {{ __('5+ years experience') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Eligible to Work Multi-Select -->
                        <div class="form-group">
                            <label for="eligible_to_work" class="form-label">{{ __('Eligible to work') }}</label>
                            <select name="eligible_to_work[]" id="eligible_to_work"
                                class="form-control select2 form-select" multiple>
                                @php($countries = App\Models\Allcountry::all())
                                @foreach ($countries as $item)
                                    <option value="{{ $item->name }}"
                                        @if (in_array($item->name, old('eligible_to_work', explode(',', $resume->eligible_to_work) ?? []))) selected @endif>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Industry Multi-Select -->
                        <div class="form-group">
                            <label for="industry" class="form-label">{{ __('Industry') }}</label>
                            <select name="industry[]" id="industry" class="form-control select2 form-select" multiple>
                                @php($industry = App\Models\Jobportal\SubIndustries::all())
                                @foreach ($industry as $item)
                                    <option value="{{ $item->name }}"
                                        @if (in_array($item->name, old('industry', explode(',', $resume->industries) ?? []))) selected @endif>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Years of Experience Field -->
                        <div class="form-group">
                            <label for="year_of_experience"
                                class="form-label">{{ __('Total years of experience') }}</label>
                            <input type="number" name="year_of_experience" id="year_of_experience"
                                value="{{ old('year_of_experience', $resume->year_of_experience) }}"
                                class="form-control form-control-padding_10">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Work Experience -->
    <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="experienceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog profile-model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="experienceModalLabel">{{ __('Add Work Experience') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('create.experience') }}" method="post">
                    @csrf
                    <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="job_title" class="form-label">Job Title</label>
                                    <input type="text" name="job_title"
                                        class="form-control form-control-padding_10 @error('job_title') is-invalid @enderror"
                                        placeholder="Enter job title" value="{{ old('job_title') }}" required>
                                    @error('job_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" name="company_name"
                                        class="form-control form-control-padding_10 @error('company_name') is-invalid @enderror"
                                        placeholder="Enter company name" value="{{ old('company_name') }}" required>
                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="job_type" class="form-label">Job Type</label>
                                    <input type="text" name="job_type"
                                        class="form-control form-control-padding_10 @error('job_type') is-invalid @enderror"
                                        placeholder="Enter job type" value="{{ old('job_type') }}" required>
                                    @error('job_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="addresses row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="workcity"
                                            class="form-control city_id form-control-padding_10 @error('workcity') is-invalid @enderror"
                                            placeholder="Enter city" value="{{ old('workcity') }}" required>
                                        @error('workcity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" name="workstate"
                                            class="form-control state form-control-padding_10 @error('workstate') is-invalid @enderror"
                                            placeholder="Enter state" value="{{ old('workstate') }}" readonly>
                                        @error('workstate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" name="workcountry"
                                            class="form-control country form-control-padding_10 @error('workcountry') is-invalid @enderror"
                                            placeholder="Enter country" value="{{ old('workcountry') }}" readonly>
                                        @error('workcountry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="enddate row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="workstart_date" class="form-label">Start Date</label>
                                        <input type="text" name="workstart_date"
                                            class="form-control form-control-padding_10 datepicker @error('workstart_date') is-invalid @enderror"
                                            placeholder="yyyy-mm-dd" value="{{ old('workstart_date') }}">
                                        @error('workend_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3 enddatediv">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="text" name="workend_date"
                                            class="form-control form-control-padding_10 datepicker @error('workend_date') is-invalid @enderror"
                                            placeholder="yyyy-mm-dd" value="{{ old('workend_date') }}">
                                        @error('workend_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input workingStatusYes m-3" type="checkbox"
                                                name="present" value="1" {{ old('present') ? 'checked' : '' }}>
                                            <label class="form-label" for="workingStatusYes">Currently working
                                                here?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control form-control-padding_10 @error('description') is-invalid @enderror"
                                    placeholder="Enter job description" cols="30" rows="10">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Education -->
    <div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog profile-model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="educationModalLabel">{{ __('Add Education') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('create.education') }}" method="post">
                    @csrf
                    <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="degree" class="form-label">Degree</label>
                                    <input type="text" name="degree"
                                        class="form-control form-control-padding_10 @error('degree') is-invalid @enderror"
                                        value="{{ old('degree') }}" required>
                                    @error('degree')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="degree_specialization" class="form-label">Degree Specialization</label>
                                    <input type="text" name="degree_specialization"
                                        class="form-control form-control-padding_10 @error('degree_specialization') is-invalid @enderror"
                                        value="{{ old('degree_specialization') }}" required>
                                    @error('degree_specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="institution" class="form-label">Institution</label>
                                    <input type="text" name="institution"
                                        class="form-control form-control-padding_10 @error('institution') is-invalid @enderror"
                                        value="{{ old('institution') }}" required>
                                    @error('institution')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="year_of_passing" class="form-label">Year of Passing</label>
                                    <input type="number" name="year_of_passing"
                                        class="form-control form-control-padding_10 @error('year_of_passing') is-invalid @enderror"
                                        value="{{ old('year_of_passing') }}" required>
                                    @error('year_of_passing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="percentage" class="form-label">Percentage/CGPA</label>
                                    <input type="text" name="percentage"
                                        class="form-control form-control-padding_10 @error('percentage') is-invalid @enderror"
                                        value="{{ old('percentage') }}" required>
                                    @error('percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="text" name="start_date"
                                        class="form-control datepicker form-control-padding_10 @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}" required placeholder="yyyy-mm-dd">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="text" name="end_date"
                                        class="form-control datepicker form-control-padding_10 @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}" required placeholder="yyyy-mm-dd">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Certificate -->
    <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="certificateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="certificateModalLabel">Add Certificate</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('create.certificate') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <button type="button" id="add-certificate" title="{{ __('Add More') }}"
                            class="btn btn-primary float-end">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <br><br>

                        <div id="certificate-container">
                            <div class="form-group mb-3">
                                <label for="certificate" class="form-label">Certificate/License</label>
                                <input type="text" name="certificate[]" class="form-control form-control-padding_10"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Skills -->
    <div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skillModalLabel">{{ __('Add Skills') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('create.skills') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $resume->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="skill-search">Add Skills</label>
                            <input type="text" id="skill-search" placeholder="Type to filter skills..."
                                class="form-control form-control-padding_10">
                        </div>
                        <div id="skillform"></div>
                        <div class="dropdown-list" id="dropdownSkills"></div>
                        <div class="skill-list d-flex flex-wrap" id="selectedSkills"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            toggleEndWorking();
            // $('#workingStatusYes').on('change', toggleEndWorking);
            $(document).on('change', '.workingStatusYes', toggleEndWorking);

            function toggleEndWorking() {
                const endDate = $(this).closest('.enddate').find('.enddatediv');
                const isYesChecked = $(this).is(':checked');
                if (isYesChecked) {
                    endDate.hide();
                } else {
                    endDate.show();
                }
            }
        });
    </script>
    <script>
        const $certificateContainer = $('#certificate-container');
        $('#add-certificate').on('click', addCertificateEntry);

        function addCertificateEntry() {
            const $entry = $('<div class="certificate-entry">').html(`
            <button type="button" class="btn btn-danger btn-sm remove-btn text-white">Remove</button><br>
            <div class="form-group mb-3">
                <label for="certificate" class="form-label">Certificate/License</label>
                <input type="text" name="certificate[]" class="form-control form-control-padding_10" required>
            </div>
        `);
            $certificateContainer.append($entry);
        }
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.education-entry, .work-entry, .certificate-entry').remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            let skills = []; // Initialize skills as an empty array

            // Fetch skills from the database
            $.ajax({
                url: '/api/skills', // The endpoint you defined
                method: 'GET',
                success: function(data) {
                    skills = data;
                    // console.log(skills);
                },
                error: function(err) {
                    console.error('Error fetching skills:', err);
                }
            });

            // Filter skills as user types
            $('#skill-search').on('input', function() {
                let searchText = $(this).val().toLowerCase();
                let filteredSkills = skills.filter(skill => skill.skill.toLowerCase().includes(searchText));

                // Clear dropdown list
                $('#dropdownSkills').empty();
                if (filteredSkills.length > 0) {
                    filteredSkills.forEach(skill => {
                        $('#dropdownSkills').append(
                            `<div class="dropdown-item" data-value="${skill.skill}">${skill.skill}</div>`
                        );
                    });
                    $('#dropdownSkills').show(); // Show dropdown
                } else {
                    $('#dropdownSkills').hide(); // Hide if no results
                }
            });

            // When a skill is selected from the dropdown
            $(document).on('click', '.dropdown-item', function() {
                let skillValue = $(this).data('value');
                let skillText = $(this).text();

                // Check if skill already exists in the selected skills
                if ($('#selectedSkills div[data-skill="' + skillValue + '"]').length === 0) {
                    let skillItem = `<div class="skill-item" data-skill="${skillValue}">
                                    ${skillText}
                                    <span class="remove-skill">&times;</span> <!-- Add X button -->
                                 </div>`;
                    let skillInput =
                        `<input type="hidden" name="skill[]" value="${skillValue}">`; // Use hidden input for the skill value
                    $('#skillform').append(skillInput);
                    $('#selectedSkills').append(skillItem);

                }

                // Clear the input field and hide the dropdown
                $('#skill-search').focus();
                $('#skill-search').val('');
                $('#dropdownSkills').hide();
            });

            // Remove skill by clicking on the X button
            $(document).on('click', '.remove-skill', function(e) {
                e.stopPropagation(); // Prevent click event from bubbling up
                const skillItem = $(this).parent('.skill-item'); // Get the parent skill item
                const skillValue = skillItem.data('skill'); // Get the skill value

                // Remove the corresponding hidden input from the form
                $('#skillform input[value="' + skillValue + '"]').remove();

                skillItem.remove(); // Remove the skill item
            });

            // Hide the dropdown when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('#skill-search, #dropdownSkills').length) {
                    $('#dropdownSkills').hide(); // Hide the dropdown
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Use event delegation to bind the change event to dynamically added city_id elements
            $(document).on('change', '.city_id', function() {
                // Get the value of the city input field
                const city = $(this).val();

                // Make sure that we are targeting the correct elements for state, state_id, country, country_id
                const stateInput = $(this).closest('.addresses').find('.state');
                const stateIdInput = $(this).closest('.addresses').find('.state_id');
                const countryInput = $(this).closest('.addresses').find('.country');
                const countryIdInput = $(this).closest('.addresses').find('.country_id');

                // Log the elements to ensure they are selected correctly
                console.log($(this).closest('.modal').attr('id'));

                $.ajax({
                    type: "GET",
                    url: "{{ route('get.state.country') }}",
                    data: {
                        city: city
                    },
                    success: function(data) {
                        if (data.status === 'True') {
                            // Set the values for state, state_id, country, and country_id
                            stateInput.val(data.state);
                            stateIdInput.val(data.state_id);
                            countryInput.val(data.country);
                            countryIdInput.val(data.country_id);
                            $('.error').hide(); // Hide any error messages
                        } else {
                            // Clear values and show error if no data found
                            stateInput.val('');
                            stateIdInput.val('');
                            countryInput.val('');
                            countryIdInput.val('');
                            $('.error').show().text(data.msg);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                    }
                });
            });
        });
    </script>
@endsection
