@extends('marketplace.layouts.master')
@section('title', 'Bids')
@section('page-title', 'Bids')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            <div class="container mt-5">
                <div class="bid_project_box ">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="d-flex">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    <div class="bid_user_profile">
                                        <img src="{{ asset('/images/' . $user->image) }}" alt="Project">
                                    </div>
                                </a>
                                <div class="bid_user_name_chat">
                                    <div class="fs-5">
                                        <h4>{{ $user->name }}</h4>
                                        <span>{{ $user->city }}</span>&nbsp;<span>{{ $user->country }}</span>
                                    </div>
                                    <a href="{{ route('chats.index', ['receiver_id' => $user->id]) }}"
                                        class="float-end"><span class="btn btn-primary">{{__('chat')}}</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3>{{ $bidproject->name }}</h3>
                            <p>{{ $bid->proposal }}
                            </p>
                        </div>
                        <div class="col-lg-3">
                            @php($symbols = DB::table('currencies')->where('code', $bid->currency)->first())
                            <h3><span style="color: green">{{ $symbols->symbol }}{{ $bid->bid_amount }}
                                    {{ $bid->currency }}</span></h3>
                            <h5> <span class="fs-4">{{ $bid->delivery_days }} {{__('days')}}</span></h5>
                            <div class="d-flex">
                                <a href="{{route('milestones.index',$bidproject->id)}}">
                                <button class="btn btn-primary me-2">{{ __('Milestones') }}</button>
                                </a>
                                <a href="{{ route('assignProject', ['pId' => $bidproject->id, 'uId' => $user->id]) }}">
                                    <button class="btn btn-primary">{{ __('Assign') }}</button>
                                </a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            <div class="all_bid_box" style="display: none">
                @foreach ($allBid as $allBiditem)
                @php($bidAllProject = App\Models\marketplace\Marketplace_project::where('id',$allBiditem->project_id)->first())
                @php($bidClient = App\Models\User::where('id', $bidAllProject->user_id)->first())
                @if($bidClient->id == Auth::user()->id && $bid->id != $allBiditem->id)
                @php($bidUser = App\Models\User::where('id', $allBiditem->user_id)->first())
                <div class="bid_project_box ">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="d-flex">
                                <a href="{{ route('profile.show', $bidUser->id) }}">
                                    <div class="bid_user_profile">
                                        <img src="{{ asset('/images/' . $bidUser->image) }}" alt="Project">
                                    </div>
                                </a>
                                <div class="bid_user_name_chat">
                                    <div class="fs-5">
                                        <h4>{{ $bidUser->name }}</h4>
                                        <span>{{ $bidUser->city }}</span>&nbsp;<span>{{ $bidUser->country }}</span>
                                    </div>
                                    <a href="{{ route('chats.index', ['receiver_id' => $bidUser->id]) }}"
                                        class="float-end"><span class="btn btn-primary">{{__('chat')}}</span></a>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3>{{ $bidAllProject->name }}</h3>
                            <p>{{ $allBiditem->proposal }}
                            </p>
                        </div>
                        <div class="col-lg-3">
                            @php($symbols = DB::table('currencies')->where('code', $allBiditem->currency)->first())
                            <h3><span style="color: green">{{ $symbols->symbol }}{{ $allBiditem->bid_amount }}
                                    {{ $allBiditem->currency }}</span></h3>
                            <h5> <span class="fs-4">{{ $allBiditem->delivery_days }} {{__('days')}}</span></h5>
                            <button class="btn btn-primary">{{__('Assign')}}</button>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            
            <div class="text-center">
                <span class="fs-3 view_all_bid_button">{{__('View All..')}}</span>
            </div>
        </div>
        </section>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.view_all_bid_button').on('click', function() {
                    $('.all_bid_box').show();
                    $('.view_all_bid_button').hide();
                });
            });
        </script>
    @endsection
