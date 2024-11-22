@extends('marketplace.layouts.master')
@section('title', 'Wallet')
@section('page-title', 'Wallet')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            <div class="mb-4 mt-2">
                <h4>Balance: <span>₹</span>00.00<span> INR</span></h4>
            </div>
            <div class="wallet_top_button_box">
                <span class="Add_button wallet_button_border" id="Add_button">Add Funds</span>
                <span class="Withdraw_button" id="Withdraw_button">Withdraw Money</span>
                <span class="Transaction_button" id="Transaction_button">Transaction History</span>
            </div>
            <div>
                <div class="" id="Add">Add Payment Gateway</div>
                <div class="" id="Withdraw" style="display: none">
                    <div class="container transaction_outer_box">
                        <h1 class="my-4">Withdraw Money</h1>
                        <div class="p-5 transaction_inner_box">
                            <table class="example table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="" id="Transaction" style="display: none">
                    <div class="container transaction_outer_box">
                        <h1 class="my-4">Transaction History</h1>
                        <div class="transaction_history_top_button">
                            <span class="btn lightWalletButton btn-light all_transaction_button"
                                id="all_transaction_button">All Transaction</span>
                            <span class="btn btn-light invoice_button" id="invoice_button">Invoice</span>
                            <span class="btn btn-light milestones_button" id="milestones_button">Milestones</span>
                            <span class="btn btn-light pending_button" id="pending_button">Pending Funds</span>
                        </div>
                        <div class="p-5 transaction_inner_box">
                            <div id="all_transaction">
                                <div class="float-end mb-3">
                                    <label for="Currency" class="form-group-lable mb-2">{{ __('Currency') }}</label>
                                    <select name="currency" id="currency" class="form-select">
                                        <option value="USD" selected>{{ __('USD') }}</option>
                                        <option value="INR">{{ __('INR') }}</option>
                                        <option value="EUR">{{ __('EUR') }}</option>
                                        <option value="AUD">{{ __('AUD') }}</option>
                                        <option value="AUD">{{ __('NZD') }}</option>
                                        </option>
                                    </select>
                                </div>
                                <table class="example table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Invoice</th>
                                            <th>Amount</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div id="invoice" style="display: none">
                                <div>
                                    <div class="float-end mb-4">
                                        <span class="btn btn-light lightWalletButton wallet_invoice_incoming_btn"
                                            id="wallet_invoice_incoming_btn">Incoming</span><span
                                            class="btn btn-light wallet_invoice_outgoing_btn"
                                            id="wallet_invoice_outgoing_btn">Outgoing</span>
                                    </div>
                                    <div id="wallet_invoice_incoming">
                                        <table class="example table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Freelancer</th>
                                                    <th>Project Name</th>
                                                    <th>Invoice Ref</th>
                                                    <th>Invoice Amount</th>
                                                    <th>Unpaid Amount</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="wallet_invoice_outgoing" style="display: none">
                                        <table class="example table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Employer</th>
                                                    <th>Project Name</th>
                                                    <th>Invoice Ref</th>
                                                    <th>Invoice Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="milestones" style="display: none">
                                <div>
                                    <div class="float-end mb-4">
                                        <span class="btn btn-light lightWalletButton wallet_milestones_incoming_btn"
                                            id="wallet_milestones_incoming_btn">Incoming</span><span
                                            class="btn btn-light wallet_milestones_outgoing_btn"
                                            id="wallet_milestones_outgoing_btn">Outgoing</span>
                                    </div>
                                    <div id="wallet_milestones_incoming">
                                        <table class="example table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Client</th>
                                                    <th>Project Name</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="wallet_milestones_outgoing" style="display: none">
                                        <table class="example table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Freelancer</th>
                                                    <th>Project Name</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="pending" style="display: none">
                                <div class="float-end mb-3">
                                    <label for="Currency" class="form-group-lable mb-2">{{ __('Currency') }}</label>
                                    <select name="currency" id="currency" class="form-select">
                                        <option value="USD" selected>{{ __('USD') }}</option>
                                        <option value="INR">{{ __('INR') }}</option>
                                        <option value="EUR">{{ __('EUR') }}</option>
                                        <option value="AUD">{{ __('AUD') }}</option>
                                        <option value="AUD">{{ __('NZD') }}</option>
                                        </option>
                                    </select>
                                </div>
                                <table class="example table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Reason</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                            <th>Expected time of resolution</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#Transaction_button').on('click', function() {
                    $('#Transaction').show();
                    $('#Add').hide();
                    $('#Withdraw').hide();
                    $('.Transaction_button').addClass('wallet_button_border');
                    $('.Add_button').removeClass('wallet_button_border');
                    $('.Withdraw_button').removeClass('wallet_button_border');
                });

                $('#Add_button').on('click', function() {
                    $('#Transaction').hide();
                    $('#Add').show();
                    $('#Withdraw').hide();
                    $('.Transaction_button').removeClass('wallet_button_border');
                    $('.Add_button').addClass('wallet_button_border');
                    $('.Withdraw_button').removeClass('wallet_button_border');
                });

                $('#Withdraw_button').on('click', function() {
                    $('#Transaction').hide();
                    $('#Add').hide();
                    $('#Withdraw').show();
                    $('.Transaction_button').removeClass('wallet_button_border');
                    $('.Add_button').removeClass('wallet_button_border');
                    $('.Withdraw_button').addClass('wallet_button_border');
                });

            });
        </script>
        <script>
            $(document).ready(function() {
                $('#all_transaction_button').on('click', function() {
                    $('#all_transaction').show();
                    $('#invoice').hide();
                    $('#milestones').hide();
                    $('#pending').hide();
                    $('.all_transaction_button').addClass('lightWalletButton');
                    $('.invoice_button').removeClass('lightWalletButton');
                    $('.milestones_button').removeClass('lightWalletButton');
                    $('.pending_button').removeClass('lightWalletButton');
                });

                $('#invoice_button').on('click', function() {
                    $('#all_transaction').hide();
                    $('#invoice').show();
                    $('#milestones').hide();
                    $('#pending').hide();
                    $('.all_transaction_button').removeClass('lightWalletButton');
                    $('.invoice_button').addClass('lightWalletButton');
                    $('.milestones_button').removeClass('lightWalletButton');
                    $('.pending_button').removeClass('lightWalletButton');
                });

                $('#milestones_button').on('click', function() {
                    $('#all_transaction').hide();
                    $('#invoice').hide();
                    $('#milestones').show();
                    $('#pending').hide();
                    $('.all_transaction_button').removeClass('lightWalletButton');
                    $('.invoice_button').removeClass('lightWalletButton');
                    $('.milestones_button').addClass('lightWalletButton');
                    $('.pending_button').removeClass('lightWalletButton');
                });

                $('#pending_button').on('click', function() {
                    $('#all_transaction').hide();
                    $('#invoice').hide();
                    $('#milestones').hide();
                    $('#pending').show();
                    $('.all_transaction_button').removeClass('lightWalletButton');
                    $('.invoice_button').removeClass('lightWalletButton');
                    $('.milestones_button').removeClass('lightWalletButton');
                    $('.pending_button').addClass('lightWalletButton');
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#wallet_invoice_incoming_btn').on('click', function() {
                    $('#wallet_invoice_incoming').show();
                    $('#wallet_invoice_outgoing').hide();

                    $('.wallet_invoice_incoming_btn').addClass('lightWalletButton');
                    $('.wallet_invoice_outgoing_btn').removeClass('lightWalletButton');
                });

                $('#wallet_invoice_outgoing_btn').on('click', function() {
                    $('#wallet_invoice_incoming').hide();
                    $('#wallet_invoice_outgoing').show();

                    $('.wallet_invoice_incoming_btn').removeClass('lightWalletButton');
                    $('.wallet_invoice_outgoing_btn').addClass('lightWalletButton');

                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#wallet_milestones_incoming_btn').on('click', function() {
                    $('#wallet_milestones_incoming').show();
                    $('#wallet_milestones_outgoing').hide();

                    $('.wallet_milestones_incoming_btn').addClass('lightWalletButton');
                    $('.wallet_milestones_outgoing_btn').removeClass('lightWalletButton');
                });

                $('#wallet_milestones_outgoing_btn').on('click', function() {
                    $('#wallet_milestones_incoming').hide();
                    $('#wallet_milestones_outgoing').show();

                    $('.wallet_milestones_incoming_btn').removeClass('lightWalletButton');
                    $('.wallet_milestones_outgoing_btn').addClass('lightWalletButton');

                });
            });
        </script>
    @endsection
