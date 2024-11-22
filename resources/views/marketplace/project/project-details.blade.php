@extends('marketplace.layouts.master')
@section('title', 'Project-Details')
@section('page-title', 'Project-Details')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            <div class="container">
                <div class="project_details_heading_box mt-5">
                    <h2>{{ $project->name }}</h2>
                </div>
                <div class="project_details_heading_box">
                    @php(
    $symbols = DB::table('currencies')->where('code', $project->currency)->first()
)
                    <div class="d-flex">
                        <div>{{ __('Bids') }}<h5>{{ $bids }}</h5>
                        </div>
                        <div class="ms-3">{{ __('Average bid') }}<h5>{{ $symbols->symbol }}{{ $avg_rate }}
                                {{ $project->currency }}</h5>
                        </div>
                    </div>
                    <div class="text-end">
                        <form id="bookmarkForm" action="{{ route('storeBookmark', $project->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @php($bookmarks = App\Models\marketplace\Marketplace_bookmarks::where('project_id',$project->id)->where('user_id',Auth::user()->id)->first())
                            @if($bookmarks)
                            <i class="fa-solid fa-bookmark fs-4 project_bookmark" data-bs-toggle="tooltip" title="Save Project" onclick="document.getElementById('bookmarkForm').submit();"></i>
                            @else
                            <i class="fa-regular fa-bookmark fs-4 project_bookmark" data-bs-toggle="tooltip" title="Save Project" onclick="document.getElementById('bookmarkForm').submit();"></i>
                            @endif
                            <i class="fa-solid fa-share-nodes fs-4" data-bs-toggle="tooltip" title="Share Project"></i>
                        </form>
                        
                    </div>
                </div>
                <hr class="project_details_hr">
                <div class="row mt-5">
                    <div class="col-lg-9">
                        <div class="project_details_main_box">
                            <div class="project_details_heading_box">
                                <h4>{{ __('Project Details') }}</h4>
                                <div>
                                    <h6>{{ $symbols->symbol }}{{ $project->min_rate }} - {{ $project->max_rate }}
                                        {{ $project->currency }}</h6>
                                    <div><i class="fa-solid fa-clock"></i><span
                                            class="project_details_bidding"><b>{{ __(' Bidding end in 1 Year, 2 Months') }}</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                @php($skills = App\Models\marketplace\Marketplace_project_skills::where('project_id', $project->id)->get())
                                <div class="d-flex">
                                    <h5 class="me-3">{{ __('Skills') }}</h5>
                                    @foreach ($skills as $skill)
                                        <p class="project_details_skills_item me-2">{{ $skill->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-3">
                                <p>{{ $project->description }}
                                </p>
                            </div>
                        </div>
                        <div class="project_details_main_box my-5">
                            <div>
                                <h4>{{ __('Place a bid on this project') }}</h4>
                            </div>
                            <hr class="project_details_hr">
                            <div>
                                <p>{{ __('You will be able to edit your bid Until the project is awarded to someone.') }}
                                </p>
                            </div>
                            <form action="{{ route('storeBid', $project->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-5">
                                        <span><b>{{ __('Bid Amount') }}</b></span>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                aria-label="Amount (to the nearest dollar)" name="bid_amount"
                                                placeholder="{{ __('140.00') }}">
                                                <div>
                                                    <span class=""><select name="currency" id="currency" class="form-select">
                                                        <option value="USD" selected>{{ __('USD') }}</option>
                                                        <option value="INR">{{ __('INR') }}</option>
                                                        <option value="EUR">{{ __('EUR') }}</option>
                                                        <option value="AUD">{{ __('AUD') }}</option>
                                                        <option value="AUD">{{ __('NZD') }}</option>
                                                        </option>
                                                    </select></span>
                                                    </div>
                                            </div>
                                            
                                    </div>
                                    <div class="col-lg-6">
                                        <span><b>{{ __('This project will be delivered in ') }}</b></span>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                aria-label="Amount (to the nearest dollar)" name="delivery_days"
                                                placeholder="{{ __('5') }}">
                                            <span class="input-group-text">{{ __('Days') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="">
                                            <span><b>{{ __('Describe your proposal (maximum 200 characters)') }}</b></span>
                                            <span class="textarea_bid_back">{{ __('Write your bid') }}</span>
                                        </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="proposal"
                                            placeholder="What makes you the best candidate for this project?" maxlength="200"></textarea>
                                        <small id="charCount">0/200 characters</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary" type="submit">Send Proposal</button>
                                </div>
                            </form>
                            <div class="project_details_warning_box mt-5">
                                <div class="me-3"><i class="fa-solid fa-triangle-exclamation warning_icon"></i></div>
                                <div>
                                    <h5>{{ __('Beware of scams') }}</h5>
                                    <p>{{ __('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo, tempora. Sit ipsam
                                                                                                            doloremque qui, ratione, beatae aut quibusdam quasi, ipsa a possimus numquam culpa
                                                                                                            unde. Nemo vero est distinctio consequuntur!Possimus aspernatur at, velit tempore') }}
                                    </p>
                                    <a href="#">{{ __('View More') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="project_details_main_box">
                            <h5>{{ __('About the Client') }}</h5>
                            <div class="mb-2">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{$user->city}}</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-regular fa-flag"></i>
                                <span>{{$user->country}}</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-user"></i>
                                @php($rating = 2)
                                <span>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="fa-solid fa-star rating_star_color"></i> <!-- Filled star -->
                                        @else
                                            <i class="fa-regular fa-star"></i> <!-- Empty star -->
                                        @endif
                                    @endfor
                                    {{ __(' ' . $rating) }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-clock"></i>
                                <span>{{ __('Member since Aug 20,2024') }}</span>
                            </div>
                            <h5 class="mt-4">{{ __('Client Engagement') }}</h5>
                            <div class="mb-2">
                                <i class="fa-solid fa-circle-exclamation client_green_icon"></i>
                                <span>{{ __('Upgrade your membership to see client engagement') }}</span>
                            </div>

                            <h5 class="mt-4">{{ __('Client Verification') }}</h5>
                            <div class="mb-2">
                                <i class="fa-solid fa-receipt client_green_icon"></i>
                                <span>{{ __('Payment verified') }}</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-credit-card"></i>
                                <span>{{ __('Deposit made') }}</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-envelope client_green_icon"></i>
                                <span>{{ __('Email verified') }}</span>
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-user client_green_icon"></i>
                                <span>{{ __('Profile completed') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    @section('scripts')
        <script>
            const textarea = document.getElementById('exampleFormControlTextarea1');
            const charCount = document.getElementById('charCount');

            textarea.addEventListener('input', function() {
                const currentLength = textarea.value.length;
                charCount.textContent = `${currentLength}/200 characters`;
            });
        </script>
       <script>
        $(document).ready(function() {
            $('.fa-bookmark').click(function() {
                $('#bookmarkForm').submit();
            });
        });
    </script>
    @endsection
