@extends('jobportal.layouts.master')
@section('title', 'All Jobs')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('All Jobs') }}
            @endslot
            @slot('menu2')
                {{ __('All Jobs') }}
            @endslot
            @slot('button')
                <div class="col-md-6 col-lg-6">
                    <div class="widget-button">
                        <a href="{{ route('jobportal.job_create') }}" class="btn btn-primary" title="{{ __('Create New Job') }}">
                            <i class="fas fa-plus"></i> {{ __('Create New Job') }}
                        </a>
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <div class="text-center">
                        <button class="btn-primary btn me-0 job-filter active" data-status="open">Live Jobs</button>
                        <button class="btn-primary btn ms-0 job-filter" data-status="close">Close Jobs</button>
                    </div>
                    <div class="table-responsive">
                        <table class="tabel" id="example">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>
                                        {{ __('Job Title') }}
                                    </th>
                                    <th>
                                        {{ __('Candidates') }}
                                    </th>
                                    <th>
                                        {{ __('Sponsorship Status') }}
                                    </th>
                                    <th>
                                        {{ __('Date Posted') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    <th>
                                        {{ __('Job Status') }}
                                    </th>
                                    <th>
                                        {{ __('Action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="jobs">
                                @foreach ($jobs as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }} </td>
                                        <td>
                                            <strong>{{ $item->title }}</strong> <br>
                                            @if ($item->type == 'on-site')
                                                {{ $item->city }},{{ $item->state }}
                                            @else
                                                {{ __('Remote') }}
                                            @endif
                                            <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                @php($candidate = App\Models\Jobportal\JobportalCandidate::where('job_id', $item->id)->count())
                                                <a href="{{ $candidate >= 1 ? route('job.candidate', ['id' => $item->id]) : '#' }}"
                                                    @if($candidate < 1) class="disabled-link" style="pointer-events: none;" @endif>
                                                    <div class="candidate text-center">
                                                        <i class="fa-regular fa-user"></i>
                                                        {{ $candidate }}
                                                        <br>
                                                        {{ __('Candidates') }}
                                                    </div>
                                                </a> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="text-center">
                                                    <i class="fa-solid fa-plus"></i><br>
                                                    {{ __('Invite') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php($sponser = App\Models\Jobportal\JobSponser::where('job_id', $item->id)->first())
                                            @if ($sponser)
                                                Sponsored <br>
                                                <a href="{{ route('jobportal.job_sponser', $item->id) }}">{{ $sponser->budget }}({{ $sponser->currency }})
                                                    {{ $sponser->budget_type }}</a>
                                            @else
                                                Free post <br>
                                                <a
                                                    href="{{ route('jobportal.job_sponser', $item->id) }}">{{ __('Sponser Job') }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <p>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                            <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</p>
                                        </td>
                                        <td><a title="{{ $item->user['email'] }}"
                                                class="btn circle border rounded-circle">{{ substr($item->user['email'], 0, 2) }}</a>
                                        </td>
                                        <td>
                                            <select class="jobstatus form-control form-control-padding_10 form-select"
                                                data-id="{{ $item->id }}">
                                                <option value="pending" @if ($item->status == 'pending') selected @endif>
                                                    {{ __('Pending') }}</option>
                                                <option value="Open" @if ($item->status == 'Open') selected @endif>
                                                    {{ __('Open') }}</option>
                                                <option value="Paused" @if ($item->status == 'Paused') selected @endif>
                                                    {{ __('Paused') }}</option>
                                                <option value="Close" @if ($item->status == 'Close') selected @endif>
                                                    {{ __('Close') }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" type="button" title="{{ __('Action') }}"
                                                    id="action{{ $item->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="action{{ $item->id }}">
                                                    <li>
                                                        <a href="{{ route('jobportal.job_edit', $item->id) }}"
                                                            title="Edit Job" class="dropdown-item">{{ __('Edit') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('jobportal/js/createjob.js') }}"></script>
@endsection
