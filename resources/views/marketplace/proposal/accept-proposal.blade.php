@extends('marketplace.layouts.master')
@section('title', 'Accept Proposal')
@section('page-title', 'Accept Proposal')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
    <section class="px-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="accept_top_outer_box">
                       <div class="mb-2"><i class="fa-solid fa-circle-exclamation"></i>&nbsp; <b>Congratulations! You've been awarded the project!</b></div>
                       <div class="px-4"><p>If you accept this project. you Will be charged a project fee in accordance With the Fees and Charges, Respond quickly,
                        otherwise client might close the project or offer it to someone else.</p>
                        <div class="d-flex mb-2">
                            <div class="me-3">
                                <span>Your Bid Amount</span>
                                <h4>$20.00 USD</h4></div>
                            <div><i class="fa-solid fa-clock"></i> 1 Day, 7 Hours Left To Accept </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                @php($bankDetails = App\Models\marketplace\Bank_account::where('user_id',Auth::user()->id)->first())
                                @if(!$bankDetails)
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBankAccountModal">Accept</button>&nbsp;   
                                @else
                                <button class="btn btn-primary" disabled>Accept</button>&nbsp;
                                @endif
                                <button class="btn btn-secondary">Reject</button></div>
                            <div><button class="btn btn-secondary">Request Milestones</button></div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="accept_client_outer_box">
                        <div class="d-flex">
                            <img src="{{ url('images/profile.jpg') }}" alt="" class="assign_image">
                            <div class="ms-2">
                                <p class="mb-3"><span class="fs-5 fw-bold">@govind22</span>&nbsp; <span>India</span></p>
                                <button class="btn btn-primary">{{ __('Chat') }}</button>
                            </div>
                        </div>
                        <hr class="hr-color">
                        <h4>Payment Summary &nbsp;<i class="fa-solid fa-circle-question"></i></h4>
                        <div class="row my-3">
                            <div class="col-lg-4">
                                <span><b>Requested</b></span>
                                <p>$20.00 USD</p>
                            </div>
                            <div class="col-lg-4">
                                <span><b>In Progress</b></span>
                                <p>$20.00 USD</p>
                            </div>
                            <div class="col-lg-4">
                                <span><b>Released</b></span>
                                <p>$00.00 USD</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="accept_client_outer_box">
                        <div class="mb-5"><h2>Milestone Payments</h2></div>
                    <div>
                        <h4>Created Milestone</h4>
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
                                <tr>
                                        <td>14 Feb 2022</td>
                                        <td>First Project</td>
                                        <td>Completed</td>
                                        <td>20000 INR</td>
                                       
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add Bank Account Modal -->
<div class="modal fade" id="addBankAccountModal" tabindex="-1" aria-labelledby="addBankAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addBankAccountModalLabel">Add Bank Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="addBankAccountForm" action="{{ route('bank_accounts.store') }}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="account_holder_name" class="form-label">Account Holder Name</label>
                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Name" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="number" class="form-control" id="account_number" name="account_number" placeholder="Account Number" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name"  placeholder="Bank Name" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code"  placeholder="IFSC Code">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="routing_number" class="form-label">Routing Number</label>
                        <input type="text" class="form-control" id="routing_number" name="routing_number" placeholder="Routing Number">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="swift_code" class="form-label">SWIFT Code</label>
                        <input type="text" class="form-control" id="swift_code" name="swift_code" placeholder="SWIFT Code">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-control" id="currency" name="currency" required>
                            <option value="USD">USD</option>
                            <option value="INR">INR</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                        </select>
                    </div>
                </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addBankAccountForm">Save</button>
            
            </div>
        </div>
    </div>
</div>
    @endsection
    @section('scripts')
        
    @endsection