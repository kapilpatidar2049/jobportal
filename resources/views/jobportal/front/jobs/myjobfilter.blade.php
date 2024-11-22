@if(count($candidates) > 0)
@foreach ($candidates as $candidate)
    <div class="job-card d-flex">
        <a href="{{ route('jobportal.job.view', base64_encode($candidate->job->id)) }}"
            class="nav-link">
            <div class="content">
                <small class="status"
                    @if ($candidate->status) style="color:var(--text_dark_blue)" @else style="color:var(--text_dark_green)" @endif>
                    {{ $candidate->status }}
                </small>
                <h6>{{ $candidate->job->title }}</h6>
                @php($company = App\Models\Jobportal\CompnyDetail::where('user_id', $candidate->job->user_id)->first())
                <p class="mb-1">{{ $company->company_name }}</p>
                @if ($candidate->status == 'interview')
                    @php($interview = App\Models\Jobportal\JobportalCandidate::where('user_id', $candidate->user_id)->where('job_id', $candidate->job_id)->first())
                    @if($interview)
                    <p class="interview-time"><small >The interview is scheduled for {{\Carbon\Carbon::parse($interview->interview_date)->format('d-M-Y') }} at {{$interview->interview_time }}  </small></p>
                    @endif
                @endif
                <p class="text-muted mb-0">
                    {{ \Carbon\Carbon::parse($candidate->created_at)->diffForHumans() }}
                </p>
            </div>
        </a>
        <div class="dropdown">
            <button type="button" class="btn btn-outline-primary btn-sm" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Update status</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item myjobstatus" data-id="{{$candidate->id}}" data-status="interview" >Interview</a></li>
              <li><a class="dropdown-item myjobstatus" data-id="{{$candidate->id}}" data-status="hired" >Hired</a></li>
              <li><a class="dropdown-item myjobstatus" data-id="{{$candidate->id}}" data-status="interviewing" >Interviewing</a></li>
            </ul>
          </div>
    </div>
@endforeach
@else
<div class="d-flex justify-content-center">
<div class="error">
    <h6>No Job Yet</h6>
    <a href="{{route('jobportal.frontjob')}}" class="btn btn-primary">
        Search Jobs
    </a>
</div>
</div>
@endif