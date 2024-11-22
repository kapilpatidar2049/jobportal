@if(count($jobs)>0)
@foreach ($jobs as $item)
<div class="col-lg-4 job_box">
    <div class="float-end">
        <div class="dropdown">
            <a class="btn  dropdown-toggle" type="button" id="profile"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="profile">
                <li>
                    <a class="dropdown-item save-job" data-jobid="{{$item->id}}" type="button"  title="{{ __('Save Job') }}">
                        <i class="fa-regular fa-bookmark"></i> {{ __('Save Job') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item notintrested" data-jobid="{{ $item->id }}" title="{{ __('Not Interested') }}">
                        <i class="fa-solid fa-ban"></i> {{ __('Not Interested') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <a href="{{ route('jobportal.job.view', base64_encode($item->id)) }}" class="nav-link2 text-dark">
        <h5 class="job_title">{{ $item->title }}</h5>
        @php($company = App\Models\Jobportal\CompnyDetail::where('user_id', $item->user_id)->first())
        <p>{{ $company->company_name }}</p>
        @if ($item->type == 'on-site')
            {{ $item->city }}, {{ $item->state }}
        @else
            {{ __('Remote') }}
        @endif
        <div class="mt-2 d-flex">
            @php($i = 0)
            @foreach ($item->job_type as $job_type)
                @if ($i == 1)
                    <span class="job_type_front">{{ $job_type }}</span>
                @endif
                @php($i++)
            @endforeach
            <span class="job_type_front">+{{ $i - 1 }} More</span>
        </div>
        <div class="mt-2">
            <p>{!! \Illuminate\Support\Str::words($item->job_description, 10, '...') !!}</p>
            <p>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
        </div>
    </a>
</div>
@endforeach
@else
<h6 class="text-center">No Jobs Available For this Filter</h6>
@endif