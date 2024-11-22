@extends('jobportal.front.layouts.master')
@section('title', 'Resume')
@section('main-container')
    <div class="row resume_main_box">
        <div class="col-lg-6 p-0 ">
            <div class="resume_side_image_box">
                <img src="{{ url('assets/images/resume-side.jpg') }}" alt="" class="resume_side_image">
            </div>
        </div>
        @include('jobportal.layouts.flash_msg')
        <div class="col-lg-6 p-0 resume_content_box">
            @php($user = Auth::guard('jobportal')->user())
            <div class="client-area m-0">
                @include('jobportal.layouts.flash_msg')
                <form id="cv-form" action="{{ route('jobportal.build_resume.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <!-- Step 1: Personal Info -->
                    <div class="form-step-container" id="step-1">
                        @csrf
                        <div class="row">
                            <h3>{{ __('Personal Information') }}</h3>
                            <!-- Profile Image -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="file" accept="image/*" onchange="readURL(this);"
                                                class="form-control" id="profile_image" name="profile">
                                        </div>
                                        <div class="col-2">
                                            @if (!$user->image)
                                                <img src="{{ Avatar::create($user->email) }}" class="img-fluid"
                                                    id="profile" alt="{{ $user->email }}">
                                            @else
                                                <img src="{{ url('jobportal/user/' . $user->image) }}"
                                                    alt="{{ $user->email }}" id="profile"
                                                    class="img-fluid form-control-padding_10">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-control-icon"><i class="fa-solid fa-upload"></i></div>
                                </div>
                            </div>
                            <!-- Name -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder="Please Enter Your Name" value="{{ old('name', $user->name) }}">
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
                                    <label for="phone_number" class="form-label">{{ __('Your phone number') }}</label>
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
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email', Auth::guard('jobportal')->user()->email) }}" readonly>
                                    <div class="form-control-icon"><i class="fa-solid fa-envelope"></i></div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Street Address') }}</label>
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
                                    <label for="pincode" class="form-label">{{ __('Pincode') }}</label>
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
                            <div class="addresses row">
                                <!-- City -->
                                <div class="col-lg-6 col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-label">{{ __('City') }}</label>
                                        <input
                                            class="form-control form-control-padding_10 city_id @error('city') is-invalid @enderror"
                                            type="text" name="city"
                                            placeholder="{{ __('Please Enter Your City Name') }}"
                                            value="{{ $user->city }}" aria-label="city" id="city" required>
                                        <input type="hidden" name="city_id" class="city_id">
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
                                        <label for="state" class="form-label">{{ __('State') }}</label>
                                        <input
                                            class="form-control form-control-padding_10 state_id @error('state') is-invalid @enderror"
                                            type="text" name="state"
                                            placeholder="{{ __('Please Enter Your State Name') }}"
                                            value="{{ $user->state }}" aria-label="state" id="state" readonly>
                                        <input type="hidden" name="state_id" class="state_id">
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
                                        <label for="country" class="form-label">{{ __('Country') }}</label>
                                        <input
                                            class="form-control form-control-padding_10 country_id @error('country') is-invalid @enderror"
                                            type="text" name="country" value="{{ $user->country }}"
                                            placeholder="{{ __('Please Enter Your Country Name') }}" aria-label="country"
                                            id="country" readonly>
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
                        <div class="col-lg-12 float-end">
                            <button type="button" class="step-next-btn btn btn-primary">Next</button>
                        </div>
                    </div>

                    <!-- Step 2: Education -->
                    <div class="form-step-container" id="step-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Step 2: Education</h2>
                            <button type="button" id="add-education" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div id="education-container">
                            <!-- Education entries will be added here dynamically -->
                            <div class="education-entry mb-4 p-3 border rounded">
                                <div class="form-group mb-3">
                                    <label for="degree" class="form-label">Degree</label>
                                    <input type="text" name="degree[]" class="form-control form-control-padding_10 @error('degree.*') is-invalid @enderror"
                                        value="{{ old('degree.0') }}" required>
                                    @error('degree.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="degree_specialization" class="form-label">Degree Specialization</label>
                                    <input type="text" name="degree_specialization[]" class="form-control form-control-padding_10 @error('degree_specialization.*') is-invalid @enderror"
                                        value="{{ old('degree_specialization.0') }}" required>
                                    @error('degree_specialization.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="institution" class="form-label">Institution</label>
                                    <input type="text" name="institution[]" class="form-control form-control-padding_10 @error('institution.*') is-invalid @enderror"
                                        value="{{ old('institution.0') }}" required>
                                    @error('institution.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="year_of_passing" class="form-label">Year of Passing</label>
                                            <input type="number" name="year_of_passing[]" class="form-control form-control-padding_10 @error('year_of_passing.*') is-invalid @enderror"
                                                value="{{ old('year_of_passing.0') }}" required>
                                            @error('year_of_passing.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="percentage" class="form-label">Percentage/CGPA</label>
                                            <input type="text" name="percentage[]" class="form-control form-control-padding_10 @error('percentage.*') is-invalid @enderror"
                                                value="{{ old('percentage.0') }}" required>
                                            @error('percentage.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" name="start_date[]" class="form-control form-control-padding_10 @error('start_date.*') is-invalid @enderror"
                                                value="{{ old('start_date.0') }}" required>
                                            @error('start_date.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" name="end_date[]" class="form-control form-control-padding_10 @error('end_date.*') is-invalid @enderror"
                                                value="{{ old('end_date.0') }}" required>
                                            @error('end_date.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="step-prev-btn btn btn-secondary">Back</button>
                            <button type="button" class="step-next-btn btn btn-primary">Next</button>
                        </div>
                    </div>


                    <!-- Step 3: Work Experience -->
                    <div class="form-step-container" id="step-3">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Step 3: Work Experience</h2>
                            <button type="button" id="add-work-experience" class="btn btn-primary"><i class="fa-solid fa-plus"></i> </button>
                        </div>

                        <div id="work-experience-container">
                            <!-- Work experience entries will be added here dynamically -->
                            <div class="work-experience-entry mb-4 p-3 border rounded">
                                <div class="form-group mb-3">
                                    <label for="job_title" class="form-label">Job Title</label>
                                    <input type="text" name="job_title[]" class="form-control form-control-padding_10 @error('job_title.*') is-invalid @enderror" value="{{ old('job_title.0') }}" required>
                                    @error('job_title.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" name="company_name[]" class="form-control form-control-padding_10 @error('company_name.*') is-invalid @enderror" value="{{ old('company_name.0') }}" required>
                                    @error('company_name.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="job_type" class="form-label">Job Type</label>
                                    <input type="text" name="job_type[]" class="form-control form-control-padding_10 @error('job_type.*') is-invalid @enderror" value="{{ old('job_type.0') }}" required>
                                    @error('job_type.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="addresses">
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="workcity[]" class="form-control city_id form-control-padding_10 @error('workcity.*') is-invalid @enderror" value="{{ old('workcity.0') }}" required>
                                        @error('workcity.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" name="workstate[]" class="form-control state form-control-padding_10 @error('workstate.*') is-invalid @enderror" value="{{ old('workstate.0') }}" readonly>
                                        @error('workstate.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" name="workcountry[]" class="form-control country form-control-padding_10 @error('workcountry.*') is-invalid @enderror" value="{{ old('workcountry.0') }}" readonly>
                                        @error('workcountry.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="enddate">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input m-3" type="checkbox" name="present[]" value="1" id="workingStatusYes" {{ old('present.0') ? 'checked' : '' }}>
                                            <label class="form-label" for="workingStatusYes">Currently working here?</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 enddatediv">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" name="workend_date[]" class="form-control form-control-padding_10 @error('workend_date.*') is-invalid @enderror" value="{{ old('workend_date.0') }}">
                                        @error('workend_date.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description[]" class="form-control form-control-padding_10 @error('description.*') is-invalid @enderror" cols="30" rows="10">{{ old('description.0') }}</textarea>
                                    @error('description.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="step-prev-btn btn btn-secondary">Back</button>
                            <button type="button" class="step-next-btn btn btn-primary">Next</button>
                        </div>
                    </div>


                    <!-- Step 4: Skills -->
                    <div class="form-step-container" id="step-4">
                        <h3>Step 4: Skills</h3>

                        <div class="form-group">
                            <label class="form-label" for="skill-search">Add Skills</label>
                            <input type="text" id="skill-search" placeholder="Type to filter skills..."
                                class="form-control form-control-padding_10">
                        </div>
                        <div id="skillform"></div>
                        <div class="dropdown-list" id="dropdownSkills"></div>
                        <div class="skill-list d-flex flex-wrap" id="selectedSkills"></div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="step-prev-btn btn btn-secondary">Back</button>
                            <button type="button" class="step-next-btn btn btn-primary">Next</button>
                        </div>
                    </div>

                    <!-- Step 5: Certification Or License -->
                    <div class="form-step-container" id="step-5">
                        <div class="d-flex justify-content-between mb-3">
                            <h3>Step 4: Certification or License</h3>
                            <button type="button" id="add-certificate" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i></button>
                        </div>

                        <div id="certificate-container">
                            <div class="form-group mb-3">
                                <label for="certificate" class="form-label">Certificate/License</label>
                                <input type="text" name="certificate[]" class="form-control form-control-padding_10"
                                    required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="step-prev-btn btn btn-secondary">Back</button>
                            <button type="submit" class="step-next-btn btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('jobportal/js/buildcv.js') }}"></script>
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
                console.log(stateInput, stateIdInput, countryInput, countryIdInput);

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
    <script>
        $(document).ready(function() {
            toggleEndWorking();
            // $('#workingStatusYes').on('change', toggleEndWorking);
            $(document).on('change', '#workingStatusYes',toggleEndWorking);
            function toggleEndWorking() {
                const endDate = $(this).closest('.enddate').find('.enddatediv');
                const isYesChecked = $('#workingStatusYes').is(':checked');
                if (isYesChecked) {
                    endDate.hide();
                } else {
                    endDate.show();
                }
            }
        });
    </script>
@endsection
