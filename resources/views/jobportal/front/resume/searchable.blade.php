@extends('jobportal.front.layouts.master')
@section('title', 'Searchable')
@section('main-container')
    <div class="d-flex justify-content-evenly">
        <form action="{{ route('update.searchabe') }}" method="post">
            @csrf
            <div class="option-container">
                <label class="option active">
                    <input type="radio" name="searchable" value="1" checked class="d-none searchable">
                    <div class="option-icon"><i class="fa-regular fa-eye"></i></div>
                    <div>
                        <div>
                            <span class="option-title">Searchable </span>
                        </div>
                        <p class="option-description">
                            Employers can find your resume in a search through Our PlatForm, according to our terms. We
                            attempt
                            to hide identifiable details until you respond to employers.
                        </p>
                    </div>
                </label>

                <label class="option ">
                    <input type="radio" name="searchable" value="0" class="d-none searchable">
                    <div class="option-icon"><i class="fa-solid fa-eye-slash"></i></div>
                    <div>
                        <span class="option-title">Not searchable on Our PlatForm</span>
                        <p class="option-description">
                            Employers can’t find your resume in searches through Our PlatForm or contact you about jobs.
                            However, employers you’ve been in contact with are still able to contact you.
                        </p>
                    </div>
                </label>

            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.searchable').on('change', function() {
                var checked = $(this).is(':checked');
                if (checked) {
                    $('label').removeClass('active');
                    $(this).closest('label').addClass('active');
                    // console.log($(this).closest('label').html());

                }
            });
        });
    </script>
@endsection
