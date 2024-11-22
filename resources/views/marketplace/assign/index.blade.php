@extends('marketplace.layouts.master')
@section('title', 'Assign')
@section('page-title', 'Assign')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section class="p-5">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="Container ">
                        <div class="assign_main_outer_box">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img src="{{ url('images/profile.jpg') }}" alt="" class="assign_image">
                                    <div class="ms-2">
                                        <p class="mb-3"><span class="fs-5 fw-bold">@govind22</span>&nbsp; <span>India</span></p>
                                        <button class="btn btn-primary">{{ __('Chat') }}</button>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-3">2000.00 INR</h4>
                                    <p>{{ __('Show billing information') }}</p>
                                </div>
                            </div>
                            <hr class="hr-color mb-4">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <h2>{{ __('Milestones Payment') }}</h2>
                                </div>
                                <div>
                                    <a href="{{ route('milestones.create', $projectId) }}">
                                    <button class="btn btn-primary">{{ __('Create Milestone') }}</button>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <h2>Created Invoice</h2>
                                <table class="example table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($milestones as $milestone)
                                        <tr>
                                                <td>{{$milestone->created_at->format('Y-m-d')}}</td>
                                                <td>{{$milestone->title }}</td>
                                                <td>{{ ucfirst($milestone->status) }}</td>
                                                <td>20000 INR</td>
                                                
                                            </tr>
                                            @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="assign_payment_box">
                        <div>
                            <h4>Payment Summary</h4>
                        </div>
                        <hr class="hr-color">
                        <div class="mb-3">
                            <span><b>Payment to date</b></span>
                            <h4>$20 USD</h4>
                        </div>
                        <div class="mb-3">
                            <span><b>Pending Milestones</b></span>
                            <h4>$20 USD</h4>
                        </div>
                        <div class="mb-3">
                            <span><b>Uninvoiced hours</b></span>
                            <h4>$0 USD</h4>
                        </div>
                        <div class="w-100">
                            <button class="w-100 btn btn-light" data-bs-toggle="modal" data-bs-target="#endProject"><b>End Project</b></button>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="endProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">End Project</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- <form action=""></form> --}}
            <p>This project has been completed, and no further action is required from the freelancer.</p>
            <h5> what are the terms to end this project ?</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="successful" id="successful">
                    <label class="form-check-label" for="successful">
                        I am happy with the successful completion of all project requirements.
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="failed" id="failed">
                    <label class="form-check-label" for="failed">
                        The freelancer failed to fulfill the requirements of my project.
                    </label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="{{route('rating.show')}}">
          <button type="button" class="btn btn-primary">End Project</button>
            </a>
        
        </div>
      </div>
    </div>
  </div>
    @endsection
    @section('scripts')

    @endsection
