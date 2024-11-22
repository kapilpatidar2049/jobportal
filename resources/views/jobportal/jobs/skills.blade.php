@extends('jobportal.layouts.master')
@section('title', 'Add Skills For Job')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Add Skills') }}
            @endslot
            @slot('menu2')
                {{ __('Add Skills') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <div class="skill-list" id="selectedSkills"></div>
                    <div class="form-group">
                        <label class="form-label" for="skill-search">Add Skills</label>
                        <input type="text" id="skill-search" placeholder="Type to filter skills..."
                            class="form-control form-control-padding_10">
                    </div>

                    <div class="dropdown-list" id="dropdownSkills"></div>
                    <form action="{{ route('jobportal.job_skill_store') }}" id="skillform" method="POST">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-primary">{{ __('Next') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let skills = []; // Initialize skills as an empty array

            // Fetch skills from the database
            $.ajax({
                url: '/api/skills', // The endpoint you defined
                method: 'GET',
                success: function(data) {
                    skills = data;
                    console.log(skills);
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

                // Add filtered skills to dropdown
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
@endsection
