@extends('jobportal.front.layouts.master')
@section('title', 'Review Application')
@section('main-container')
    <div class="container my-5">
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="job-title">{{ $job->title }}</h2>
                <p class="mb-0">
                    @if ($job->type == 'remote')
                        Remote
                    @else
                        {{ $job->area }},{{ $job->city }},{{ $job->state }},{{ $job->pincode }}
                    @endif
                </p>
            </div>
        </div>
        <div class="card">
            <form action="{{ route('apply.job') }}" method="post">
                @csrf
                <input type="hidden" name="job_id" value="{{ $id }}">
                <div class="card-body">
                    <h3 class="card-title text-center">Please review your application</h3>
                    @php($user = Auth::guard('jobportal')->user())
                    @php($resume = App\Models\Jobportal\BuildResume::where('user_id', $user->id)->first())
                    <!-- Contact Information -->
                    <div class="section-card mb-3">
                        <h4>Contact Information <a type="button" class="float-end btn btn-link"
                                data-bs-target="#contactModal" data-bs-toggle="modal"><i class="fa-solid fa-pencil"></i></a>
                        </h4>
                        <div class="info-box">
                            <p><strong>Full name:</strong> {{ $user->name }}</p>
                            <p><strong>Email address:</strong> {{ $user->email }}</p>
                            <p><strong>Phone Number:</strong> {{ $user->country_code }} {{ $user->phone }}</p>
                        </div>
                    </div>

                    <!-- CV Section -->
                    <div class="section-card mb-3">
                        <h4>CV <a type="button" data-bs-toggle="modal" data-bs-target="#resumeModal"
                                class="float-end btn btn-link"> <i class="fa-solid fa-pencil"></i></a></h4>
                        <div class="info-box">
                            @if ($user->resume == 'upload')
                                @php($file = App\Models\Jobportal\JobportalResume::where('user_id', $user->id)->first())
                                <p class="section-card"><i class="fa-solid fa-file-pdf"></i><strong>
                                        {{ $file->resume }}</strong></p>
                            @else
                                <div class="section-card">
                                    @if (isset($resume))
                                        <h5>{{ $resume->name }}</h5>
                                        <small>{{ $resume->address }},{{ $resume->city }},{{ $resume->state }},{{ $resume->pincode }}</small><br>
                                        <small style="color:var(--text_dark_blue)">{{ $resume->email }}</small><br>
                                        <small class="font-small">{{ $resume->contry_code }}
                                            {{ $resume->phone }}</small><br>
                                        <p class="my-3">
                                            {!! $resume->summary !!}
                                        </p>
                                    @endif
                                    @php($workExperience = App\Models\Jobportal\WorkExperience::where('resume_id', $resume->id)->get())
                                    @if ($workExperience)
                                        <h4 class="text-muted">Work Experience</h4>
                                        <hr style="background-color: black">
                                        @foreach ($workExperience as $experience)
                                            <div>
                                                <h6>{{ $experience->job_title }}</h6>
                                                <small>{{ $experience->company_name }} - {{ $experience->city }},
                                                    {{ $experience->state }}</small> <br>
                                                <small>{{ $experience->job_type }} |
                                                    {{ \Carbon\Carbon::parse($experience->start_date)->format('M-Y') }} to
                                                    {{ $experience->present == 1 ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M-Y') }}
                                                </small> <br>
                                                <small>{!! $experience->description !!}</small>
                                            </div>
                                        @endforeach
                                    @endif
                                    @php($educations = App\Models\Jobportal\Education::where('resume_id', $resume->id)->get())
                                    @if (isset($educations))
                                        <h4 class="text-muted mt-3">Education</h4>
                                        <hr style="background-color: black">
                                        @foreach ($educations as $education)
                                            <div>
                                                <h6>{{ $education->degree }} in {{ $education->specialization }}</h6>
                                                <small>{{ $education->insitution }}</small><br>
                                                <small>{{ \Carbon\Carbon::parse($education->start_date)->format('M-Y') }}
                                                    to
                                                    {{ \Carbon\Carbon::parse($education->end_date)->format('M-Y') }}</small><br>
                                                <small>Scored {{ $education->percentage }}</small>
                                            </div>
                                        @endforeach
                                    @endif
                                    <h4 class="text-muted mt-3">Skills</h4>
                                    <hr style="background-color: black">
                                    @php($skills = App\Models\Jobportal\UserSkills::where('resume_id', $resume->id)->get())
                                    <ul>
                                        @foreach ($skills as $skill)
                                            <li>
                                                {{ $skill->skills }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    @php($certificates = App\Models\Jobportal\Certification::where('resume_id', $resume->id)->get())
                                    @if (isset($certificates))
                                        <h4 class="text-muted mt-3">Certificate</h4>
                                        <hr style="background-color: black">
                                        <ul class="">
                                            @foreach ($certificates as $certificate)
                                                <li>
                                                    {{ $certificate->certificate }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Supporting Documents -->
                    <div class="section-card mb-3">
                        <h4>Supporting documents <a type="button" data-bs-toggle="modal" data-bs-target="#coverLetterModal"
                                class="float-end btn btn-link">Add</a></h4>
                        @if (isset($user->cover_latter))
                            {{ $user->cover_latter }}
                        @else
                            <p>No cover letter or additional documents included (optional)</p>
                        @endif
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button class="btn btn-primary submit-btn">{{ __('Apply') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Contact Details -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="contactModalLabel">Edit Contact Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jobportal.saveProfile') }}" class="form" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <h3>{{ __('Contact Details') }}</h3>
                            {{-- @php($) --}}
                            <!-- Name -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Name') }} <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Please Enter Your Name"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-control-icon"><i class="fa-solid fa-n"></i></div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">{{ __('Your phone number') }} <span
                                            class="required">*</span></label>
                                    <div class="country-code d-flex">
                                        <div class="col-3">
                                            <select class="form-control form-control-padding_10" id="country_code"
                                                name="country_code">
                                                @php($countries = App\Models\Allcountry::where('phonecode', '!=', null)->get())
                                                @foreach ($countries as $item)
                                                    <option value="+{{ $item->phonecode }}"
                                                        {{ old('country_code', $user->country_code) == '+' . $item->phonecode ? 'selected' : '' }}>
                                                        +{{ $item->phonecode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9">
                                            <input type="text"
                                                class="form-control form-control-padding_10 @error('phone') is-invalid @enderror"
                                                name="phone" id="phone_number" value="{{ old('phone', $user->phone) }}"
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }} <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email', Auth::guard('jobportal')->user()->email) }}" readonly>
                                    <div class="form-control-icon"><i class="fa-solid fa-envelope"></i></div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Street Address') }} <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Please Enter Your Address"
                                        value="{{ old('address', $user->address) }}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-control-icon"><i class="fa-solid fa-location-crosshairs"></i></div>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pincode" class="form-label">{{ __('Pincode') }} <span
                                            class="required">*</span></label>
                                    <input type="number" class="form-control @error('pincode') is-invalid @enderror"
                                        id="pincode" name="pincode" placeholder="Please Enter Your Pincode"
                                        value="{{ old('pincode', $user->pincode) }}">
                                    <div class="form-control-icon"><img src="{{ url('jobportal/icon/zipcode.svg') }}"
                                            alt="" width="25px" class="img-fluid"></div>
                                    @error('pincode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- City -->
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label for="city" class="form-label">{{ __('City') }}
                                        <span class="required">*</span>
                                    </label>
                                    <input
                                        class="form-control form-control-padding_10 city_id @error('city') is-invalid @enderror"
                                        type="text" name="city"
                                        placeholder="{{ __('Please Enter Your City Name') }}"
                                        value="{{ $user->city }}" aria-label="city" id="city"
                                        onchange="get_state_country(this.value)" required>
                                    <input type="hidden" name="city" class="city_id">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- State -->
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label for="state" class="form-label">{{ __('State') }}
                                        <span class="required">*</span>
                                    </label>
                                    <input
                                        class="form-control form-control-padding_10 state_id @error('state') is-invalid @enderror"
                                        type="text" name="state"
                                        placeholder="{{ __('Please Enter Your State Name') }}"
                                        value="{{ $user->state }}" aria-label="state" id="state" readonly>
                                    <input type="hidden" name="state" class="state_id">
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Country -->
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label for="country" class="form-label">{{ __('Country') }}
                                        <span class="required">*</span>
                                    </label>
                                    <input
                                        class="form-control form-control-padding_10 country_id @error('country') is-invalid @enderror"
                                        type="text" name="country" value="{{ $user->country }}"
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Select Resume -->
    <div class="modal fade" id="resumeModal" tabindex="-1" aria-labelledby="resumeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="resumeModalLabel">Select Resume Type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('resume.type') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="build">
                            <div class="cv-option">
                                <input type="radio" id="build" value="build" name="resume_type" class="d-none">
                                <h2>Jobportal CV</h2>
                                <p>You Are Build With Jobportal</p>
                                <iframe id="pdf-preview" class="pdf-preview" src="" type="application/pdf"
                                    style="display: none;"></iframe>
                            </div>
                        </label>
                        <label for="upload">
                            <div class="cv-option">
                                <h2>Upload a CV</h2>
                                <p>Your Uploaded CV</p>
                                <iframe id="pdf-preview" class="pdf-preview" src="" type="application/pdf"
                                    style="display: none;"></iframe>
                            </div>
                        </label>
                        <input type="radio" id="upload" value="upload" name="resume_type" class="d-none">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Cover Latter -->
    <div class="modal fade" id="coverLetterModal" tabindex="-1" aria-labelledby="coverLetterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="coverLetterModalLabel">Add A cover Letter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cover.letter') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="coverlatter" class="form-label">Cover Letter</label>
                        <small>if you not want to add cover letter, leave it blank</small>
                        <textarea name="cover_latter" id="coverlatter" cols="30" rows="10">{{ $user->cover_latter }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
