@extends('jobportal.front.layouts.master')
@section('title', 'Resume')
@section('page-style')
    <style>
        label {
            display: block
        }
    </style>
@endsection
@section('main-container')
    <div class="cv-container">
        <h1>Add a CV for the employer</h1>
        <form action="{{ route('jobportal.resumeupload', $id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Upload a CV option -->
            @php($resume = App\Models\Jobportal\JobportalResume::where('user_id', Auth::guard('jobportal')->user()->id)->first())
            @if(isset($resume))
            <label for="upload">
                <div class="cv-option">
                    <h2>Upload a CV</h2>
                    <p>Accepted file types are PDF, DOCX, RTF or TXT.</p>
                    <iframe src="{{url('jobportal/resume/'.$resume->resume)}}" height="450">
                    </iframe>
                </div>
            </label>
            <input type="radio" id="upload" value="upload" name="resume_type" class="d-none">
            <input type="file" class="d-none" id="file" accept=".pdf" name="resume">
            @else
            <label for="upload">
                <div class="cv-option" id="resume">
                    <h2>Upload a CV</h2>
                    <p>Accepted file types are PDF, DOCX, RTF or TXT.</p>
                    <iframe id="pdf-preview" class="pdf-preview" src="" type="application/pdf"
                        style="display: none;"></iframe>
                </div>
            </label>
            <input type="radio" id="upload" value="upload" name="resume_type" class="d-none">
            <input type="file" class="d-none" id="file" accept=".pdf" name="resume">
            @endif
            <!-- Divider -->
            <div class="divider">or</div>

            <!-- Build an Indeed CV option -->
            <label for="build">
                <div class="cv-option">
                    <div class="badge">Recommended</div>
                    <h2>Build a CV</h2>
                    <p>We'll guide you through it; there are only a few steps.</p>
                </div>
            </label>
            <input type="radio" id="build" value="build" name="resume_type" class="d-none">
            <!-- Continue button -->
            <button class="continue-button">Continue</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#resume').on('click', function() {
                $('#file').click();
            });
            $('#file').on('change', function(event) {
                const file = event.target.files[0];
                if (file && file.type === 'application/pdf') {
                    const fileReader = new FileReader();

                    // When file is read, set the iframe source to the PDF data
                    fileReader.onload = function() {
                        $('#pdf-preview').attr('src', fileReader.result).show();
                    };

                    // Read the file as a data URL
                    fileReader.readAsDataURL(file);
                } else {
                    alert('Please upload a valid PDF file.');
                    $('#pdf-preview').hide();
                }
            });
        });
    </script>
@endsection
