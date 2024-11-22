@extends('marketplace.layouts.master')
@section('title', 'Home')
@section('page-title', 'Home')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            <div class="mt-3 row">
                <div class="col-lg-4 d-flex align-items-center">
                    <button class="btn btn-primary project_add_button me-3" id="Project">{{__('Project')}}</button>
                    <button class="btn btn-primary user_add_button home_button" id="Users">{{__('Freelancer')}}</button>
                </div>
                <div class="col-lg-5">
                    <!-- App Search-->
                    <div id="project-search-top">
                        <form class="app-search d-none d-lg-block main_head_search">
                            <div class="position-relative search_input_box">
                                <input type="text" class="form-control" placeholder="Search..." name="topSearch" id="topSearch">
                                <span class="ri-search-line"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
            <div id="project_main_box" style="display: block">
                <div class="all_industry_filter_head mt-4">
                    @foreach ($industries as $item)
                        <span class="all_industry_name" data-id="{{ $item->id }}" id="industry_{{ $item->id }}">
                            {{ $item->name }}
                        </span>
                    @endforeach
                </div>
                <div class="row mt-3">
                    <div class="col-lg-9">
                        <div class="row mb-2">
                            <div class="col-8"></div>
                            <div class="col-2 p-0 project_details_sort_box">
                                <h5 class="pe-1">{{ __('Sort by') }}</h5>
                            </div>
                            <div class="col-2 p-0 pe-3">
                                
                                <select class="form-select Project_sortBy" aria-label="Default select example">
                                    <option selected value="Latest">{{ __('Latest') }}</option>
                                    <option value="Oldest">{{ __('Oldest') }}</option>
                                    <option value="Lowest Price">{{ __('Lowest Price') }}</option>
                                    <option value="Highest Price">{{ __('Highest Price') }}</option>
                                    <option value="Fewest Bids">{{ __('Fewest Bids') }}</option>
                                    <option value="Most Bids">{{ __('Most Bids') }}</option>
                                </select>
                                
                            </div>
                        </div> 
                        <div id="projectList">
                            @foreach ($project as $pItem)
                                <div class="project_main_box">
                                    <div class="container p-4">
                                        <div class="project_heading_box mb-2">
                                            <div class="project_item_small_box">
                                                <h2 class="mb-2">{{ $pItem->name }}</h2>
                                                @php(
                                                    $symbols = DB::table('currencies')->where('code', $pItem->currency)->first()
                                                )
                                                <h6>{{__('Budget')}} {{ $symbols->symbol }}{{ $pItem->min_rate }} - {{ $pItem->max_rate }} {{ $pItem->currency }}</h6>
                                            </div>
                                            <div class="project_item_small_box d-flex">
                                                <div class="me-3">
                                                    @php($bidCount =App\Models\marketplace\Marketplace_bids::where('project_id',$pItem->id)->count())
                                                    <h4>{{$bidCount}} {{__('Bids')}}</h4>
                                                </div>
                                                <div>
                                                <h2 class="mb-2">
                                                    @php($avg_rate = ($pItem->min_rate + $pItem->max_rate) / 2)
                                                    {{ $symbols->symbol }}{{ $avg_rate }} {{ $pItem->currency }}
                                                </h2>
                                                <h6>{{ $pItem->project_rate }} {{__('Rate')}}</h6>
                                               </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('project-details', $pItem->id) }}">
                                                <p>{{ Str::words($pItem->description, 50, '...more') }}</p>
                                            </a>
                                        </div>
                                        <div class="mb-3">
                                            @php($skills = App\Models\marketplace\Marketplace_project_skills::where('project_id', $pItem->id)->get())
                                            @foreach ($skills as $skill)
                                                <span>{{ Str::words($skill->name, 5, '...more') }}</span>
                                            @endforeach
                                        </div>
                                        <div class="project_rating_box ">
                                            <div class="project_rating_box">
                                                <span class="me-2">{{ $pItem->created_at }}</span>
                                                @php(
                                                    $bookmarks = App\Models\marketplace\Marketplace_bookmarks::where('project_id', $pItem->id)
                                                        ->where('user_id', Auth::user()->id)
                                                        ->first()
                                                )
                                                <span>
                                                    @if ($bookmarks)
                                                        <i class="fa-solid fa-bookmark fs-4 project_bookmark" data-project-id="{{ $pItem->id }}"></i>
                                                    @else
                                                        <i class="fa-regular fa-bookmark fs-4 project_bookmark" data-project-id="{{ $pItem->id }}"></i>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3">
                        
                            <div class="filter_main_box">
                                <h2 class="my-3">{{ __('Filters') }}</h2>

                                <div class="project_type_box">
                                    <h5>{{ __('Project type') }}</h5> <Span class="clear_button" onclick="showTypeBox()"
                                        id="type_button">{{ __('-') }}</Span>
                                </div>
                                <div id="project_type_Item" style="display: block;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes" name="remote_project"
                                            id="remote_project">
                                        <label class="form-check-label" for="remote_project">
                                            {{ __('Remote Project') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="project_type_box">
                                    <h5>{{ __('Project rate') }}</h5> <Span class="clear_button" onclick="showItemBox()"
                                        id="clear_button">{{ __('-') }}</Span>
                                </div>
                                <div id="project_rate_Item" style="display: block;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Hourly"
                                            name="hourly_rate" id="hourly_rate">
                                        <label class="form-check-label" for="hourly_rate">
                                            {{ __('Hourly Rate') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Fixed"
                                            id="fixed_rate" name="fixed_rate">
                                        <label class="form-check-label" for="fixed_rate">
                                            {{ __('Fixed Price') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="project_type_box">
                                    <h5>{{ __('Price') }}</h5> <Span class="clear_button" onclick="showFixedBox()"
                                        id="fixed_button">{{ __('-') }}</Span>
                                </div>
                                <div id="fixed_Item" style="display: block;">
                                    <span><b>{{ __('Currency') }}</b></span>
                                    <select name="currency" id="currency"
                                        class="form-select mb-3 currency">
                                        <option value="All" selected>{{ __('Select Currency') }}</option>
                                        <option value="INR" >{{ __('INR') }}</option>
                                        <option value="USD" >{{ __('USD') }}</option>
                                        <option value="EUR">{{ __('EUR') }}</option>
                                        <option value="AUD">{{ __('AUD') }}</option>
                                        <option value="NZD">{{ __('NZD') }}</option>
                                        </option>
                                    </select>
                                    <span><b>{{ __('min') }}</b></span>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control min_rate" name="min_rate" id="min_rate"
                                            aria-label="Amount (to the nearest dollar)" placeholder="{{ __('0') }}">
                                        
                                    </div>
                                    <span><b>{{ __('max') }}</b></span>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control max_rate" name="max_rate" id="max_rate"
                                            aria-label="Amount (to the nearest dollar)"
                                            placeholder="{{ __('1000+') }}">
                                    </div>
                                </div>

                           
                                <div class="project_type_box">
                                    <h5>{{ __('Skills') }}</h5> <Span class="clear_button" onclick="showSkillsBox()"
                                        id="skills_button">{{ __('-') }}</Span>
                                 </div>
                                    <div id="skills_Item" style="display: block;">
                                        <form class="app-search d-lg-block p-0 mb-2" id="skill-search-form">
                                            <div class="position-relative search_input_box">
                                             <input type="text" class="form-control" id="skill-search-input" placeholder="Search countries">
                                             <span class="ri-search-line"></span>
                                            </div>
                                        </form>
                                        <div id="skill-search-result">
                                        <div id="skill-results">
                                            <!-- Checkbox results will be displayed here -->
                                        </div> 
                                                                  
                                       
                                        @foreach ($combinedSkills as $skillItem)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $skillItem }}"
                                                id="{{ $skillItem }}" >
                                            <label class="form-check-label" for="{{ $skillItem}}">
                                                <span>{{ $skillItem}}</span>
                                            </label>
                                        </div>
                                         @endforeach                                   
                                     
                                       </div>   
                                    </div>
                                <div class="project_type_box">
                                    <h5>{{ __('Listing type') }}</h5> <Span class="clear_button"
                                        onclick="showListingBox()" id="listing_button">{{ __('-') }}</Span>
                                </div>
                                <div id="listing_Item" style="display: block;">
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="All" id="all" name="listing_type">
                                        <label class="form-check-label" for="featured">
                                            <span>{{ __('All') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="Featured" id="featured" name="listing_type">
                                        <label class="form-check-label" for="featured">
                                            <span>{{ __('Featured') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="Sealed" id="sealed" name="listing_type">
                                        <label class="form-check-label" for="sealed">
                                            <span>{{ __('Sealed') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="NDA" id="nda" name="listing_type">
                                        <label class="form-check-label" for="nda">
                                            <span>{{ __('NDA') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="Urgent" id="urgent" name="listing_type">
                                        <label class="form-check-label" for="urgent">
                                            <span> {{ __('Urgent') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="Recruiter" id="recruiter" name="listing_type">
                                        <label class="form-check-label" for="recruiter">
                                            <span>{{ __('Recruiter') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input listing_type" type="radio" value="IP Agreement" id="ip-agreement" name="listing_type">
                                        <label class="form-check-label" for="ip-agreement">
                                            <span> {{ __('IP Agreement') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="project_type_box">
                                    <h5>{{ __('Project location') }}</h5> <Span class="clear_button"
                                        onclick="showLocationBox()" id="location_button">{{ __('-') }}</Span>
                                </div>
                                <div id="location_Item" style="display: block;">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control location" id="location" placeholder="Enter location">
                                        <span class="input-group-text"><i
                                                class="fa-solid fa-location-crosshairs"></i></span>
                                    </div>
                                </div>

                                
                                
                            </div>
                    
                    </div>
                </div>
            </div>
            <div id="user_main_box" style="display: none">
                <div class="row mt-5">
                    <div class="col-lg-9">
                        <div class="row" id="userList">
                            @foreach ($freelancers as $freelancer)
                                <div class="col-lg-4 mb-4">
                                    <a href="{{ route('profile.show', $freelancer->id) }}">
                                        <div class="user_profile_main_box p-2">
                                            <div class="d-flex justify-content-between">
                                                <div class="user_img_profile_box">
                                                    @if (isset($freelancer->image))
                                                        <img src="{{ URL::asset('images/' . $freelancer->image) }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ URL::asset('images/profile.jpg') }}"
                                                            alt="">
                                                    @endif
                                                </div>
                                                @if($freelancer->is_online)
                                                <div class="user_live_button"></div>
                                                @else
                                                <div class="user_ofline_button"></div>
                                                @endif
                                                
                                                {{-- <div class="user_ofline_button"></div> --}}
                                                <div class="text-end">
                                                    <div>
                                                        @if (isset($freelancer->hourly_rate))
                                                            <span
                                                                class="fs-5 fw-bolder">{{ $symbols->symbol }}{{ $freelancer->hourly_rate }}
                                                                {{ $freelancer->currency }}</span><br>
                                                            <span class="text-end">{{__('per hour')}}</span>
                                                        @else
                                                            <span class="fs-5 fw-bolder"></span><br>
                                                            <span class="text-end"></span>
                                                        @endif
                                                    </div>
                                                    <div class="mt-5">
                                                        <a href="{{ route('chats.index', ['receiver_id' => $freelancer->id]) }}"
                                                            class="btn btn-primary">{{__('Chat')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <h4>{{ $freelancer->name }}</h4>
                                            </div>

                                            <div class="my-2">
                                                <span><b>{{__('Skills:')}} </b></span>
                                                @php($uSkills = App\Models\marketplace\Marketplace_user_skills::where('user_id', $freelancer->id)->get())
                                                @foreach ($uSkills as $index => $userSkill)
                                                    @if ($index < 4)
                                                        <span>{{ $userSkill->name }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div>
                                                <span><b>{{__('About us:')}} </b></span>
                                                <span>{{ Str::limit($freelancer->about, 60, '..more') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="filter_main_box">

                            <h2 class="my-3">{{ __('Filters') }}</h2>
                            <div class="project_type_box"> 
                                <h5>{{ __('Hourly rate') }}</h5>
                            </div>
                            <div id="hourly_Item">
                                    <span><b>{{ __('Currency') }}</b></span>
                                    <select name="currency" id="user-currency"
                                        class="form-select mb-3 currency">
                                        <option value="All" selected>{{ __('Select Currency') }}</option>
                                        <option value="INR" >{{ __('INR') }}</option>
                                        <option value="USD" >{{ __('USD') }}</option>
                                        <option value="EUR" >{{ __('EUR') }}</option>
                                        <option value="AUD" >{{ __('AUD') }}</option>
                                        <option value="NZD" >{{ __('NZD') }}</option>
                                        </option>
                                    </select>
                                    <span><b>{{ __('min') }}</b></span>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control min_rate" name="user-min_rate" id="user-min_rate"
                                            aria-label="Amount (to the nearest dollar)" placeholder="{{ __('0') }}">
                                    </div>
                                    <span><b>{{ __('max') }}</b></span>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control max_rate" name="user-max_rate" id="user-max_rate"
                                            aria-label="Amount (to the nearest dollar)"
                                            placeholder="{{ __('1000+') }}">
                                    </div>
                            </div>

                            <div class="project_type_box mb-2">
                                <h5>{{ __('Skills') }}</h5>
                            </div>
                            <div id="user-skills_Item" style="display: block;">
                                    <form class="app-search d-lg-block p-0 mb-2" id="user-skill-search-form">
                                        <div class="position-relative search_input_box">
                                         <input type="text" class="form-control" id="user-skill-search-input" placeholder="Search countries">
                                         <span class="ri-search-line"></span>
                                        </div>
                                    </form>
                                    <div id="user-skill-search-result">
                                        <div id="user-skill-results">
                                            <!-- Checkbox results will be displayed here -->
                                        </div> 
                                        @foreach ($combinedUserSkills as $skillItem)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $skillItem }}" 
                                                   id="{{ $skillItem }}" 
                                                   @if(in_array($skillItem, session('selected_userSkills', []))) @endif>
                                            <label class="form-check-label" for="{{ $skillItem }}">
                                                <span>{{ $skillItem }}</span>
                                            </label>
                                        </div>
                                    @endforeach                                  
                                   </div>   
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('admin_theme/marketplace/js/project.js') }}"></script>
        <!-- App js -->
         <script>
           $(document).ready(function() {
            // Triggered when an industry name is clicked
            $('.all_industry_name').on('click', function() {
                var industryId = $(this).data('id'); // Get the selected industry id
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';  // Check if remote project checkbox is checked
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var topSearch = $('#topSearch').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills // Send the selected skills
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            // Triggered when the sorting option changes
            $('.Project_sortBy').on('change', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $(this).val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Check if remote project checkbox is checked
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var topSearch = $('#topSearch').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });
                    // Triggered when the remote project checkbox is clicked
            $('#remote_project').on('change', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var topSearch = $('#topSearch').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            $('#hourly_rate').on('change', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : ''; 
                var listingType = $('input[name="listing_type"]:checked').val(); 
                var location = $('#location').val();
                var topSearch = $('#topSearch').val();
                var currency = $('#currency').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });
            $('#fixed_rate').on('change', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var topSearch = $('#topSearch').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            // $('#fixed_rate').on('change', function() {
            //     var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
            //     var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
            //     var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
            //     var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
            //     var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
            //     var listingType = $('input[name="listing_type"]:checked').val();
            //     var location = $('#location').val();
            //     var currency = $('#currency').val();
            //     var topSearch = $('#topSearch').val();
            //     var minRate = $('input[name="min_rate"]').val(); // Capture min rate
            //     var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
            //     var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     $.ajax({
            //         url: '/projects/filter',
            //         method: 'GET',
            //         data: { 
            //             industry_id: industryId, 
            //             sort: sortOption, 
            //             remote_project: isRemote,
            //             hourly_rate: isHourly,
            //             fixed_rate: isFixed,
            //             listing_type: listingType,
            //             location: location,
            //             currency: currency,
            //             min_rate: minRate,
            //             max_rate: maxRate,
            //             selected_skills: selectedSkills,
            //             topSearch: topSearch
            //         },
            //         success: function(response) {
            //             $('#projectList').html(response); // Update project list with filtered results
            //         },
            //         error: function(xhr, status, error) {
            //             console.error("Error:", error); // Log errors if any
            //         }
            //     });
            // });

            $('.listing_type').on('change', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var topSearch = $('#topSearch').val();
                var currency = $('#currency').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            $('.location').on('keyup', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $(this).val();
                var topSearch = $('#topSearch').val();
                var currency = $('#currency').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            $('#topSearch').on('keyup', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var topSearch = $(this).val();

                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills, 
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });
            $('#currency').on('change', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $(this).val(); 
                var topSearch = $('#topSearch').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_skills: selectedSkills,
                        topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });
            $('#min_rate').on('keyup', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var topSearch = $('#topSearch').val();
                var minRate = $(this).val(); // Capture min rate
                var maxRate = $('input[name="max_rate"]').val(); // Capture max rate
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                         selected_skills: selectedSkills,
                         topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });
            $('#max_rate').on('keyup', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var currency = $('#currency').val();
                var minRate = $('input[name="min_rate"]').val(); // Capture min rate
                var maxRate = $(this).val(); // Capture max rate
                var topSearch = $('#topSearch').val();
                var selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: {
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                       selected_skills: selectedSkills,
                       topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            $('#skill-search-result').on('change', '.form-check-input', function() {
                var industryId = $('.all_industry_name.active').data('id'); // Get the selected industry id if available
                var sortOption = $('.Project_sortBy').val(); // Get the selected sort option
                var isRemote = $('#remote_project').prop('checked') ? 'yes' : '';// Get the state of the checkbox (checked or unchecked)
                var isHourly = $('#hourly_rate').prop('checked') ? 'Hourly' : '';  
                var isFixed = $('#fixed_rate').prop('checked') ? 'Fixed' : '';  
                var listingType = $('input[name="listing_type"]:checked').val();
                var location = $('#location').val();
                var topSearch = $('#topSearch').val();
                var currency = $('#currency').val();
                var minRate = $('input[name="min_rate"]').val() || ''; // Default to empty if no value
                var maxRate = $('input[name="max_rate"]').val() || ''; // Default to empty if no value

                var selectedSkills = $('#skill-search-result .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();
                
                $.ajax({
                    url: '/projects/filter',
                    method: 'GET',
                    data: { 
                        industry_id: industryId, 
                        sort: sortOption, 
                        remote_project: isRemote,
                        hourly_rate: isHourly,
                        fixed_rate: isFixed,
                        listing_type: listingType,
                        location: location,
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                       selected_skills: selectedSkills, // Send the selected skills
                       topSearch: topSearch
                    },
                    success: function(response) {
                        $('#projectList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });
        });
         </script>
        <script>
            $(document).ready(function() {
                $('#Users').click(function() {
                    $('#project_main_box').hide();
                    $('#project-search-top').hide();
                    $('.project_add_button').addClass('home_button');
                    $('#user_main_box').show();
                    $('.user_add_button').removeClass('home_button');
                });
                $('#Project').click(function() {
                    $('#project_main_box').show();
                    $('#project-search-top').show();
                    $('.project_add_button').removeClass('home_button')
                    $('#user_main_box').hide();
                    $('.user_add_button').addClass('home_button');
                });
            });

            function showMoreUserSkills() {
                var moreSkills = document.getElementById('moreUserSkills');
                var btn = document.getElementById('viewMoreButton');
                var viewbtn = document.getElementById('viewBtn');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    viewbtn.innerHTML = "View Less"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    viewbtn.innerHTML = "View More"; // Reset button text
                }
            }
        </script>
        <script>
            $(document).on('click', '.project_bookmark', function(e) {
            e.preventDefault(); // Prevent default action

            // Get the project ID from a custom data attribute
            var projectId = $(this).data('project-id');

            // Reference to the clicked icon
            var bookmarkIcon = $(this);

            // Send AJAX request
            $.ajax({
                url: `/storeBookmark/${projectId}`, // Pass the project ID in the URL
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    // Update the bookmark icon dynamically
                    if (response.bookmarked) {
                        bookmarkIcon.removeClass('fa-regular').addClass('fa-solid');
                        toastr.success('Project bookmarked successfully!');
                    } else {
                        bookmarkIcon.removeClass('fa-solid').addClass('fa-regular');
                        toastr.success('Project remove from bookmark');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error bookmarking:", error);
                    alert("Failed to bookmark. Please try again.");
                }
            });
        });
        </script>
       
        <script>
            $(document).ready(function() {
                // Variable to store selected skills for later
                let selectedSkills = [];
        
                // When typing in the search input
                $('#skill-search-input').on('input', function() {
                    const query = $(this).val();
                    
                    // Clear previous search results only, don't touch selected skills
                    if (query.length > 1) { // Start searching after 2 characters
                        $.ajax({
                            url: '{{ route("search.skills") }}',
                            method: 'GET',
                            data: { query: query },
                            success: function(data) {
                                // Clear results and display new ones
                                $('#skill-results').empty();
                                
                                // Display results as checkboxes
                                data.forEach(skill => {
                                    const skillHTML = `
                                        <div class="form-check skill-item" data-skill-id="${skill.id}">
                                            <input class="form-check-input" type="checkbox" value="${skill.id}" id="skill-${skill.id}" ${selectedSkills.includes(String(skill.id)) ? 'checked' : ''}>
                                            <label class="form-check-label" for="skill-${skill.id}">
                                                ${skill.name}
                                            </label>
                                        </div>
                                    `;
                                    $('#skill-results').append(skillHTML);
                                });
        
                                // Hide only unselected skills that don't match the query
                                $('#skill-results .skill-item').each(function() {
                                    const skillId = $(this).data('skill-id');
                                    const skillLabel = $(this).find('label').text().toLowerCase();
                                    const queryLower = query.toLowerCase();
        
                                    // Hide skill if it does not match query and is not selected
                                    if (!selectedSkills.includes(String(skillId)) && !skillLabel.includes(queryLower)) {
                                        $(this).hide(); // Hide unselected skills
                                    }
                                });
                                
                            }
                        });
                    } 
                });
        
                // When a checkbox is checked/unchecked
                $('#skill-results').on('change', '.form-check-input', function() {
                    // Update selected skills list
                    selectedSkills = $('#skill-results .form-check-input:checked').map(function() {
                        return $(this).val();
                    }).get();
        
                    // Show only selected skills and hide unselected skills
                    $('#skill-results .skill-item').each(function() {
                        const skillId = $(this).data('skill-id');
                        if (selectedSkills.includes(String(skillId))) {
                            $(this).show();  // Show selected
                        } else {
                            $(this).hide();  // Hide unselected
                        }
                    });
        
                    // Store selected skills in session or handle as needed
                    $.ajax({
                        url: '{{ route("store.selected.skills") }}',  // Your route to store selected skills
                        method: 'POST',
                        data: { selected_skills: selectedSkills, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if (response.success) {
                                
                            }
                        }
                    });
                });
            });
        </script>
    
       <script>
        $(document).ready(function() {
            $('#user-min_rate').on('keyup', function() {
                var currency = $('#user-currency').val();
                var minRate =$(this).val(); 
                var maxRate = $('input[name="user-max_rate"]').val() || '';
                $.ajax({
                    url: '/users/filter',
                    method: 'GET',
                    data: { 
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                    },
                    success: function(response) {
                        $('#userList').html(response); 
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); 
                    }
                });
            });
            $('#user-max_rate').on('keyup', function() {
                var currency = $('#user-currency').val();
                var minRate = $('input[name="user-min_rate"]').val() || '';
                var maxRate = $(this).val();
                $.ajax({
                    url: '/users/filter',
                    method: 'GET',
                    data: { 
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                    },
                    success: function(response) {
                        $('#userList').html(response); 
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); 
                    }
                });
            });

            $('#user-currency').on('change', function() {
                var currency = $(this).val(); 
                var minRate = $('input[name="user-min_rate"]').val()|| '';
                var maxRate = $('input[name="user-max_rate"]').val() || '';
                
                $.ajax({
                    url: '/users/filter',
                    method: 'GET',
                    data: { 
                       
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        
                    },
                    success: function(response) {
                        $('#userList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });
            });

            $('#user-skill-search-result').on('change', '.form-check-input', function() {
                var currency = $('#user-currency').val();
                var minRate = $('input[name="user-min_rate"]').val()|| '';
                var maxRate = $('input[name="user-max_rate"]').val() || '';

                var selectedUserSkills = $('#user-skill-search-result .form-check-input:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: '/users/filter',
                    method: 'GET',
                    data: { 
                       
                        currency: currency,
                        min_rate: minRate,
                        max_rate: maxRate,
                        selected_userSkills: selectedUserSkills // Send the selected skills
                    },
                    success: function(response) {
                        $('#userList').html(response); // Update project list with filtered results
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Log errors if any
                    }
                });

            });

            });
       </script>
        <script>
            $(document).ready(function() {
                // Variable to store selected skills for later
                let selectedUserSkills = [];
        
                // When typing in the search input
                $('#user-skill-search-input').on('input', function() {
                    const query = $(this).val();
                    
                    // Clear previous search results only, don't touch selected skills
                    if (query.length > 1) { // Start searching after 2 characters
                        $.ajax({
                            url: '{{ route("user-search.skills") }}',
                            method: 'GET',
                            data: { query: query },
                            success: function(data) {
                                // Clear results and display new ones
                                $('#user-skill-results').empty();
                                
                                // Display results as checkboxes
                                data.forEach(skill => {
                                    const skillHTML = `
                                        <div class="form-check skill-item" data-skill-id="${skill.id}">
                                            <input class="form-check-input" type="checkbox" value="${skill.id}" id="skill-${skill.id}" ${selectedUserSkills.includes(String(skill.id)) ? 'checked' : ''}>
                                            <label class="form-check-label" for="skill-${skill.id}">
                                                ${skill.name}
                                            </label>
                                        </div>
                                    `;
                                    $('#user-skill-results').append(skillHTML);
                                });
        
                                // Hide only unselected skills that don't match the query
                                $('#user-skill-results .skill-item').each(function() {
                                    const skillId = $(this).data('skill-id');
                                    const skillLabel = $(this).find('label').text().toLowerCase();
                                    const queryLower = query.toLowerCase();
        
                                    // Hide skill if it does not match query and is not selected
                                    if (!selectedUserSkills.includes(String(skillId)) && !skillLabel.includes(queryLower)) {
                                        $(this).hide(); // Hide unselected skills
                                    }
                                });
                                
                            }
                        });
                    } 
                });
        
                // When a checkbox is checked/unchecked
                $('#user-skill-results').on('change', '.form-check-input', function() {
                    // Update selected skills list
                    selectedUserSkills = $('#user-skill-results .form-check-input:checked').map(function() {
                        return $(this).val();
                    }).get();
        
                    // Show only selected skills and hide unselected skills
                    $('#user-skill-results .skill-item').each(function() {
                        const skillId = $(this).data('skill-id');
                        if (selectedUserSkills.includes(String(skillId))) {
                            $(this).show();  // Show selected
                        } else {
                            $(this).hide();  // Hide unselected
                        }
                    });
        
                    // Store selected skills in session or handle as needed
                    $.ajax({
                        url: '{{ route("user.selected.skills") }}',  // Your route to store selected skills
                        method: 'POST',
                        data: { selected_userSkills: selectedUserSkills, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if (response.success) {
                                
                            }
                        }
                    });
                });
            });
        </script>
          
    @endsection
