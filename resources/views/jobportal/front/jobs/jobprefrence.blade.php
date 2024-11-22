@extends('jobportal.front.layouts.master')
@section('title', 'Job Prefrecense')
@section('main-container')
    <div class="container">
        <div class="client-area">
            <div class="heading">Job Preferences</div>
            <p>Tell us the job details you're interested in to get better recommendations.</p>

            <div class="section">
                <h3>Job Titles <i class="fas fa-pen edit-icon" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#editTitleModal"></i></h3>
                @php($titles = explode(',', $preferance->title))
                @foreach ($titles as $title)
                    <p>{{ $title }}</p>
                @endforeach
            </div>
            <hr>

            <div class="section">
                <h3>Job Types <i class="fas fa-pen edit-icon" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#edittypesModal"></i></h3>
                @php($types = explode(',', $preferance->job_type))
                @foreach ($types as $type)
                    <p>{{ ucfirst($type) }}</p>
                @endforeach
            </div>
            <hr>

            <div class="section">
                <h3>Work Schedule <i class="fas fa-pen edit-icon" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#schedualModal"></i></h3>
                <strong class="text-dark">Days</strong>
                @php($days = explode(',', $preferance->days))
                @foreach ($days as $day)
                    <p>{{ ucfirst($day) }}</p>
                @endforeach
                <strong class="text-dark">Shifts</strong>
                @php($shifts = explode(',', $preferance->shifts))
                @foreach ($shifts as $shift)
                    <p>{{ ucfirst($shift) }}</p>
                @endforeach

            </div>
            <hr>

            <div class="section">
                <h3>Minimum Base Pay <i class="fas fa-pen edit-icon" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#payBaseModal"></i></h3>
                <p>{{ $preferance->minimum_pay }} {{ $preferance->pay_periods }}</p>
            </div>
            <hr>

            <div class="section">
                <h3>Relocation <i class="fas fa-pen edit-icon" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#relocateModal"></i></h3>
                @php($locations = explode(',', $preferance->locations))
                @foreach ($locations as $loaction)
                    <p>{{ ucfirst($loaction) }}</p>
                @endforeach
            </div>
            <hr>

            <div class="section">
                <h3>Remote <i class="fas fa-pen edit-icon" title="{{ __('Edit') }}" data-bs-toggle="modal"
                        data-bs-target="#remoteModal"></i></h3>
                @php($remotes = explode(',', $preferance->remote))
                @foreach ($remotes as $remote)
                    <p>{{ ucfirst($remote) }}</p>
                @endforeach
            </div>
            <div class="row d-flex">
                <div class="col-lg-3 col-md-3">
                    <button class="btn btn-primary">continue to Profile</button>
                </div>
                <div class="col-lg-3 col-md-3">
                    <button class="btn btn-primary">Find Jobs</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Titles Model -->
    <div class="modal fade" id="editTitleModal" tabindex="-1" role="dialog" aria-labelledby="editTitleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTitleModalLabel">Job Titles</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jobpreferences.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>What are your desired job titles?</p>
                        <p>Add up to ten job titles</p>
                        @if (isset($titles))
                            @php($i = 1)
                            @foreach ($titles as $title)
                                <div class="email-input-group mb-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Laravel Developer" name="title[]"
                                            value="{{ $title }}"
                                            class="form-control form-control-padding_10 job-title-input">
                                        @if ($i > 1)
                                            <button type="button" class="btn btn-danger remove-title-input"><i
                                                    class="fa-solid fa-minus"></i></button>
                                        @endif
                                    </div>
                                </div>
                                @php($i++)
                            @endforeach
                        @else
                            <input type="text" placeholder="Laravel Developer" name="title[]">
                        @endif
                        <div class="add-another-title" onclick="addJobTitleInput('editTitleModal')">
                            <i class="fas fa-plus"></i> Add another
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

    <!-- Edit Types Model -->
    <div class="modal fade" id="edittypesModal" tabindex="-1" role="dialog" aria-labelledby="edittypesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edittypesModalLabel">Job Types</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jobpreferences.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>What are your desired job titles?</p>
                        <label class="form-checkbox-label" for="fulltime" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="fulltime" class="form-checkbox"
                                value="fulltime" @if (in_array('fulltime', $types)) checked @endif>
                            Full-time
                        </label>
                        <label class="form-checkbox-label" for="permanent" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="permanent" class="form-checkbox"
                                value="permanent" @if (in_array('permanent', $types)) checked @endif>
                            Permanent
                        </label>
                        <label class="form-checkbox-label" for="fresher" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="fresher" class="form-checkbox"
                                value="fresher" @if (in_array('fresher', $types)) checked @endif>
                            Fresher
                        </label>
                        <label class="form-checkbox-label" for="parttime" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="parttime" class="form-checkbox"
                                value="parttime" @if (in_array('parttime', $types)) checked @endif> Part-time
                        </label>
                        <label class="form-checkbox-label" for="internship" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="internship" class="form-checkbox"
                                value="internship" @if (in_array('internship', $types)) checked @endif> Internship
                        </label>
                        <label class="form-checkbox-label" for="temporary" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="temporary" class="form-checkbox"
                                value="temporary" @if (in_array('temporary', $types)) checked @endif> Contractual / Temporary
                        </label>
                        <label class="form-checkbox-label" for="freelance" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="freelance" class="form-checkbox"
                                value="freelance" @if (in_array('freelance', $types)) checked @endif> Freelance
                        </label>
                        <label class="form-checkbox-label" for="volunteer" class="form-checkbox-label">
                            <input type="checkbox" name="job_types[]" id="volunteer" class="form-checkbox"
                                value="volunteer" @if (in_array('volunteer', $types)) checked @endif> Volunteer
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Work Schedual Model -->
    <div class="modal fade" id="schedualModal" tabindex="-1" role="dialog" aria-labelledby="schedualModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="schedualModalLabel">Work Schedule</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jobpreferences.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>What are your desired schedules?</p>

                        <div class="section-title mb-1">Days</div>
                        <div class="checkbox-group">
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="days[]" value="monday to friday"
                                    @if (in_array('monday to friday', $days)) checked @endif> Monday to Friday
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="days[]" value="weekend availability"
                                    @if (in_array('weekend availability', $days)) checked @endif>
                                Weekend availability
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="days[]" value="weekend only"
                                    @if (in_array('weekend only', $days)) checked @endif>
                                Weekend
                                only
                            </label>
                        </div>

                        <div class="section-title mb-1">Shifts</div>
                        <div class="checkbox-group">
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="day shift"
                                    @if (in_array('day shift', $shifts)) checked @endif>
                                Day
                                shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="morning shift"
                                    @if (in_array('morning shift', $shifts)) checked @endif>
                                Morning
                                shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="rotational shift"
                                    @if (in_array('rotational shift', $shifts)) checked @endif>
                                Rotational shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="night shift"
                                    @if (in_array('night shift', $shifts)) checked @endif>
                                Night shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="evening shift"
                                    @if (in_array('evening shift', $shifts)) checked @endif>
                                Evening
                                shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="fixed shift"
                                    @if (in_array('fixed shift', $shifts)) checked @endif>
                                Fixed shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="us shift"
                                    @if (in_array('us shift', $shifts)) checked @endif>
                                US
                                shift
                            </label>
                            <label class="form-checkbox-label">
                                <input type="checkbox" class="form-checkbox" name="shifts[]" value="uk shift"
                                    @if (in_array('uk shift', $shifts)) checked @endif>
                                UK
                                shift
                            </label>
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

    <!-- Edit Pay Base Model -->
    <div class="modal fade" id="payBaseModal" tabindex="-1" role="dialog" aria-labelledby="payBaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payBaseModalLabel">Minimum Base Pay</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jobpreferences.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h6>What is the minimum pay you'll consider in your search?</h6>
                        <p class="text-muted">Employers can't see this.</p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="minimum_pay" class="form-label">Minimum Base Payment</label>
                                    <input type="number" class="form-control form-control-padding_10" id="minimum_pay"
                                        value="{{ $preferance->minimum_pay }}" name="minimum_pay">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="pay_periods" class="form-label">Minimum Base Payment</label>
                                    <select name="pay_periods" id="pay_periods"
                                        class="form-control form-control-padding_10 form-select">
                                        <option value="per hour" @if ($preferance->pay_periods == 'per hour') selected @endif>Per
                                            Hour</option>
                                        <option value="per week"@if ($preferance->pay_periods == 'per week') selected @endif>Per
                                            Week</option>
                                        <option value="per day"@if ($preferance->pay_periods == 'per day') selected @endif>Per Day
                                        </option>
                                        <option value="per month"@if ($preferance->pay_periods == 'per month') selected @endif>Per
                                            Month</option>
                                        <option value="per year"@if ($preferance->pay_periods == 'per year') selected @endif>Per
                                            Year</option>
                                    </select>
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

    <!-- Edit relocate Model -->
    <div class="modal fade" id="relocateModal" tabindex="-1" role="dialog" aria-labelledby="relocateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relocateModalLabel">Relocation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jobpreferences.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h6>Are you willing to relocate?</h6>
                        <label class="form-checkbox-label"><input type="checkbox" id="willing_to_relocate"
                                class="form-checkbox" name="willing_to_relocate" value="1"
                                @if ($preferance->willing_to_relocate == 1) checked @endif> Yes, I'm willing to
                            relocate</label>
                        <div class="@if ($preferance->willing_to_relocate == 0) d-none @endif " id="willing">
                            <label>
                                <input type="radio" name="relocate" id="anywhere" class="form-checkbox me-1 relocate"
                                    value="Anywhere">Anywhere in {{ Auth::guard('jobportal')->user()->country }}
                            </label>
                            <label>
                                <input type="radio" name="relocate" id="near" class="form-checkbox me-1 relocate"
                                    value="near">Only Near...
                            </label>
                            <div class="@if ($preferance->relocate == 'anywhere') d-none @endif" id="locations">
                                @if (isset($locations))
                                @php($j=1)
                                    @foreach ($locations as $loaction)
                                    <div class="email-input-group mb-2">
                                        <div class="input-group">
                                            <input type="text" name="locations[]" placeholder="Enter Location" value="{{ $loaction }}"
                                                class="form-control form-control-padding_10 job-title-input">
                                            @if ($j > 1)
                                                <button type="button" class="btn btn-danger remove-location-input"><i
                                                        class="fa-solid fa-minus"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                    @php($j++)
                                    @endforeach
                                @else
                                    <input type="text" class="cities" name="locations[]"
                                        placeholder="Enter Location">
                                @endif
                                <ul id="cityList">
                                </ul>
                                <div class="add-another" onclick="addLocation()">
                                    <i class="fas fa-plus"></i> Add another
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

    <!-- Edit remote Model -->
    <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog"
        aria-labelledby="remoteModalLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remoteModalLabel">Remote</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jobpreferences.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h6>Desired work setting</h6>
                        <label class="form-checkbox-label" for="remote" class="form-checkbox-label">
                            <input type="checkbox" name="remote[]" id="remote" class="form-checkbox" value="remote"
                                @if (in_array('remote', $remotes)) checked @endif>
                            Remote
                        </label>
                        <label class="form-checkbox-label" for="hybrid_work" class="form-checkbox-label">
                            <input type="checkbox" name="remote[]" id="hybrid_work" class="form-checkbox"
                                value="hybrid work" @if (in_array('hybrid work', $remotes)) checked @endif>
                            Hybrid work
                        </label>
                        <label class="form-checkbox-label" for="in-person" class="form-checkbox-label">
                            <input type="checkbox" name="remote[]" id="in-person" class="form-checkbox"
                                value="in person" @if (in_array('in person', $remotes)) checked @endif>
                            In-person
                        </label>
                        <label class="form-checkbox-label" for="temporary_remote" class="form-checkbox-label">
                            <input type="checkbox" name="remote[]" id="temporary_remote" class="form-checkbox"
                                value="temporary remote" @if (in_array('temporary remote', $remotes)) checked @endif>
                            Temporarily remote
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function addJobTitleInput(modalId) {
            const modalBody = document.querySelector(`#${modalId} .modal-body`);
            const existingInputs = modalBody.querySelectorAll('input[type="text"]');

            // Check if the number of inputs is less than the maximum allowed
            if (existingInputs.length < 10) {
                // Create the new input field wrapper (input-group)
                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group');
                newInputGroup.style.marginTop = '10px'; // Add spacing between inputs

                // Create the input element
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.placeholder = 'Laravel Developer';
                newInput.classList.add('form-control', 'form-control-padding_10', 'job-title-input');
                newInput.name = 'title[]';

                // Create the remove button
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('btn', 'btn-danger', 'remove-title-input');
                removeButton.innerHTML = '<i class="fa-solid fa-minus"></i>';

                // Append the input and the remove button to the input group
                newInputGroup.appendChild(newInput);
                newInputGroup.appendChild(removeButton);

                // Insert the new input group before the "Add Another" button
                const addAnotherButton = modalBody.querySelector('.add-another-title');
                modalBody.insertBefore(newInputGroup, addAnotherButton);

                // Add event listener for the remove button
                removeButton.addEventListener('click', function() {
                    // modalBody.removeChild(newInputGroup);
                });
            } else {
                toastr.error('You can only add up to 10 job titles in this modal.');
            }
        }
        $('#editTitleModal .modal-body').on('click', '.remove-title-input', function() {
            // Remove the parent input group (the div that contains the input and the remove button)
            $(this).closest('.input-group').remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#willing_to_relocate').on('change', function() {
                var checked = $(this).is(':checked');
                if (checked) {
                    $('#willing').removeClass('d-none');
                } else {
                    $('#willing').addClass('d-none');
                }
            });
            $('.relocate').on('change', function() {
                var checked = $(this).is(':checked');
                var value = $(this).val();
                if (checked && value == 'near') {
                    $('#locations').removeClass('d-none');
                } else {
                    $('#locations').addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to add a new job title input field
            function addLocation() {
                const modalBody = $('#relocateModal .modal-body #locations');
                const existingInputs = modalBody.find('input[type="text"]');

                // Limit the number of inputs to 3
                if (existingInputs.length < 3) {
                    // Create the new input field wrapper (input-group)
                    const newInputGroup = $('<div>', {
                        class: 'input-group',
                        style: 'margin-top: 10px;'
                    });

                    // Create the input element for location
                    const newInput = $('<input>', {
                        type: 'text',
                        placeholder: 'Enter Location',
                        class: 'form-control form-control-padding_10 job-title-input cities',
                        name: 'locations[]'
                    });

                    // Create the remove button
                    const removeButton = $('<button>', {
                        type: 'button',
                        class: 'btn btn-danger remove-location-input',
                        html: '<i class="fa-solid fa-minus"></i>'
                    });

                    // Append the input and the remove button to the input group
                    newInputGroup.append(newInput).append(removeButton);

                    // Insert the new input group before the "Add Another" button
                    modalBody.find('.add-another').before(newInputGroup);
                } else {
                    toastr.error('You can only add up to 3 locations in this modal.');
                }
            }

            // Attach the event handler for adding a new location input field
            $('.add-another').on('click', function() {
                addLocation(); // Add location input
            });

            // Event delegation for remove button (works for both dynamically added and existing inputs)
            $('#relocateModal .modal-body').on('click', '.remove-location-input', function() {
                // Remove the parent input group (the div that contains the input and the remove button)
                $(this).closest('.input-group').remove();
            });

            // Attach the event handler for the "Add another" button
            $('.add-another').on('click', function() {
                addLocation();
            });
            $('.cities').on('keyup', function() {
                var val = $(this).val();
                $.ajax({
                    url: '/jobportal/getcities',
                    type: 'POST',
                    data: {
                        text: val
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        let cityListHtml = '';
                        $.each(response.data, function(index, value) {
                            cityListHtml +=
                                `<li class = "city-item" data-value = "${value.name}" > ${value.name} < /li>`;
                        });
                        // $('#cityList').html(cityListHtml);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);

                    }
                });
            })
            $('.cities').on('blur', function() {
                // $('#cityList').html('');
            })
        });
        $(document).ready(function() {
            $('#cityList').on('click', '.city-item', function() {
                // Get the value of the clicked city from data attribute
                const cityValue = $(this).data('value');
                $('.cities').each(function() {
                    if ($(this).val() === '') {
                        $(this).val(cityValue);
                        return false;
                    }
                });
            });
        });
    </script>
@endsection
