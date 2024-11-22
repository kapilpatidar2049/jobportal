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
                <h4>{{ $candidate->user->name }}</h4>
                <p style="color: var(--text_dark_blue)">{{ $candidate->user->email }}</p>
                <div class="d-flex my-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#interviewModal">
                        <i class="fa-solid fa-calendar"></i> Set up interview
                    </button>

                    <a href="{{ route('chat.user_id', $candidate->user->id) }}">
                        <button class="btn btn-secondary ms-3">
                            <i class="fa-solid fa-message"></i> Chat
                        </button>
                    </a>
                </div>
                <hr style="background-color: var(--bg_black)">

                @php($resume = App\Models\Jobportal\BuildResume::where('user_id', $candidate->user->id)->first())
                @if ($resume)
                <h5>Skills</h5>
                    @php($skills = App\Models\Jobportal\UserSkills::where('resume_id', $resume->user_id)->get())
                    <ul class="list-group">
                        @foreach ($skills as $skill)
                            <li>
                                {{ $skill->skills }}
                            </li>
                        @endforeach
                    </ul>
                    <hr style="background-color: var(--bg_black)">
                @endif

                @php($questions = App\Models\Jobportal\UserPrescreenAnswer::where('application_id', $candidate->id)->get())
                @if ($questions)
                    <h5>{{ __('Custom Screener Questions') }}</h5>

                    @foreach ($questions as $question)
                        <p>{{ $question->question }}</p>
                        @php($answer = App\Models\Jobportal\JobportalPrescreenQuestion::where('id', $question->question_id)->first())
                        @if ($answer->type == 'education')
                            @if ($question->answer == $answer->education)
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">Your Recuirment:
                                        {{ $answer->education }}</small>
                                </p>
                            @else
                                <p><small class="unmatched"> <i
                                            class="fa-solid fa-x"></i>{{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">Your Recuirment:
                                        {{ $answer->education }}</small>
                                </p>
                            @endif
                        @endif
                        @if ($answer->type == 'experience')
                            @if ($question->answer >= $answer->year)
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">Your Recuirment:
                                        {{ $answer->year }} years</small>
                                </p>
                            @else
                                <p><small class="unmatched"><i class="fa-solid fa-x"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">Your Recuirment:
                                        {{ $answer->education }}</small>
                                </p>
                            @endif
                        @endif

                        @if ($answer->type == 'interview')
                            <p>
                                <small class="matched"><i class="fa-solid fa-check"></i>
                                    {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                            </p>
                        @endif

                        @if ($answer->type == 'language')
                            @if ($question->answer == 'yes')
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @else
                                <p>
                                    <small class="unmatched"><i class="fa-solid fa-x"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @endif
                        @endif
                        @if ($answer->type == 'certificate')
                            @if ($question->answer == 'yes')
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @else
                                <p>
                                    <small class="unmatched"><i class="fa-solid fa-x"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @endif
                        @endif
                        @if ($answer->type == 'location')
                            @if ($question->answer == 'yes')
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @else
                                <p>
                                    <small class="unmatched"><i class="fa-solid fa-x"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @endif
                        @endif
                        @if ($answer->type == 'shift')
                            @if ($question->shifts == $answer->shift)
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->shifts }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:{{ $answer->shift }}
                                    </small>
                                </p>
                            @else
                                <p>
                                    <small class="unmatched"><i class="fa-solid fa-x"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:{{ $answer->shift }}
                                    </small>
                                </p>
                            @endif
                        @endif
                        @if ($answer->type == 'travel')
                            @if ($question->answer == 'yes')
                                <p><small class="matched"><i class="fa-solid fa-check"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @else
                                <p>
                                    <small class="unmatched"><i class="fa-solid fa-x"></i>
                                        {{ $question->answer }}</small>&nbsp;&nbsp;&nbsp;
                                    <small class="require text-muted">
                                        Your Recuirment:Yes
                                    </small>
                                </p>
                            @endif
                        @endif
                        @if ($answer->type == 'custom')
                            <p>
                                <small class="matched">{{ $question->answer }}</small>
                            </p>
                        @endif
                    @endforeach
                @endif
                <hr style="background-color: var(--bg_black)">
                <!-- Cv Section-->
                @if ($candidate->resume_type == 'upload')
                    @php($file = App\Models\Jobportal\JobportalResume::where('user_id', $candidate->user_id)->first())
                    <div class="d-flex justify-content-between my-3">
                        <h5>Resume</h5>
                        <a href="{{ url('jobportal/resume/' . $file->resume) }}" download target="_blank"
                            class="nav-link btn btn-primary text-white">
                            download
                        </a>
                    </div>
                    <div id="pdf-container" style="width: 100%; height: 100% ;">
                        <canvas id="pdf-canvas"></canvas>
                    </div>
                @else
                    <div class="d-flex justify-content-between my-3">
                        <h5>Resume</h5>
                        <a href="{{ route('download.resume', $resume->id) }}" class="nav-link btn btn-primary text-white">
                            download
                        </a>
                    </div>
                    <div class="resume">
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
                        @php($workExperience = App\Models\Jobportal\WorkExperience::where('resume_id', $resume->id)->get())
                        @if ($workExperience)
                            <h4 class="text-muted">Work Experience</h4>
                            <hr style="background-color: black">
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
                        @php($educations = App\Models\Jobportal\Education::where('resume_id', $resume->id)->get())
                        @if (isset($educations))
                            <h4 class="text-muted mt-3">Education</h4>
                            <hr style="background-color: black">
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
                        <hr style="background-color: black">
                        @php($skills = App\Models\Jobportal\UserSkills::where('resume_id', $resume->id)->get())
                        <ul>
                            @foreach ($skills as $skill)
                                <li>
                                    {{ $skill->skills }}
                                </li>
                            @endforeach
                        </ul>
                        @php($certificates = App\Models\Jobportal\Certification::where('resume_id', $resume->id)->get())
                        @if (isset($certificates))
                            <h4 class="text-muted mt-3">Certificate</h4>
                            <hr style="background-color: black">
                            <ul class="">
                                @foreach ($certificates as $certificate)
                                    <li>
                                        {{ $certificate->certificate }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="interviewModal" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="interviewModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="interviewdate">Date</label>
                    <input type="text" id="interviewdate" data-id="{{ $candidate->id }}" class="datepicker">
                    <label for="interviewtime">time</label>
                    <input type="time" id="interviewtime" data-id="{{ $candidate->id }}" class="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="setupinput" data-bs-dismiss="modal"  data-id="{{ $candidate->id }}" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            // Trigger the datepicker when the button is clicked
            $('#setupbtn').on('click', function() {
                $('#setupinput').datepicker('show'); // Show the datepicker
            });
            $('#setupinput').on('click', function() {
                var val = $('#interviewdate').val();
                var time = $('#interviewtime').val()
                var id = $(this).data('id');
                var csrf = $('meta[name="csrf-token"]').attr('content')
                $.ajax({
                    url: '/jobportal/setupinterview',
                    type: 'POST',
                    data: {
                        date: val,
                        id: id,
                        time:time
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrf
                    },
                    success: function(response) {
                        toastr.success('setup an interview Successfully');
                    }
                });
            });
        })
    </script>
    @if (isset($file))
        <script>
            const url = '{{ url('jobportal/resume/' . $file->resume) }}'; // Path to your local PDF

            const pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = '//cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                console.log("PDF loaded");

                // Get the first page
                pdf.getPage(1).then(function(page) {
                    const scale = 1.5;
                    const viewport = page.getViewport({
                        scale: scale
                    });
                    const canvas = document.getElementById('pdf-canvas');
                    const context = canvas.getContext('2d');

                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render the page to the canvas
                    page.render({
                        canvasContext: context,
                        viewport: viewport
                    });
                });
            });
        </script>
    @endif
@endsection
