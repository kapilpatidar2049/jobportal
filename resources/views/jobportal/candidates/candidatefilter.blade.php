@if (count($candidates) > 0)
    @foreach ($candidates as $candidate)
        <div class="col-lg-4">
            <div class="candidate-box text-center">
                @if (!$candidate->user->image)
                    <img src="{{ Avatar::create($candidate->user->email) }}" class="img-fluid" id="profile" width="50px"
                        alt="{{ $candidate->user->email }}">
                @else
                    <img src="{{ url('jobportal/user/' . $candidate->user->image) }}" alt="{{ $candidate->user->email }}"
                        id="profile" width="50px" class="img-fluid form-control-padding_10">
                @endif
                <h6 class="mt-3">{{ $candidate->user->name }}</h6>
                <p>{{ $candidate->user->email }}</p>
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
                    <div class="icon-box">
                        <a href="{{ route('chat.user_id', $candidate->user->id) }}"><i
                                class="fa-solid fa-message"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center">
        <h6>No data Found</h6>
    </div>
@endif
