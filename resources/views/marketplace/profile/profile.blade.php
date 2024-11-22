@extends('marketplace.layouts.master')
@section('title', 'Profile')
@section('page-title', 'Profile')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            @if (isset($profile->back_image))
                <div class="profile_coverimage_box"
                    style="background-image:url({{ asset('/images/' . $profile->back_image) }})">
                @else
                    <div class="profile_coverimage_box">
            @endif
            <div class="profile_main_image" style="background-image:url({{ asset('/images/' . $profile->image) }})"></div>
            </div>
            <div class="client_name_box">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="client_name_profile">{{ $profile->name }}</h3>
                        <div class="my-3"><span
                                class="userName_profile fs-4">{{ __('@ ') }}{{ $profile->user_name }}</span> &nbsp; <i
                                class="fa-solid fa-circle-check fs-3" style="color: #2e7bff;"></i></div>
                        <div>
                            @php
                                $rating = 2.3; // Assuming this value comes from your database or model
                                $maxRating = 5; // Total number of stars
                            @endphp
                            <span>
                                @for ($i = 1; $i <= $maxRating; $i++)
                                    @if ($i <= $rating)
                                        <i class="fa-solid fa-star rating_star_color fs-4"></i> <!-- Filled star -->
                                    @else
                                        <i class="fa-regular fa-star fs-4"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                                {{ __(' ' . $rating) }}
                            </span> &nbsp; &nbsp;
                            <i class="fa-regular fa-message fs-4" data-bs-toggle="tooltip" title="Project Review"></i>
                            <span class="fs-4">{{ __(' 447') }}</span>
                        </div>
                        <div>
                            <h4 class="mt-4">
                                @foreach ($skills as $item)
                                    <span>{{ $item->name }}, </span>
                                @endforeach
                            </h4>
                            @if ($profile->currency)
                                @php($symbols = DB::table('currencies')->where('code', $profile->currency)->first())
                                <p class="mt-4 fs-5"><b>{{ $symbols->symbol }}{{ $profile->hourly_rate }}
                                        {{ $profile->currency }}/Hour</b>. {{ $profile->country }}.
                                    Joined on {{ $profile->created_at->format('M j, Y') }}</p>
                            @else
                                <p class="mt-4 fs-5">--/Hour</b>. {{ $profile->country }}.
                                    Joined on {{ $profile->created_at->format('M j, Y') }}</p>
                            @endif

                            <p class="mt-3 ">{{ $profile->about }}</p>


                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="w-100 text-end ">
                            @if ($profile->id === Auth::user()->id)
                                <button class="btn btn-light me-3" data-bs-toggle="modal"
                                    data-bs-target="#edit_profile"><span
                                        class="fw-bold">{{ __('Edit Profile') }}</span></button>
                            @endif
                            <span><i class="fa-solid fa-share-nodes fs-2" data-bs-toggle="tooltip"
                                    title="Share Profile"></i></span>
                        </div>
                        <div class="profile_verified_main_box">
                            <h4 class="mb-3">{{ __('Verifications') }}</h4>
                            <div class="profile_verified_icons_box mb-3">
                                <i class="fa-solid fa-user client_green_icon fs-4" data-bs-toggle="tooltip"
                                    title="Profile Verified"></i>
                                <i class="fa-solid fa-envelope client_green_icon fs-4" data-bs-toggle="tooltip"
                                    title="Email Verified"></i>
                                <i class="fa-solid fa-credit-card client_green_icon fs-4" data-bs-toggle="tooltip"
                                    title="Identity Verified"></i>
                            </div>
                            <div class="profile_verified_items mb-2">
                                <span data-bs-toggle="tooltip"
                                    title="Percentage of project completed time duration">{{ __('Project time') }}
                                </span>
                                <span>97%</span>
                            </div>
                            <div class="profile_verified_items mb-2">
                                <span data-bs-toggle="tooltip"
                                    title="Percentage of project completed in budget">{{ __('Project budget') }}</span>
                                <span>95%</span>
                            </div>
                            <div class="profile_verified_items mb-2">
                                <span data-bs-toggle="tooltip"
                                    title="Percentage of project accept rate">{{ __('Accept rate') }}</span>
                                <span>94%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('Portfolio') }}</h4>
                        @if ($profile->id === Auth::user()->id)
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPortfolio"><i
                                    class="fa-regular fa-pen-to-square me-2"></i>{{ __('Add Portfolio') }}</button>
                        @endif
                    </div>
                    <div class="d-flex">
                        <p class="portfolio_page_item me-2 portfolio_active all-button"><b>{{ __('All') }}</b></p>
                        @foreach ($portfolio as $port)
                            <p class="portfolio_page_item me-2 java-button"><b>{{ $port->category }}
                                    {{ $port->count }}</b></p>
                        @endforeach
                    </div>
                    <div class="all-items">
                        <div class="row">
                            @foreach ($allPortfolio as $portItem)
                                @php($portImage = App\Models\marketplace\MarketplacePortfolioImages::where('portfolio_id', $portItem->id)->first())
                                <div class="col-lg-4 ">
                                    @if ($portImage)
                                        <img src="{{ asset('/images/' . $portImage->image) }}" alt="images"
                                            class="protfolio_image" data-bs-toggle="modal"
                                            data-bs-target="#portfolioModal{{ $portItem->id }}">
                                    @endif
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="portfolioModal{{ $portItem->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$portItem->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-8 protfolio_details_big_box">
                                                            <div class="row">
                                                                @php($portImages = App\Models\marketplace\MarketplacePortfolioImages::where('portfolio_id', $portItem->id)->get())
                                                                @if ($portImages)
                                                                @foreach ($portImages as $pImages)
                                                                <div class="col-12">
                                                                    <img src="{{ asset('/images/'.$pImages->image) }}"
                                                                        alt="images" class="protfolio_details_image">
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="container">
                                                                <div class="d-flex">
                                                                    <img src="{{ asset('/images/' . $profile->image) }}"
                                                                        alt="images"
                                                                        class="protfolio_details_profile_image">
                                                                    <div class="mx-3 ">
                                                                        <img src="{{ asset('admin_theme/marketplace/images/india.jpg') }}"
                                                                            alt="images"
                                                                            class="protfolio_details_country_image"><b>{{$profile->country}}</b>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <i class="fa-regular fa-star "></i>
                                                                    <i class="fa-regular fa-star "></i>
                                                                    <i class="fa-regular fa-star "></i>
                                                                    <i class="fa-regular fa-star ">
                                                                    </i><i class="fa-regular fa-star "></i>
                                                                    <Span class="">{{ __(' 4.5') }}</Span> &nbsp;
                                                                    &nbsp;
                                                                    <i class="fa-regular fa-message "
                                                                        data-bs-toggle="tooltip"
                                                                        title="Project Review"></i>
                                                                    <span class="">{{ __(' 447') }}</span>
                                                                </div>
                                                                @if ($profile->currency)
                                                                @php($symbols = DB::table('currencies')->where('code', $profile->currency)->first())
                                                                <p class="mt-3"><b>{{ $symbols->symbol }}{{ $profile->hourly_rate }}
                                                                    {{ $profile->currency }}/Hour</b></b></p>
                                                                @endif
                                                                

                                                                <div class="mt-3">
                                                                    <h5 class="mb-2">
                                                                        About the project
                                                                    </h5>
                                                                    <p>{{$portItem->description}}</p>
                                                                    <div class="mt-3">
                                                                        <span class="fs-4">{{ __('Skills') }}</span>
                                                                        <div class="row">
                                                                            @foreach ($skills as $item)
                                                                            <div class="col-lg-12 mb-3"><span
                                                                                class="protfolio_details_skills_item ">{{ $item->name }}</span>
                                                                        </div>
                                                                        @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <hr class="project_details_hr">
                                                                    <div>
                                                                        <span class="fs-5">Share: <i
                                                                                class="fa-brands fa-facebook "></i>&nbsp;<i
                                                                                class="fa-brands fa-linkedin "></i></span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="java-items" style="display:none;">
                        <div class="row">


                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/register.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/register2.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4 ">
                                <img src="{{ asset('admin_theme/marketplace/images/register3.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/login2.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                        </div>
                    </div>
                    <div class="web-items" style="display:none;">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/login2.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4 ">
                                <img src="{{ asset('admin_theme/marketplace/images/register3.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/login3.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>

                        </div>
                    </div>
                    <div class="mobile-items" style="display:none;">
                        <div class="row">

                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/login4.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/register.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset('admin_theme/marketplace/images/register2.jpg') }}" alt="images"
                                    class="protfolio_image" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="mt-5">
                    <h4>{{ __('Reviews') }}</h4>
                    <div>
                        <div class="row mb-4">
                            <div class="col-lg-2 col-md-2 p-0 ps-2">
                                <img src="{{ asset('admin_theme/marketplace/images/login5.jpg') }}" alt="images"
                                    class="review_image mb-3 ">
                            </div>
                            <div class="col-lg-8 col-md-8 p-0 ps-2">
                                <div>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                </div>
                                <div>
                                    <h5>website project &nbsp;$620.00 USD</h5>
                                </div>
                                <div>
                                    <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia adipisci
                                        reiciendis,
                                        expedita eius repudiandae alias iste vero quod eligendi cumque laborum suscipit in
                                        sequi dignissimos minima rerum natus? Voluptate, nisi!Atque esse tempora corrupti ut
                                        officia? A architecto atque voluptatum reiciendis blanditiis esse minima, inventore
                                        voluptatibus ut quidem quisquam autem rerum tempore dignissimos omnis repellendus
                                        pariatur magni obcaecati porro explicabo!</span>
                                </div>
                                <div>
                                    <span>@ userName</span>&nbsp;
                                    <span>2 Days Ago</span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="w-100 text-end">
                                    <i class="fa-solid fa-share-nodes fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-2 col-md-2 p-0 ps-2">
                                <img src="{{ asset('admin_theme/marketplace/images/login4.jpg') }}" alt="images"
                                    class="review_image mb-3">
                            </div>
                            <div class="col-lg-8 col-md-8 p-0 ps-2">
                                <div>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                    <i class="fa-regular fa-star fs-5"></i>
                                </div>
                                <div>
                                    <h5>website project &nbsp;$620.00 USD</h5>
                                </div>
                                <div>
                                    <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia adipisci
                                        reiciendis,
                                        expedita eius repudiandae alias iste vero quod eligendi cumque laborum suscipit in
                                        sequi dignissimos minima rerum natus? Voluptate, nisi!Atque esse tempora corrupti ut
                                        officia? A architecto atque voluptatum reiciendis blanditiis esse minima, inventore
                                        voluptatibus ut quidem quisquam autem rerum tempore dignissimos omnis repellendus
                                        pariatur magni obcaecati porro explicabo!</span>
                                </div>
                                <div>

                                    <span>@ userName</span>&nbsp;
                                    <span>2 Days Ago</span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="w-100 text-end">
                                    <i class="fa-solid fa-share-nodes fs-3"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="my-5">
                    <div class="experience_main_box mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h4>{{ __('Experience') }}</h4>
                            @if ($profile->id === Auth::user()->id)
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editExperience"><i
                                        class="fa-regular fa-pen-to-square me-2"></i>{{ __('Add Experience') }}</button>
                            @endif
                        </div>
                        @foreach ($experiences as $experience)                        
                        <div class="profile_verified_items row">
                            <div class="col-lg-2"> <img src="{{ asset('/images/'.$profile->image) }}"
                                    alt="images" class="experience_image">
                            </div>
                            <div class="col-lg-7 p-0">
                                <div class="ms-3">
                                    <p><b>{{$experience->title}}</b></p>
                                    <p>{{$experience->company}}</p>
                                    <p>{{$experience->description}}</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                @php($monthSname = DateTime::createFromFormat('!m', $experience->start_month)->format('M'))
                                @if($experience->end_month)
                                @php($monthEname = DateTime::createFromFormat('!m', $experience->end_month)->format('M'))
                                @endif
                                <p><b>{{$monthSname}} - {{$experience->start_year}}</b></p>
                                <p>9 years, 8 months</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- portfolio modal -->

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Edit Profile') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $profile->id }}">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="back_img" class="fw-bold">{{ __('Cover Image') }}</label><i
                                            class="fa-solid fa-circle-info fs-4 float-end" data-bs-toggle="tooltip"
                                            title="Upload a cover image with a maximum size of 2MB."></i>
                                        <input type="file" class="form-control" name="back_image" id="back_img">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="profile_img" class="fw-bold">{{ __('Profile Image') }}</label><i
                                            class="fa-solid fa-circle-info fs-4 float-end" data-bs-toggle="tooltip"
                                            title="Upload a profile image with a maximum size of 2MB."></i>
                                        <input type="file" class="form-control" name="image" id="profile_img">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="select-cover-image">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="select-profile-image">

                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4 d-flex">
                                    <div class="me-3"><label for="Currency"
                                            class="form-group-lable mb-2">{{ __('Currency') }}</label>
                                        <select name="currency" id="currency" class="form-select">
                                            @if ($profile->currency)
                                                <option value="{{ $profile->currency }}" selected>
                                                    {{ $profile->currency }}</option>
                                            @endif
                                            <option value="USD">{{ __('USD') }}</option>
                                            <option value="INR">{{ __('INR') }}</option>
                                            <option value="EUR">{{ __('EUR') }}</option>
                                            <option value="AUD">{{ __('AUD') }}</option>
                                            <option value="AUD">{{ __('NZD') }}</option>
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="hourly_rate"
                                            class="form-group-lable mb-2">{{ __('Hourly Rate') }}</label>
                                        <input type="number" name="hourly_rate" id="hourly_rate" class="form-control"
                                            step="0.01" placeholder="Hourly rate"
                                            value="{{ $profile->hourly_rate }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <div class="form-group">
                                        <label for="about" class="form-label fw-bold">{{ __('About us') }}</label>
                                        <textarea class="form-control" id="about" name="about" rows="3">{{ $profile->about }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-1"><label for="change_password"
                                        class="form-group-lable mb-2">{{ __('Change Your Password') }}</label>
                                </div>

                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <label for="old_pass" class="fw-bold">{{ __('Old Password') }}</label>
                                        <input type="password" class="form-control" name="old_password" id="old_pass"
                                            placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <label for="new_pass" class="fw-bold">{{ __('New Password') }}</label>
                                        <input type="password" class="form-control" name="new_password" id="new_pass"
                                            placeholder="Enter New Password" oninput="checkPasswordMatch()">
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <label for="confirm_pass" class="fw-bold">{{ __('Confirm Password') }}</label>
                                        <input type="password" class="form-control" name="new_password_confirmation"
                                            placeholder="Confirm New Password" id="confirm_pass"
                                            oninput="checkPasswordMatch()">
                                        <small id="passwordMatchMessage" class="text-success"
                                            style="display: none;">{{ __('Password Match') }}</small>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteProfileModal">
                                        {{ __('Delete Profile') }}
                                    </button>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Confirm Delete Modal -->
        <div class="modal fade" id="deleteProfileModal" tabindex="-1" aria-labelledby="deleteProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteProfileModalLabel">{{ __('Confirm Delete') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ __('Are you sure you want to delete your profile? This action cannot be undone.') }}
                        <form method="POST" action="{{ route('profile.delete', Auth::user()->id) }}">
                            @csrf
                                <div class="form-group my-3">
                                    <label for="old_password" class="fw-bold">{{ __('Old Password') }}</label>
                                    <input type="password" class="form-control" name="old_password" id="old_password"
                                        placeholder="Enter Password" required>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                       
                            <button type="submit" class="btn btn-danger">{{ __('Confirm Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Portfolio -->
        <div class="modal fade" id="addPortfolio" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Add Portfolio') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('storePortfolio') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title" class="fw-bold">{{ __('Title') }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Title">
                            </div>
                            <div class="form-group mb-3">
                                <label for="category" class="fw-bold">{{ __('Category') }}</label><i
                                    class="fa-solid fa-circle-info fs-4 float-end" data-bs-toggle="tooltip"
                                    title="Enter Portfolio Category Name (e.g., Web Design, Graphic Design, Photography)."></i>
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Enter Category">
                            </div>
                            <div class="form-group mb-3">
                                <label for="port_img" class="fw-bold">{{ __('Portfolio Images') }}</label><i
                                    class="fa-solid fa-circle-info fs-4 float-end" data-bs-toggle="tooltip"
                                    title="Choose portfolio images with a file size limit of 2MB."></i>
                                <input type="file" class="form-control" id="port_img" name="port_img[]" multiple>
                            </div>
                            <div class="selected-port-images">
                            </div>

                            <div class="form-group my-3">
                                <label for="description"
                                    class="form-label fw-bold">{{ __('Portfolio Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    placeholder="Enter portfolio description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Portfolio') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Experience -->
        <div class="modal fade" id="editExperience" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Add Experience') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('experience.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="title" class="fw-bold">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Your Title">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="company" class="fw-bold">{{ __('Company') }}</label>
                                        <input type="text" class="form-control" id="company" name="company"
                                            placeholder="Enter Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="country" class="fw-bold">{{ __('Country') }}</label>
                                        <input type="text" class="form-control" id="country" name="country"
                                            placeholder="Enter Country Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="city" class="fw-bold">{{ __('City') }}</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            placeholder="Enter City Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="start-month" class="fw-bold">{{ __('Start Month') }}</label>
                                        <input type="text" class="form-control" id="start-month" name="start_month"
                                            placeholder="Month Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-group">
                                        <label for="start-year" class="fw-bold">{{ __('Start Year') }}</label>
                                        <input type="text" class="form-control" id="start-year" name="start_year"
                                            placeholder="Enter Year">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="workingStatus" id="workingStatusYes" value="1">
                                        <label class="form-check-label fw-bold" for="workingStatusYes">
                                            Currently working here ?
                                        </label>
                                    </div>
                                </div>
                                <div class="row end-working">
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="end-month" class="fw-bold">{{ __('End Month') }}</label>
                                            <input type="text" class="form-control" id="end-month" name="end_month"
                                                placeholder="Month Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="end-year" class="fw-bold">{{ __('End Year') }}</label>
                                            <input type="text" class="form-control" id="end-year" name="end_year"
                                                placeholder="Enter Year">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="form-group">
                                        <label for="description"
                                            class="form-label fw-bold">{{ __('Description') }}</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe your work experience"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const allButton = document.querySelector('.all-button');
                const javaButton = document.querySelector('.java-button');
                const webButton = document.querySelector('.web-button');
                const mobileButton = document.querySelector('.mobile-button');

                const allItems = document.querySelector('.all-items');
                const javaItems = document.querySelector('.java-items');
                const webItems = document.querySelector('.web-items');
                const mobileItems = document.querySelector('.mobile-items');

                const buttons = [allButton, javaButton, webButton, mobileButton];
                const sections = [allItems, javaItems, webItems, mobileItems];

                function clearActive() {
                    buttons.forEach(button => button.classList.remove('portfolio_active'));
                    sections.forEach(section => section.style.display = 'none');
                }

                allButton.addEventListener('click', function() {
                    clearActive();
                    allButton.classList.add('portfolio_active');
                    allItems.style.display = 'block';
                });

                javaButton.addEventListener('click', function() {
                    clearActive();
                    javaButton.classList.add('portfolio_active');
                    javaItems.style.display = 'block';
                });

                webButton.addEventListener('click', function() {
                    clearActive();
                    webButton.classList.add('portfolio_active');
                    webItems.style.display = 'block';
                });

                mobileButton.addEventListener('click', function() {
                    clearActive();
                    mobileButton.classList.add('portfolio_active');
                    mobileItems.style.display = 'block';
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#port_img').on('change', function() {
                    // Clear the preview div
                    $('.selected-port-images').html('');

                    // Loop through each selected file
                    Array.from(this.files).forEach((file, index) => {
                        // Create a FileReader to read the image
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Create a div to hold each image preview
                            const imagePreview = $(`
                                <div class="port-image-preview" data-index="${index}">
                                    <img src="${e.target.result}" alt="Selected Image" width="100" height="100">
                                    <button type="button" class="remove-port-image">x</button>
                                </div>
                            `);

                            $('.selected-port-images').append(imagePreview);
                        };

                        // Read the file
                        reader.readAsDataURL(file);
                    });
                });

                // Handle image removal
                $(document).on('click', '.remove-port-image', function() {
                    const index = $(this).parent('.port-image-preview').data('index');

                    // Remove the image preview
                    $(this).parent('.port-image-preview').remove();

                    // Remove the file from the file input by reassigning a new FileList
                    const dt = new DataTransfer();
                    Array.from($('#port_img')[0].files)
                        .filter((_, i) => i !== index)
                        .forEach(file => dt.items.add(file));

                    $('#port_img')[0].files = dt.files;
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#back_img').on('change', function() {
                    // Clear any existing preview
                    $('.select-cover-image').html('');

                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Create the image preview element with remove button
                            const imagePreview = $(`
                                <div class="cover-image-preview">
                                    <img src="${e.target.result}" alt="Cover Image" width="100" height="100">
                                    <button type="button" class="remove-cover-image">x</button>
                                </div>
                            `);

                            $('.select-cover-image').append(imagePreview);
                        };

                        reader.readAsDataURL(file);
                    }
                });

                // Remove image preview on button click
                $(document).on('click', '.remove-cover-image', function() {
                    // Clear the preview and reset the input field
                    $('.select-cover-image').html('');
                    $('#back_img').val('');
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#profile_img').on('change', function() {
                    // Clear any existing preview
                    $('.select-profile-image').html('');

                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Create the image preview element with remove button
                            const imagePreview = $(`
                                <div class="profile-image-preview">
                                    <img src="${e.target.result}" alt="profile Image" width="100" height="100">
                                    <button type="button" class="remove-profile-image">x</button>
                                </div>
                            `);

                            $('.select-profile-image').append(imagePreview);
                        };

                        reader.readAsDataURL(file);
                    }
                });

                // Remove image preview on button click
                $(document).on('click', '.remove-profile-image', function() {
                    // Clear the preview and reset the input field
                    $('.select-profile-image').html('');
                    $('#profile_img').val('');
                });
            });
        </script>
        <script>
                $(document).ready(function() {
               toggleEndWorking();

            $('#workingStatusYes').change(function() {
                toggleEndWorking();
            });

            function toggleEndWorking() {
                const isYesChecked = $('#workingStatusYes').is(':checked');
                if (isYesChecked) {
                    $('.end-working').hide();
                } else {
                    $('.end-working').show();
                }
            }
        });
        </script>

        <script>
            function checkPasswordMatch() {
                const newPassword = document.getElementById('new_pass').value;
                const confirmPassword = document.getElementById('confirm_pass').value;
                const messageElement = document.getElementById('passwordMatchMessage');

                if (newPassword && confirmPassword && newPassword === confirmPassword) {
                    messageElement.style.display = 'block';
                } else {
                    messageElement.style.display = 'none';
                }
            }
        </script>
    @endsection
