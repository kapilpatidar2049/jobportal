@extends('marketplace.layouts.master')
@section('title', 'Proposal')
@section('page-title', 'Proposal')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            <div class="container mt-5">
                <div>
                    @foreach ($allBid as $allBiditem)
                        @php($bidAllProject = App\Models\marketplace\Marketplace_project::where('id', $allBiditem->project_id)->first())
                        @php($bidClient = App\Models\User::where('id', $bidAllProject->user_id)->first())
                        @php($bidUser = App\Models\User::where('id', $allBiditem->user_id)->first())
                        <div class="bid_project_box ">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="d-flex">
                                        <a href="{{ route('profile.show', $bidClient->id) }}">
                                            <div class="bid_user_profile">
                                                <img src="{{ asset('/images/' . $bidClient->image) }}" alt="Project">
                                            </div>
                                        </a>
                                        <div class="bid_user_name_chat">
                                            <div class="fs-5">
                                                <h4>{{ $bidClient->name }}</h4>
                                                <span>{{ $bidClient->city }}</span>&nbsp;<span>{{ $bidClient->country }}</span>
                                            </div>
                                            <div class="d-flex">
                                                <a href="{{ route('chats.index', ['receiver_id' => $bidClient->id]) }}"
                                                    class="float-end"><span
                                                        class="btn btn-primary">{{ __('chat') }}</span></a>
                                                        
                                                @if(!$bidAllProject->assigned_user_id)
                                                <button class="btn btn-light ms-2" data-bs-toggle="modal"
                                                    data-bs-target="#userbidedit{{ $allBiditem->id }}">Edit</button>
                                                @else
                                                    <button class="btn btn-light" disabled>Edit</button>
                                                @endif
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="userbidedit{{ $allBiditem->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bids
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="{{route('bid.edit',$allBiditem->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-5">
                                                                    <span><b>{{ __('Bid Amount') }}</b></span>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            aria-label="Amount (to the nearest dollar)"
                                                                            name="bid_amount" value="{{$allBiditem->bid_amount}}"
                                                                            placeholder="{{ __('140.00') }}">
                                                                        <div>
                                                                            <span class=""><select name="currency"
                                                                                    id="currency" class="form-select">
                                                                                    <option value="{{$allBiditem->currency}}" selected>
                                                                                        {{$allBiditem->currency}}</option>
                                                                                    <option value="USD">
                                                                                        {{ __('USD') }}</option>
                                                                                    <option value="INR">
                                                                                        {{ __('INR') }}</option>
                                                                                    <option value="EUR">
                                                                                        {{ __('EUR') }}</option>
                                                                                    <option value="AUD">
                                                                                        {{ __('AUD') }}</option>
                                                                                    <option value="AUD">
                                                                                        {{ __('NZD') }}</option>
                                                                                    </option>
                                                                                </select></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <span><b>{{ __('This project will be delivered in ') }}</b></span>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            aria-label="Amount (to the nearest dollar)"
                                                                            name="delivery_days" value="{{$allBiditem->delivery_days}}"
                                                                            placeholder="{{ __('5') }}">
                                                                        <span
                                                                            class="input-group-text">{{ __('Days') }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlTextarea1"
                                                                            class="">
                                                                            <span><b>{{ __('Describe your proposal (maximum 200 characters)') }}</b></span>
                                                                            
                                                                        </label>
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="proposal"
                                                                            placeholder="What makes you the best candidate for this project?" maxlength="200">{{$allBiditem->proposal}}</textarea>
                                                                        <small id="charCount">0/200 characters</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
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
                                    <h5> <span class="fs-4">{{ $allBiditem->delivery_days }}
                                            {{ __('days') }}</span></h5>

                                </div>
                            </div>
                        </div>
                    @endforeach
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
    @endsection
