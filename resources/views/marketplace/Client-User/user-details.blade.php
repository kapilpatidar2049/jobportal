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
    <div class="login-page">
        <div class="row w-100">
            <div class="col-md-6 col-12 bg-white login_form_box client_user_details">
                <div class="row">
                    <div class="col-12">
                        <div class="client-box">
                            <div class="bloomlogo"><img src="{{ url('/admin_theme/marketplace/images/bloomlogo.png') }}"
                                    alt="{{ __('logo') }}"></div>
                            <h3 class="text-center mb-4">{{ __('User Login') }}</h3>
                            <form action="{{ route('user_details-store') }}" method="POST" class="mt-5 mx-3"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <input type="hidden" value="user" name="role">
                                <input type="hidden" value="MarketPlace" name="platform">
                                <input type="hidden" name="userSkills" id="userSkills" value="">
                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-group-lable">{{ __('Name') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $user->name }}" readonly>
                                        </div>
                                    </div>
                                    <!-- Profile Photo -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <div class="photo">
                                                <label for="image"
                                                    class="form-group-lable">{{ __('Photo') }}</label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                    accept="image/*">
                                            </div>
                                            <img id="preview-image3" src="#" alt="Image Preview">
                                        </div>
                                    </div>
                                    <!-- Skill -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="industry" class="form-group-lable">{{ __('Industry') }}</label>
                                            <select name="industry" id="industry" class="form-control">
                                                <option value="">{{ __('Select Industry') }}</option>
                                                @php($industries = App\Models\marketplace\Marketplace_industries::all())
                                                @foreach ($industries as $item)
                                                    <option value="{{ $item->name }}" data-id="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Project -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-group-lable">{{ __('Skills') }}</label>
                                            <div class="add_skill_button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">{{ __('Add Skills') }}</div>
                                            <input type="hidden" name="skills" id="skills" value="">
                                        </div>
                                    </div>
                                    <!-- Project -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="Project"
                                                class="form-group-lable">{{ __('Project Type') }}</label>
                                            <select name="project" id="project" class="form-control">
                                                <option value="" disabled selected>{{ __('Select Any One') }}
                                                </option>
                                                <option value="project">{{ __('Project') }}</option>
                                                <option value="remote-project">{{ __('Remote Project') }}</option>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Experience -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="experience"
                                                class="form-group-lable">{{ __('Experience') }}</label>
                                            <input type="text" class="form-control" id="experience"
                                                name="experience" required>
                                        </div>
                                    </div>
                                    <!-- Create User name-->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="create_user_name"
                                                class="form-group-lable">{{ __('Create User name') }}</label>
                                            <input type="text" class="form-control create_user_name"
                                                id="create_user_name" name="user_name" required>
                                        </div>
                                    </div>
                                    <!-- Country -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="country"
                                                class="form-group-lable">{{ __('Country') }}</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                required>
                                        </div>
                                    </div>
                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="city"
                                                class="form-group-lable">{{ __('City') }}</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                required>
                                        </div>
                                    </div>
                                    <!-- Area -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="area"
                                                class="form-group-lable">{{ __('Area') }}</label>
                                            <input type="text" class="form-control" id="area" name="area"
                                                required>
                                        </div>
                                    </div>
                                    <!-- Pin code -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pincode"
                                                class="form-group-lable">{{ __('Pin Code') }}</label>
                                            <input type="text" class="form-control" id="pincode"
                                                name="pin_code" required>
                                        </div>
                                    </div>
                                    <!-- Street Address -->
                                    <div class="col-md-6">
                                        <div class="form-groupv mb-3">
                                            <label for="street"
                                                class="form-group-lable">{{ __('Street Address') }}</label>
                                            <input type="text" class="form-control" id="street"
                                                name="street_address" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary mt-3"><b>{{ __('Submit') }}</b></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- resources/views/swiper.blade.php -->
            <div class="col-md-6 col-6 p-0 client_slider_box">
                <div class="swiper-container client_slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ url('/admin_theme/marketplace/images/login4.jpg') }}" alt="Image">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ url('/admin_theme/marketplace/images/register2.jpg') }}" alt="Image">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ url('/admin_theme/marketplace/images/register5.jpg') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row my-4">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            <h4>Skills</h4>
                            <div class="form-group">
                                <select name="sub_industry[]" id="sub_industry" class="form-control sub_industry_box"
                                    multiple>
                                    <option value="" disabled class="fs-3">Select Industry First</option>
                                    <!-- Sub-industries will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" id="skillSearch"
                                    placeholder="Search for skills" aria-label="Search" />
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <div id="searchUserSkillResults" class="mt-2 searchResultsBox"></div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Selected Skills</h4>
                            <div id="selectedUserSkills" class="selected-skills"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        data-bs-dismiss="modal">{{ __('Save') }}</button>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>


    <script src="{{ url('admin_theme/marketplace/js/login.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('admin_theme/marketplace/js/profile.js') }}"></script>



    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('sub_industry');
            const selectedSkillsContainer = document.getElementById('selectedSkills');
            const selectedSkillsMap = new Map(); // To keep track of selected skills
            const skillsInput = document.getElementById('skills'); // Hidden input for skills
            const skillSearch = document.getElementById('skillSearch');

            selectElement.addEventListener('change', function() {
                updateSelectedSkills();
            });

            function updateSelectedSkills() {
                const selectedOptions = Array.from(selectElement.selectedOptions);
                selectedOptions.forEach(option => {
                    if (!selectedSkillsMap.has(option.value)) {
                        addSkillToList(option);
                        selectedSkillsMap.set(option.value, option.text);
                    }
                });
                updateSkillsInput();
            }

            function addSkillToList(option) {
                const skillItem = document.createElement('span');
                skillItem.textContent = option.text;

                const removeBtn = document.createElement('button');
                removeBtn.classList.add('cross_button');
                removeBtn.innerHTML = '&times;';
                removeBtn.addEventListener('click', function() {
                    removeSkill(option.value);
                });

                skillItem.appendChild(removeBtn);
                selectedSkillsContainer.appendChild(skillItem);
                updateSkillsInput();
            }

            function removeSkill(value) {
                selectedSkillsMap.delete(value);
                refreshSelectedSkillsDisplay();
                updateSkillsInput();

                const options = Array.from(selectElement.options);
                options.forEach(option => {
                    if (option.value === value) {
                        option.selected = false;
                    }
                });
            }

            function refreshSelectedSkillsDisplay() {
                selectedSkillsContainer.innerHTML = '';
                selectedSkillsMap.forEach((text, value) => {
                    const skillItem = document.createElement('span');
                    skillItem.textContent = text;

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('cross_button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.addEventListener('click', function() {
                        removeSkill(value);
                    });

                    skillItem.appendChild(removeBtn);
                    selectedSkillsContainer.appendChild(skillItem);
                });
            }

            function updateSkillsInput() {
                // Join the selected skills into a comma-separated string and set it to the hidden input
                skillsInput.value = Array.from(selectedSkillsMap.keys()).join(',');
            }

            // Search and add skills from the search results
            $(document).ready(function() {
                $(skillSearch).on('keyup', function() {
                    const query = $(this).val();

                    // If the search input is empty, clear the results
                    if (query.length === 0) {
                        $('#searchResults').empty();
                        return;
                    }

                    $.ajax({
                        url: '/search-skills', // Your endpoint to fetch skills
                        type: 'GET',
                        data: {
                            query: query
                        },
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
                                $('.search-result-item').off('click').on('click',
                                    function() {
                                        const skillValue = $(this).data('value');
                                        const skillText = $(this).data('text');

                                        if (!selectedSkillsMap.has(skillValue)) {
                                            selectedSkillsMap.set(skillValue,
                                                skillText);
                                            addSkillToList({
                                                value: skillValue,
                                                text: skillText
                                            });
                                        }

                                        $('#searchResults')
                                    .empty(); // Clear search results after selection
                                        $(skillSearch).val(
                                        ''); // Clear the search input
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
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('sub_industry');
            const selectedSkillsContainer = document.getElementById('selectedUserSkills'); // Updated ID
            const selectedSkillsMap = new Map(); // To keep track of selected skills
            const skillsInput = document.getElementById('userSkills'); // Updated ID
            const skillSearch = document.getElementById('skillSearch');
    
            selectElement.addEventListener('change', function() {
                updateSelectedSkills();
            });
    
            function updateSelectedSkills() {
                const selectedOptions = Array.from(selectElement.selectedOptions);
                selectedOptions.forEach(option => {
                    if (!selectedSkillsMap.has(option.value)) {
                        addSkillToList(option);
                        selectedSkillsMap.set(option.value, option.text);
                    }
                });
                updateSkillsInput();
            }
    
            function addSkillToList(option) {
                const skillItem = document.createElement('span');
                skillItem.textContent = option.text;
    
                const removeBtn = document.createElement('button');
                removeBtn.classList.add('cross_button');
                removeBtn.innerHTML = '&times;';
                removeBtn.addEventListener('click', function() {
                    removeSkill(option.value);
                });
    
                skillItem.appendChild(removeBtn);
                selectedSkillsContainer.appendChild(skillItem);
                updateSkillsInput();
            }
    
            function removeSkill(value) {
                selectedSkillsMap.delete(value);
                refreshSelectedSkillsDisplay();
                updateSkillsInput();
    
                const options = Array.from(selectElement.options);
                options.forEach(option => {
                    if (option.value === value) {
                        option.selected = false;
                    }
                });
            }
    
            function refreshSelectedSkillsDisplay() {
                selectedSkillsContainer.innerHTML = '';
                selectedSkillsMap.forEach((text, value) => {
                    const skillItem = document.createElement('span');
                    skillItem.textContent = text;
    
                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('cross_button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.addEventListener('click', function() {
                        removeSkill(value);
                    });
    
                    skillItem.appendChild(removeBtn);
                    selectedSkillsContainer.appendChild(skillItem);
                });
            }
    
            function updateSkillsInput() {
                skillsInput.value = Array.from(selectedSkillsMap.values()).join(',');
            }
    
            // Search and add skills from the search results
            $(document).ready(function() {
                $(skillSearch).on('keyup', function() {
                    const query = $(this).val();
    
                    // If the search input is empty, clear the results
                    if (query.length === 0) {
                        $('#searchUserSkillResults').empty(); // Updated ID
                        return;
                    }
    
                    $.ajax({
                        url: '/search-skills', // Your endpoint to fetch skills
                        type: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#searchUserSkillResults').empty(); // Clear previous results
    
                            if (data.length > 0) {
                                data.forEach(skill => {
                                    $('#searchUserSkillResults').append(` // Updated ID
                                        <div class="search-result-item" data-value="${skill.id}" data-text="${skill.name}">
                                            <span>${skill.name}</span>
                                        </div>
                                    `);
                                });
    
                                // Add click event to the search result items
                                $('.search-result-item').off('click').on('click', function() {
                                    const skillValue = $(this).data('value');
                                    const skillText = $(this).data('text');
    
                                    if (!selectedSkillsMap.has(skillValue)) {
                                        selectedSkillsMap.set(skillValue, skillText);
                                        addSkillToList({
                                            value: skillValue,
                                            text: skillText
                                        });
                                    }
    
                                    $('#searchUserSkillResults').empty(); // Clear search results after selection
                                    $(skillSearch).val(''); // Clear the search input
                                });
                            } else {
                                $('#searchUserSkillResults').append('<p>No skills found.</p>');
                            }
                        },
                        error: function() {
                            $('#searchUserSkillResults').append('<p>Error fetching skills.</p>');
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
