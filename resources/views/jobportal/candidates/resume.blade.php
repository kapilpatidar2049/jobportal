    <div class="section-card">
        @if (isset($resume))
            <h5>{{ $resume->name }}</h5>
            <small>{{ $resume->address }},{{ $resume->city }},{{ $resume->state }},{{ $resume->pincode }}</small><br>
            <small style="color:var(--text_dark_blue)">{{ $resume->email }}</small><br>
            <small class="font-small">{{ $resume->contry_code }}
                {{ $resume->phone }}</small><br>
            <p class="my-3">
                {!! $resume->summary !!}
            </p>
        @endif

        @if ($workExperience)
            <h4 class="text-muted">Work Experience</h4>
            <hr >
            @foreach ($workExperience as $experience)
                <div>
                    <h6>{{ $experience->job_title }}</h6>
                    <small>{{ $experience->company_name }} - {{ $experience->city }},
                        {{ $experience->state }}</small> <br>
                    <small>{{ $experience->job_type }} |
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M-Y') }} to
                        {{ $experience->present == 1 ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M-Y') }}
                    </small> <br>
                    <small>{!! $experience->description !!}</small>
                </div>
            @endforeach
        @endif
        @if (isset($educations))
            <h4 class="text-muted mt-3">Education</h4>
            <hr >
            @foreach ($educations as $education)
                <div>
                    <h6>{{ $education->degree }} in {{ $education->specialization }}</h6>
                    <small>{{ $education->insitution }}</small><br>
                    <small>{{ \Carbon\Carbon::parse($education->start_date)->format('M-Y') }}
                        to
                        {{ \Carbon\Carbon::parse($education->end_date)->format('M-Y') }}</small><br>
                    <small>Scored {{ $education->percentage }}</small>
                </div>
            @endforeach
        @endif
        <h4 class="text-muted mt-3">Skills</h4>
        <hr >
        <ul>
            @foreach ($skills as $skill)
                <li>
                    {{ $skill->skills }}
                </li>
            @endforeach
        </ul>
        @if (isset($certificates))
            <h4 class="text-muted mt-3">Certificate</h4>
            <hr >
            <ul class="">
                @foreach ($certificates as $certificate)
                    <li>
                        {{ $certificate->certificate }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
