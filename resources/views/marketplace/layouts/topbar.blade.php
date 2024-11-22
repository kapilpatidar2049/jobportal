<header id="page-topbar">
    <div class="d-flex">
        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
            id="sidebarCollapse">
            <i class="ri-menu-2-line align-middle"></i>
        </button>
        <div class="navbar-header w-100">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-dark.png') }}"
                                alt="logo-sm-dark" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-sm-dark.png') }}"
                                alt="logo-dark" height="25">
                        </span>
                    </a>
                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-light.png') }}"
                                alt="logo-sm-light" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('admin_theme/marketplace/build/images/logo-sm-light.png') }}"
                                alt="logo-light" height="25">
                        </span>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
                    id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <!-- start page title -->
                <div class="page-title-box align-self-center d-none d-md-block">
                    <h4 class="page-title mb-0">@yield('page-title')</h4>
                </div>
                <!-- end page title -->
            </div>
            <div class="d-flex">
                

                <!-- File Icon Button -->
                <div class="d-inline-block me-5">
                    <button type="button" class="btn header-item waves-effect" data-bs-toggle="modal"
                        data-bs-target="#exampleModalLong" title="Recent Project" id="page-header-file-dropdown">
                        <i class="fa-regular fa-folder-closed icon_topbar_size"></i> <!-- File icon -->
                    </button>
                </div>
                <!-- Chat Button -->
               
                <!-- notification -->
                <div class="dropdown d-inline-block me-5">
                    <button type="button" class="btn header-item noti-icon waves-effect" title="Notification"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-bell"></i>
                        <span class="noti-dot"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> {{ __('Notifications') }}</h6>
                                </div>
                            </div>
                        </div>
                        @php($bids = App\Models\marketplace\Marketplace_bids::orderBy('id','desc')->get())
                        @foreach ($bids as $bidsItem)
                        @php($projectBid = App\Models\marketplace\Marketplace_project::where('id', $bidsItem->project_id)->first())
                        @php($bidClient = App\Models\User::where('id', $projectBid->user_id)->first())
                        @if($bidClient->id == Auth::user()->id)
                        @php($bidUser = App\Models\User::where('id', $bidsItem->user_id)->first())
                        <div data-simplebar style="max-height: 230px;">
                            <a href="{{route('bid.show',$bidsItem->id)}}" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="{{ asset('/images/'.$bidUser->image) }}"
                                        class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $bidUser->name}}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{Str::limit($bidsItem->proposal,30,'..more')  }}</p>
                                            <p class="mb-0"><i class="fa-regular fa-clock"></i>
                                                {{ $bidsItem->created_at->format('Y-m-d h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Wallet Button without Dropdown -->
                <div class="d-inline-block me-5">
                  <a href="{{route('wallet.show')}}"><button type="button" class="btn header-item waves-effect" data-bs-toggle="tooltip"
                        title="Wallet">
                        <i class="fa-solid fa-wallet icon_topbar_size"></i>
                    </button></a>
                </div>

                <!-- Price Plan Button (Visible only to 'user' role) -->
                <div class="d-inline-block me-5">
                    @auth
                        @if (auth()->user()->role === 'user')
                            <a href="#" class="btn mt-3" data-bs-toggle="tooltip"
                                title="Plan Price"><i class="fa-solid fa-cart-shopping me-1"></i>{{ __('Pricing') }}</a>
                        @endif
                    @endauth
                </div>

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ri-search-line"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="mb-3 m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                        class="ri-search-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Currency Dropdown -->
               
                <div class="dropdown me-5">
                    <button type="button" class="btn header-item waves-effect dropdown-toggle"
                    id="currencyDropdown" title="Currency" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><span class="currency-symbol"><i class="fa-solid fa-coins"></i> {{__('Currency')}}</span>
                   
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="currencyDropdown">
                        @php($currencies = DB::table('currencies')->get())
                        @foreach ($currencies as $currency)
                            <li><a class="dropdown-item"
                                    href="{{ route('currency.switch', $currency->code) }}">{{ $currency->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Language Dropdown -->
                <div class="dropdown d-none d-sm-inline-block me-5">
                    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                        id="Languagebutton" title="Language" aria-haspopup="true" aria-expanded="false">
                        <img class=""
                            src="{{ URL::asset('admin_theme/marketplace/build/images/flags/us.jpg') }}"
                            alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'ar') }}">Arabic</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'hi') }}">Hindi</a></li>
                    </div>
                </div>


                <div class="dropdown sidebar-user sidebar-user-info ms-5">
                    <button type="button" class="btn px-0 border-0" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                @if (isset(Auth::user()->image))
                                    <img src="{{ URL::asset('images/' . Auth::user()->image) }}"
                                        class=" header-profile-user rounded-circle" alt="">
                                @else
                                    <img src="{{ URL::asset('images/profile.jpg') }}"
                                        class=" header-profile-user rounded-circle" alt="">
                                @endif
                            </div>

                            <div class="flex-grow-1 ms-2 text-start">
                                <span class="ms-1 fw-bold fs-5">{{ Auth::user()->name }}</span>
                            </div>

                            <div class="flex-shrink-0">
                                <i class="mdi mdi-dots-vertical"></i>
                            </div>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('profile.show',Auth::user()->id) }}">
                            <i class="fa-solid fa-user me-1" style="color: #48494b;"></i> <span
                                class="align-middle">{{ __('Profile') }}</span></a>

                                <a class="dropdown-item" href="#" id="tone_setting">
                                    <span class="float-end"><i class="fa-solid fa-chevron-down tone_setting_downicon" style="color: #48494b"></i></span>
                                    <i class="fa-solid fa-gear me-1" style="color: #48494b;"></i>
                                    <span class="align-middle me-5" >{{ __('Settings') }}</span>
                                </a>
                                <div id="tone_box">
                                   <div class="mb-2" data-bs-toggle="modal" data-bs-target="#receivedTone"><i class="fa-brands fa-itunes-note" style="color: #48494b;"></i></i><span class="ms-2">Received Tone</span></div>
                                    <div class="mb-2" data-bs-toggle="modal" data-bs-target="#sendTone"><i class="fa-brands fa-itunes-note" style="color: #48494b;"></i></i><span class="ms-2">Send Tone</span></div>
                                    <div class="" data-bs-toggle="modal" data-bs-target="#projectTone"><i class="fa-brands fa-itunes-note" style="color: #48494b;"></i></i><span class="ms-2">Project Tone</span></div>
                                </div>

                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-circle-question me-1" style="color: #48494b;"></i> <span
                                class="align-middle">{{ __('Help') }}</span></a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('marketplace.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket me-1" style="color: #48494b;"></i> <span
                                class="align-middle">{{ __('Logout') }}</span></a>

                        <form id="logout-form" action="{{ route('marketplace.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



  <!-- Received Tone -->
  <div class="modal fade" id="receivedTone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">All Received Tones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ding">
                <label class="form-check-label" for="Ding">
                    Ding
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Chime">
                <label class="form-check-label" for="Chime">
                    Chime
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Beep">
                <label class="form-check-label" for="Beep">
                    Beep
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Alert">
                <label class="form-check-label" for="Alert">
                    Alert
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ringtone">
                <label class="form-check-label" for="Ringtone">
                    Ringtone
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Bell">
                <label class="form-check-label" for="Bell">
                    Bell
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ping">
                <label class="form-check-label" for="Ping">
                    Ping
                </label>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Send Tone -->
  <div class="modal fade" id="sendTone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">All Send Tones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ding">
                <label class="form-check-label" for="Ding">
                    Ding
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Chime">
                <label class="form-check-label" for="Chime">
                    Chime
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Beep">
                <label class="form-check-label" for="Beep">
                    Beep
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Alert">
                <label class="form-check-label" for="Alert">
                    Alert
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ringtone">
                <label class="form-check-label" for="Ringtone">
                    Ringtone
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Bell">
                <label class="form-check-label" for="Bell">
                    Bell
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ping">
                <label class="form-check-label" for="Ping">
                    Ping
                </label>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Project Tone -->
  <div class="modal fade" id="projectTone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">All Project Tones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ding">
                <label class="form-check-label" for="Ding">
                    Ding
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Chime">
                <label class="form-check-label" for="Chime">
                    Chime
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Beep">
                <label class="form-check-label" for="Beep">
                    Beep
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Alert">
                <label class="form-check-label" for="Alert">
                    Alert
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ringtone">
                <label class="form-check-label" for="Ringtone">
                    Ringtone
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Bell">
                <label class="form-check-label" for="Bell">
                    Bell
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="Ping">
                <label class="form-check-label" for="Ping">
                    Ping
                </label>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

<!--Recent/Save Project Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h5 class="modal-title file_backline viewmore_button" id="exampleModalLongProject"
                        onclick="toggleClass('project')">{{ __('Recent Project') }}</h5>&nbsp;&nbsp;&nbsp;
                    <h5 class="modal-title viewmore_button" id="exampleModalLongSave" onclick="toggleClass('save')">
                        {{ __('Save Project') }}</h5>
                </div>
                <button type="button" class="close project_file_close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="Project_File" id="projectFileDiv">
                    @php($project = App\Models\marketplace\Marketplace_project::orderBy('id', 'desc')->get())
                    <div class="row w-100%">
                        @foreach ($project as $rItem)                      
                        <div class="col-lg-12 mb-3">
                            <a href="{{ route('project-details', $rItem->id) }}">
                                <div class="d-flex project_boxshadow">
                                    <div class="projectfile_image_box ">
                                        <img src="{{ URL::asset('images/projectFile.jpg') }}" alt="Project">
                                    </div>
                                    <div class="w-100">
                                        <h5>{{$rItem->name}}
                                        </h5>
                                        <span>{{ Str::limit($rItem->description, 80, '...more') }}</span><br>
                                        @php($skills = App\Models\marketplace\Marketplace_project_skills::where('project_id', $rItem->id)->get())
                                        @foreach ($skills as $skill)
                                            <span>{{ Str::words($skill->name, 5, '...more') }}</span>
                                        @endforeach
                                             <div class="me-2">
                                            @php($symbols = DB::table('currencies')->where('code', $rItem->currency)->first())
                                            <span>{{ $symbols->symbol }}{{ $rItem->min_rate }} -
                                                {{ $rItem->max_rate }} {{ $rItem->currency }}</span>
                                                
                                            <span class="float-end">{{ $rItem->created_at->format('M j, Y') }}</span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="Save_Project" id="saveProjectDiv" style="display:none;">

                    @php($bookmarkProject = App\Models\marketplace\Marketplace_bookmarks::where('user_id',Auth::user()->id)->orderBy('id','desc')->get())
                    @if($bookmarkProject->isEmpty())
                    <div class="text-center">
                        <i class="fa-regular fa-hourglass fs-2"></i>
                        <h6>You haven’t bookmarked any projects yet! <br> Start exploring and save your favorite ones here.</h6>
                    </div>
                    @else
                    <div class="row">
                        @foreach ($bookmarkProject as $bitem)
                        @php($bProject = App\Models\marketplace\Marketplace_project::where('id',$bitem->project_id)->first())
                        <div class="col-lg-12 mb-3">
                            <a href="{{ route('bookmarked-project', $bProject->id) }}">
                                <div class="d-flex project_boxshadow">
                                    <div class="Save_Project_image_box ">
                                        <img src="{{ URL::asset('images/projectFile.jpg') }}" alt="Project">
                                    </div>
                                    <div class="w-100">
                                        <h5>{{ $bProject->name}}</h5>
                                        <span>{{ Str::limit($bProject->description, 80, '...more')}}</span><br>
                                        @php($pskills = App\Models\marketplace\Marketplace_project_skills::where('project_id', $bProject->id)->get())
                                        @foreach ($pskills as $bskill)
                                            <span>{{ Str::words($bskill->name, 5, '...more') }}</span>
                                        @endforeach
                                        <div class="project_price_time me-2">
                                            @php($symbols = DB::table('currencies')->where('code', $rItem->currency)->first())
                                            <span>{{ $symbols->symbol }}{{ $bProject->min_rate }} -
                                                {{ $bProject->max_rate }} {{ $bProject->currency }}</span>
                                            <span class="float-end">{{$bProject->created_at->format('M j, Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


