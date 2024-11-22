@extends('marketplace.layouts.master')
@section('title', 'Review')
@section('page-title', 'Review')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <section>
                <div class="Container mt-3">
                    <div class="assign_main_outer_box">
                        <div class="d-flex justify-content-between align-tiems-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ url('images/profile.jpg') }}" alt="" class="assign_image">
                                <p class="ms-2"><span class="fs-3 fw-bold">@govind22</span></p>
                            </div>
                        </div>
                        <hr class="hr-color mb-4">
                        <div class="form-check mb-3 mx-3">
                            <input class="form-check-input fs-3" type="checkbox" value="yes" id="delivered-time">
                            <label class="form-check-label mt-2" for="delivered-time">
                              <b>Delivered on time?</b>
                            </label>
                        </div>
                        <div class="form-check mb-2 mx-3">
                            <input class="form-check-input fs-3" type="checkbox" value="yes" id="delivered-budget">
                            <label class="form-check-label mt-2" for="delivered-budget">
                                <b>Delivered within budget?</b>
                            </label>
                        </div>
                        <div class="my-3">
                            <h1 class="mb-2">Rate Govind</h1>
                            <div class="rating">
                                <input type="radio" id="star5" name="rating" value="5" />
                                <label for="star5" title="5 stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="4 stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="3 stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="2 stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1" title="1 star">★</label>
                            </div>
                        </div>
                        <hr class="hr-color mb-4">
                        <div>
                            <div class="form-group">
                                <label for="reviewClient" class="">
                                    <span><b>{{ __('Review (maximum 300 characters)') }}</b></span>
                                    
                                </label>
                                <textarea class="form-control" id="reviewClient" rows="4" name="proposal"
                                    placeholder="Wright your review here" maxlength="300"></textarea>
                                <small id="charCount">0/300 characters</small>
                            </div>
                        </div>
                        <div class="mt-2 text-end">
                            <button class="btn btn-primary">Send Feedback</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-2"></div>
    </div>
    @endsection
    @section('scripts')
    <script>
        const textarea = document.getElementById('reviewClient');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function() {
            const currentLength = textarea.value.length;
            charCount.textContent = `${currentLength}/300 characters`;
        });
    </script>
    @endsection
