@extends('jobportal.layouts.master')
@section('title', 'Billing & Invoices')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Billing & Invoices') }}
            @endslot
            @slot('menu2')
                {{ __('Billing & Invoices') }}
            @endslot
        @endcomponent
    </div>
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <div class="tab-container">
                        <!-- Tab buttons -->
                        <div class="tabs">
                            <button class="tab-button active" onclick="openTab(event, 'tab1')">Billing summary</button>
                            <button class="tab-button" onclick="openTab(event, 'tab2')">Billing information</button>
                        </div>

                        <!-- Tab content -->
                        <div class="tab-content" id="tab1">
                            <div class="duepayment ">
                                <h5>{{ __('Payment Due') }}</h5>
                                <p>{{ __('Your payment method will be charged monthly and when the amount due reaches the charge threshold below.') }}
                                </p>
                                <span class="text-large">
                                    No payments due
                                </span>
                            </div>
                            <div class="duepayment ">
                                <h4>Transaction history</h4>
                                <div class="tabs">
                                    <button class="tab-button active" onclick="openTab2(event, 'all')">All</button>
                                    <button class="tab-button" onclick="openTab2(event, 'payment')">Payments</button>
                                    <button class="tab-button" onclick="openTab2(event, 'invoices')">Invoices</button>
                                </div>
                                <p>No transactions</p>
                            </div>
                        </div>
                        <div class="tab-content" id="tab2" style="display:none;">
                            <div class="duepayment ">
                                <div class="row">
                                    <div class="col-10">
                                        <h4>Billing contact</h4>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="duepayment btn p-2" data-bs-toggle="modal"
                                            data-bs-target="#editBillingContactModal">
                                            {{ __('Edit') }}
                                        </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Name') }}</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Phone') }}</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Comapany') }}</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Fax') }}</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Email') }}</h6>
                                        <p>{{ Auth::guard('jobportal')->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="duepayment ">
                                <div class="row">
                                    <div class="col-10">
                                        <h4>Billing Information</h4>
                                    </div>
                                    <div class="col-2">
                                        <button class="duepayment btn p-2" data-bs-toggle="modal"
                                            data-bs-target="#editBillinginfoModal">{{ __('Edit') }}</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Country') }}</h6>
                                        <p>IN</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Currency') }}</h6>
                                        ({{ Session::get('changed_currency_symbol') }}){{ Session::get('changed_currency') }}
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>{{ __('Billing Address') }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="duepayment ">
                                <h4>Payment Method</h4>
                                <p>
                                    none
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Billing Contact Model -->
    <div class="modal fade" id="editBillingContactModal" tabindex="-1" aria-labelledby="editBillingContactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBillingContactModalLabel">Edit Billing Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="billingContactForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" placeholder="Enter company">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label for="fax" class="form-label">Fax</label>
                            <input type="text" class="form-control" id="fax" placeholder="Enter fax number">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Billing Information Model -->
    <div class="modal fade" id="editBillinginfoModal" tabindex="-1" aria-labelledby="editBillinginfoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBillinginfoModalLabel">Edit Billing Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="billingContactForm">
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-control form-control-padding_10" id="country" name="country_code">
                                @php($countries = App\Models\Allcountry::all())
                                @foreach ($countries as $item)
                                    <option value="{{ $item->iso }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <input type="currency" class="form-control" id="currency" placeholder="Enter currency">
                        </div>
                        {{-- <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
                    </div>
                    <div class="mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" class="form-control" id="fax" placeholder="Enter fax number">
                    </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function openTab(event, tabId) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach((content) => {
                content.style.display = "none";
            });

            // Remove 'active' class from all buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach((button) => {
                button.classList.remove("active");
            });

            // Show the selected tab content and add 'active' class to the clicked button
            document.getElementById(tabId).style.display = "block";
            event.currentTarget.classList.add("active");
        }

        // Default: Open the first tab on page load
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("tab1").style.display = "block";
        });
    </script>
@endsection
