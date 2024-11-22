@extends('jobportal.layouts.master')
@section('title', 'Candidates')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Candidates') }}
            @endslot
            @slot('menu2')
                {{ __('Candidates') }}
            @endslot
        @endcomponent
    </div>
    <div class="row">
        <div class="col-12">
            <div class="client-area">
                @if (isset($job))
                    <h4 class="mb-5">{{ __('Candidate For Job : ') }} {{ $job->title }}</h4>
                    <input type="hidden" id="job_id" value="{{ $job->id }}">
                @endif
                <div class="text-center my-4">
                    <button class="btn btn-primary candidate-filter active" data-filter="active">Active</button>
                    <button class="btn btn-primary candidate-filter" data-filter="shortlist">shortlist</button>
                    <button class="btn btn-primary candidate-filter" data-filter="awaiting review">Awaiting review</button>
                    <button class="btn btn-primary candidate-filter" data-filter="reviewed">Reviewed</button>
                    <button class="btn btn-primary candidate-filter" data-filter="rejected">Rejected</button>
                    <button class="btn btn-primary candidate-filter" data-filter="hired">Hired</button>
                </div>
                <div class="row" id="candidates">
                    @foreach ($candidates as $candidate)
                        <div class="col-lg-4">
                            <div class="candidate-box text-center">
                                @if (!$candidate->user->image)
                                    <img src="{{ Avatar::create($candidate->user->email) }}" class="img-fluid"
                                        id="profile" width="50px" alt="{{ $candidate->user->email }}">
                                @else
                                    <img src="{{ url('jobportal/user/' . $candidate->user->image) }}"
                                        alt="{{ $candidate->user->email }}" id="profile" width="50px"
                                        class="img-fluid form-control-padding_10">
                                @endif
                                <h6 class="mt-3">{{ $candidate->user->name }}</h6>
                                <a href="{{ route('candidate.profile', $candidate->id) }}" class="nav-link"
                                    title="{{ $candidate->user->name }}">
                                    <p>{{ $candidate->user->email }}</p>
                                </a>
                                <div class="d-flex justify-content-around">
                                    <div class="icon-box intrested" data-intrested="1" data-id="{{ $candidate->id }}">
                                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                        <svg width="20px" height="20px" viewBox="0 0 48 48" version="1"
                                            xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48">
                                            <polygon fill="var(--text_dark_blue)"
                                                points="40.6,12.1 17,35.7 7.4,26.1 4.6,29 17,41.3 43.4,14.9" />
                                        </svg>
                                    </div>
                                    <div class="icon-box intrested" data-intrested="0" data-id="{{ $candidate->id }}">
                                        <i class="fa-solid fa-x" style="color: var(--text_red)"></i>
                                    </div>
                                    <div class="icon-box intrested">
                                        <a href="{{ route('chat.user_id', $candidate->user->id) }}"><i
                                                class="fa-solid fa-message"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.candidate-filter').on('click', function() {
                $('.candidate-filter').removeClass('active');
                $(this).addClass('active');
                var filter = $(this).data('filter');
                var id = $('#job_id').val() ?? '';
                $.ajax({
                    url: '/jobportal/candidate/filter',
                    type: 'post',
                    data: {
                        id: id,
                        filter: filter
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#candidates').html(response);
                    }
                });
            });

            $(document).on('click', '.intrested', function() {
                $('.candidate-filter').removeClass('active');
                var intrested = $(this).data('intrested');
                var id = $(this).data('id');
                $.ajax({
                    url: '/jobportal/candidate/shortlisted',
                    type: 'post',
                    data: {
                        id: id,
                        intrested: intrested
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.shortlisted == true) {
                            toastr.success('candidate shortlisted successfully');
                        } else {
                            toastr.error('candidate rejected');
                        }
                    }
                });
            });
        });
    </script>
@endsection
