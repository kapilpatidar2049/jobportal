<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('User Details') }}</title>
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <section>
        <div class="client_project_main_box">
            <div class="row">
                <div class="col-lg-5">
                    <div class="client_project_img">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12 project_name_main_box">
                            <div class="project_name_box">
                                <form action="{{ route('project.store') }}" method="POST">
                                    @csrf <!-- Laravel's CSRF protection -->
                                    <!-- Project Name Fields -->
                                    <div id="project_name_fields" style="display: block">
                                        <!-- Project Name -->
                                        <h1>
                                            Tell us what you need done.
                                        </h1>
                                        <div class="form-group my-4">
                                            <label for="name" class="form-group-lable mb-2">Project Name:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                required placeholder="Project Name" value="{{ old('name') }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group my-4">
                                            <label for="description" class="form-group-lable mb-2">Project
                                                Description:</label>
                                            <textarea name="description" id="description" class="form-control" rows="6" required
                                                placeholder="Take time to fill details and make it your own." ></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group my-4">
                                            <button type="button" class="btn btn-primary"
                                                id="next_to_skill">Next</button>
                                        </div>
                                    </div>

                                    <!-- Project Skill Fields -->
                                    <div id="project_skills_fields" style="display: none">
                                        <h1>
                                            Tell us your Project Industry.
                                        </h1>
                                        <div class="form-group my-4">
                                            <label for="industry" class="form-group-lable mb-2">
                                                {{ __('Industry') }}
                                            </label>
                                            <select name="industry" id="industry" class="form-select">
                                                <option value="" disabled selected>{{ __('Select Industry') }}
                                                </option>
                                                @php($industries = App\Models\marketplace\Marketplace_industries::all())
                                                @foreach ($industries as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label for="industry" class="form-group-lable mb-2">
                                            {{ __('Search Skills') }}
                                        </label>
                                        <div class="input-group rounded mb-3">
                                            <input type="search" class="form-control rounded" id="skillSearch"
                                                placeholder="Search for skills" aria-label="Search" disabled />
                                            <span class="input-group-text border-0" id="search-addon">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <div id="searchResults" class="search-results"></div>
                                        <div class="mb-3">
                                            <div id="selectedSkills" class="selected_skills_box"></div>
                                        </div>
                                        <input type="hidden" name="selected_skills" id="selectedSkillsInput">

                                        <!-- Submit Button -->
                                        <div class="form-group mb-4">
                                            <button type="button" class="btn btn-primary me-2"
                                                id="prev_to_name">Prev</button>
                                            <button type="button" class="btn btn-primary"
                                                id="next_to_rate">Next</button>
                                        </div>
                                    </div>

                                    <!-- Project Price Fields -->
                                    <div id="project_rate_fields" style="display: none">
                                        <!-- Project -->
                                        <h1>
                                            Tell us your budget.
                                        </h1>
                                        <div class="form-group my-4">
                                            <label for="project_rate"
                                                class="form-group-lable mb-2">{{ __('Project Rate') }}</label>
                                            <select name="project_rate" id="project_rate" class="form-select">
                                                <option value="" disabled>{{ __('Select Any One') }}
                                                </option>
                                                <option value="Hourly">{{ __('Hourly') }}</option>
                                                <option value="Fixed">{{ __('Fixed') }}</option>
                                                </option>
                                            </select>
                                        </div>
                                        <!-- Min Rate -->
                                        <div class="currency_min_max">
                                            <div class="me-3"><label for="Currency"
                                                    class="form-group-lable mb-2">{{ __('Currency') }}</label>
                                                <select name="currency" id="currency" class="form-select">
                                                    <option value="USD" selected>{{ __('USD') }}</option>
                                                    <option value="INR">{{ __('INR') }}</option>
                                                    <option value="EUR">{{ __('EUR') }}</option>
                                                    <option value="AUD">{{ __('AUD') }}</option>
                                                    <option value="AUD">{{ __('NZD') }}</option>
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group me-3">
                                                <label for="min_rate" class="form-group-lable mb-2">Min Rate</label>
                                                <input type="number" name="min_rate" id="min_rate"
                                                    class="form-control" step="0.01" required
                                                    placeholder="min rate">
                                            </div>
                                            <div class="form-group ">
                                                <label for="max_rate" class="form-group-lable mb-2">Max Rate</label>
                                                <input type="number" name="max_rate" id="max_rate"
                                                    class="form-control" step="0.01" required
                                                    placeholder="max rate">
                                            </div>
                                        </div>
                                        <!-- Submit Button -->
                                        <div class="form-group my-4">
                                            <button type="button" class="btn btn-primary me-2"
                                                id="prev_to_skills">Prev</button>
                                            <button type="button" class="btn btn-primary"
                                                id="next_to_remote">Next</button>
                                        </div>
                                    </div>

                                    <!-- Project Price Fields -->
                                    <div id="project_remote_fields" style="display: none">
                                        <h1>
                                            Tell us your Project Type.
                                        </h1>
                                        <div class="form-group my-4">
                                            <label for="project_type"
                                                class="form-group-lable mb-2">{{ __('Project Type') }}</label>
                                            <select name="project_type" id="project_type" class="form-select">
                                                <option value="" disabled>{{ __('Select Any One') }}</option>
                                                <option value="Project">{{ __('Project') }}</option>
                                                <option value="Remote Project">{{ __('Remote Project') }}</option>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="listing"
                                                class="form-group-lable mb-2">{{ __('Project Listing Type') }}</label>
                                            <select name="listing_type" id="listing" class="form-select">
                                                <option value="" disabled>{{ __('Select Any One') }}</option>
                                                <option value="Featured" selected>{{ __('Featured') }}</option>
                                                <option value="Sealed">{{ __('Sealed') }}</option>
                                                <option value="NDA">{{ __('NDA') }}</option>
                                                <option value="Urgent">{{ __('Urgent') }}</option>
                                                <option value="Recruiter">{{ __('Recruiter') }}</option>
                                                <option value="IP Agreementr">{{ __('IP Agreementr') }}</option>
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group my-4">
                                            <button type="button" class="btn btn-primary me-2"
                                                id="prev_to_rate">Prev</button>
                                            <button type="button" class="btn btn-primary"
                                                id="next_to_country">Next</button>
                                        </div>
                                    </div>

                                    <!-- Project Country Fields -->
                                    <div id="project_country_fields" style="display: none" class="pb-5">
                                        <h1 class="mb-3">
                                            Tell us about Project Location.
                                        </h1>
                                        <label for="country" class="form-group-lable mb-2">
                                            {{ __('Country') }}
                                        </label>
                                        <select name="country" id="country" class="form-select mb-4">
                                            <option value="" disabled selected>{{ __('Select Country') }}
                                            </option>
                                            @php($countries = App\Models\Allcountry::all())
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->nicename }}">
                                                    {{ $item->nicename }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="form-group my-4">
                                            <label for="city" class="form-group-lable mb-2">City:</label>
                                            <input type="text" name="city" id="city" class="form-control"
                                                required placeholder="Enter city name" value="{{ old('city') }}">
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group my-4">
                                            <button type="button" class="btn btn-primary me-2"
                                                id="prev_to_remote">Prev</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="next_to_all">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#next_to_skill').click(function() {
                $('#project_name_fields').hide();
                $('#project_skills_fields').show();
            });
        });
        $(document).ready(function() {
            $('#prev_to_name').click(function() {
                $('#project_name_fields').show();
                $('#project_skills_fields').hide();
            });
        });

        $(document).ready(function() {
            $('#next_to_rate').click(function() {
                $('#project_skills_fields').hide();
                $('#project_rate_fields').show();
            });
        });
        $(document).ready(function() {
            $('#prev_to_skills').click(function() {
                $('#project_skills_fields').show();
                $('#project_rate_fields').hide();
            });
        });

        $(document).ready(function() {
            $('#next_to_remote').click(function() {
                $('#project_rate_fields').hide();
                $('#project_remote_fields').show();
            });
        });
        $(document).ready(function() {
            $('#prev_to_rate').click(function() {
                $('#project_rate_fields').show();
                $('#project_remote_fields').hide();
            });
        });

        $(document).ready(function() {
            $('#next_to_country').click(function() {
                $('#project_remote_fields').hide();
                $('#project_country_fields').show();
            });
        });
        $(document).ready(function() {
            $('#prev_to_remote').click(function() {
                $('#project_remote_fields').show();
                $('#project_country_fields').hide();
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            const selectedSkillsMap = new Map(); // Initialize selected skills map

            // Enable skill search input only if industry is selected
            $('#industry').on('change', function() {
                $('#skillSearch').prop('disabled', false);
            });

            $('#skillSearch').on('keyup', function() {
                const query = $(this).val();
                const industryId = $('#industry').val();

                // Check if industry is selected
                if (!industryId) {
                    $('#searchResults').html('<p>Please select an industry first.</p>');
                    return;
                }

                // If search query is empty, clear the search results
                if (query.length === 0) {
                    $('#searchResults').empty();
                    return;
                }

                $.ajax({
                    url: '/search-project-skills',
                    type: 'GET',
                    data: {
                        query: query,
                        industry_id: industryId
                    }, // Send industry ID with query
                    success: function(data) {
                        $('#searchResults').empty(); // Clear previous results

                        if (data.length > 0) {
                            data.forEach(skill => {
                                $('#searchResults').append(`
                            <div class="search-result-item" data-value="${skill.id}" data-text="${skill.name}">
                                <span>${skill.name}</span>
                            </div>
                        `);
                            });

                            // Add click event to the search result items
                            $('.search-result-item').on('click', function() {
                                const skillValue = $(this).data('value');
                                const skillText = $(this).data('text');

                                if (!selectedSkillsMap.has(skillValue)) {
                                    selectedSkillsMap.set(skillValue, skillText);
                                    addSkillToList({
                                        value: skillValue,
                                        text: skillText
                                    });
                                }

                                $('#searchResults')
                                    .empty(); // Clear search results after selection
                                $('#skillSearch').val(''); // Clear the search input
                            });
                        } else {
                            $('#searchResults').append('<p>No skills found.</p>');
                        }
                    },
                    error: function() {
                        $('#searchResults').append('<p>Error fetching skills.</p>');
                    }
                });
            });

            function addSkillToList(skill) {
                $('#selectedSkills').append(`
            <div class="selected-project-skill" data-id="${skill.value}">
                ${skill.text} <button class="remove-skill" data-id="${skill.value}">X</button>
            </div>
        `);

                updateSelectedSkillsInput(); // Update hidden input with selected skills

                // Add click event for removing the skill
                $('.remove-skill').on('click', function() {
                    const skillId = $(this).data('id');
                    selectedSkillsMap.delete(skillId); // Remove from the selected skills map
                    $(this).parent().remove(); // Remove from the DOM

                    updateSelectedSkillsInput(); // Update hidden input after removing skill
                });
            }

            function updateSelectedSkillsInput() {
                const selectedSkillsArray = Array.from(selectedSkillsMap.keys());
                $('#selectedSkillsInput').val(selectedSkillsArray.join(',')); // Store comma-separated skill IDs
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            const selectedSkillsMap = new Map(); // Initialize selected skills map

            // Enable skill search input only if industry is selected
            $('#industry').on('change', function() {
                $('#skillSearch').prop('disabled', false);
            });

            $('#skillSearch').on('keyup', function() {
                const query = $(this).val();
                const industryId = $('#industry').val();

                // Check if industry is selected
                if (!industryId) {
                    $('#searchResults').html('<p>Please select an industry first.</p>');
                    return;
                }

                // If search query is empty, clear the search results
                if (query.length === 0) {
                    $('#searchResults').empty();
                    return;
                }

                $.ajax({
                    url: '/search-project-skills',
                    type: 'GET',
                    data: {
                        query: query,
                        industry_id: industryId
                    }, // Send industry ID with query
                    success: function(data) {
                        $('#searchResults').empty(); // Clear previous results

                        if (data.length > 0) {
                            data.forEach(skill => {
                                $('#searchResults').append(`
                            <div class="search-result-item" data-value="${skill.id}" data-text="${skill.name}">
                                <span>${skill.name}</span>
                            </div>
                        `);
                            });

                            // Add click event to the search result items
                            $('.search-result-item').on('click', function() {
                                const skillValue = $(this).data('value');
                                const skillText = $(this).data('text');

                                if (!selectedSkillsMap.has(skillValue)) {
                                    selectedSkillsMap.set(skillValue, skillText);
                                    addSkillToList({
                                        value: skillValue,
                                        text: skillText
                                    });
                                }

                                $('#searchResults')
                                    .empty(); // Clear search results after selection
                                $('#skillSearch').val(''); // Clear the search input
                            });
                        } else {
                            $('#searchResults').append('<p>No skills found.</p>');
                        }
                    },
                    error: function() {
                        $('#searchResults').append('<p>Error fetching skills.</p>');
                    }
                });
            });

            function addSkillToList(skill) {
                $('#selectedSkills').append(`
            <div class="selected-project-skill" data-id="${skill.value}">
                ${skill.text} <button class="remove-skill" data-id="${skill.value}">X</button>
            </div>
        `);

                updateSelectedSkillsInput(); // Update hidden input with selected skill names

                // Add click event for removing the skill
                $('.remove-skill').on('click', function() {
                    const skillId = $(this).data('id');
                    selectedSkillsMap.delete(skillId); // Remove from the selected skills map
                    $(this).parent().remove(); // Remove from the DOM

                    updateSelectedSkillsInput(); // Update hidden input after removing skill
                });
            }

            function updateSelectedSkillsInput() {
                const selectedSkillsArray = Array.from(selectedSkillsMap.values()); // Get skill names
                $('#selectedSkillsInput').val(selectedSkillsArray.join(',')); // Store comma-separated skill names
            }
        });
    </script>
</body>

</html>
