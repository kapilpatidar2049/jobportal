"use strict";

$(document).ready(function () {
    const $steps = $('.form-step-container');
    let currentStep = 0;

    function showStep(stepIndex) {
        $steps.removeClass('active').eq(stepIndex).addClass('active');
    }

    showStep(currentStep);

    // Step navigation
    $('.step-next-btn').on('click', function () {
        if (currentStep < $steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    $('.step-prev-btn').on('click', function () {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    const $educationContainer = $('#education-container');
    const $workContainer = $('#work-experience-container');
    const $certificateContainer = $('#certificate-container');

    function addCertificateEntry() {
        const $entry = $('<div class="certificate-entry">').html(`
            <button type="button" class="btn btn-danger btn-sm remove-btn text-white">Remove</button>
            <div class="form-group mb-3">
                <label for="certificate" class="form-label">Certificate/License</label>
                <input type="text" name="certificate[]" class="form-control form-control-padding_10" required>
            </div>
        `);
        $certificateContainer.append($entry);
    }

    function addEducationEntry() {
        const $entry = $('<div class="education-entry">').html(`
            <button type="button" class="btn btn-danger btn-sm remove-btn text-white ">Remove</button>
            <div class="form-group mb-3">
                <label for="degree" class="form-label">Degree</label>
                <input type="text" name="degree[]" class="form-control form-control-padding_10" required>
            </div>
            <div class="form-group mb-3">
                <label for="degree_specialization" class="form-label">Degree Specialization</label>
                <input type="text" name="degree_specialization[]" class="form-control form-control-padding_10" required>
            </div>
            <div class="form-group mb-3">
                <label for="institution" class="form-label">Institution</label>
                <input type="text" name="institution[]" class="form-control form-control-padding_10" required>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="year_of_passing" class="form-label">Year of Passing</label>
                        <input type="number" name="year_of_passing[]" class="form-control form-control-padding_10" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="percentage" class="form-label">Percentage/CGPA</label>
                        <input type="text" name="percentage[]" class="form-control form-control-padding_10" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date[]" class="form-control form-control-padding_10" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date[]" class="form-control form-control-padding_10" required>
                    </div>
                </div>
            </div>
        `);
        $educationContainer.append($entry);
    }

    function addWorkEntry() {
        const $entry = $('<div class="work-entry">').html(`
            <div class="form-group mb-3">
            <button type="button" class="btn btn-danger btn-sm remove-btn text-white">Remove</button>
                <label for="job_title" class="form-label">Job Title</label>
                <input type="text" name="job_title[]" class="form-control form-control-padding_10" required>
            </div>
            <div class="form-group mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name[]" class="form-control form-control-padding_10" required>
            </div>
            <div class="form-group mb-3">
                <label for="job_type" class="form-label">Job Type</label>
                <input type="text" name="job_type[]" class="form-control form-control-padding_10" required>
            </div>
                <div class="addresses">
                                    <!-- City -->
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input
                                            class="form-control form-control-padding_10 city_id
                                            type="text" name="workcity[]" placeholder="Please Enter Your City Name"
                                            aria-label="city" id="city" cv-form
                                            required>
                                        <input type="hidden" name="workcity[]" class="city_id">

                                    </div>

                                    <!-- State -->
                                    <div class="form-group mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input
                                            class="form-control form-control-padding_10 state_id
                                            type="text" name="workstate[]" placeholder="Please Enter Your State Name"
                                            aria-label="state" id="state" readonly>
                                        <input type="hidden" name="workstate[]" class="state_id">
                                    </div>

                                    <!-- Country -->
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input
                                            class="form-control form-control-padding_10 country_id
                                            type="text" name="workcountry[]" placeholder="Please Enter Your Country Name"
                                            aria-label="country" id="country" readonly>
                                        <input type="hidden" name="workcountry[]" class="country_id">
                                    </div>
                                </div>
            <div class="enddate">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input m-3" type="checkbox" name="present" value="1"
                                                id="workingStatusYes">
                                            <label class="form-label" for="workingStatusYes">
                                                Currently working here ?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 enddatediv">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" name="workend_date[]"
                                            class="form-control form-control-padding_10">
                                    </div>
                                </div>
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description[]" id="description" cols="30" rows="10" class="form-control form-control-padding_10"></textarea>
            </div>

        `);
        $workContainer.append($entry);
    }

    $('#add-education').on('click', addEducationEntry);
    $('#add-work-experience').on('click', addWorkEntry);
    $('#add-certificate').on('click', addCertificateEntry);

    // Remove entry functionality
    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.education-entry, .work-entry, .certificate-entry').remove();
    });

    $('#cv-form').on('submit', function (event) {
        let isValid = true;

        // Ensure at least one Education and one Work Experience entry
        const educationEntries = $('.education-entry');
        const workEntries = $('.work-entry');

        // Validate required fields
        $('#cv-form input[required]').each(function () {
            if ($(this).val().trim() === '') {
                toastr.error('Please fill out all required fields.');
                isValid = false;
                return false; // Exit loop
            }
        });

        // Prevent form submission if any validation failed
        if (!isValid) {
            event.preventDefault();
        } else {
            alert("Your CV has been submitted successfully!");
        }
    });
});
