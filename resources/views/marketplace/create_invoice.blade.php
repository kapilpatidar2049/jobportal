@extends('marketplace.layouts.master')
@section('title', 'Bookmarked-Project')
@section('page-title', 'Create-Invoice')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <section>
            <div class="container mb-5">
                <div class="mt-5">
                    <h1>Create Invoice</h1>
                </div>
                <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="logo" class="form-group-label mb-2">{{__('Logo:')}}</label>
                                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group ">
                                <label for="company_name" class="form-group-label mb-2">{{__('Company Name:')}}</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" 
                                    placeholder="Company Name" value="{{ old('company_name') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="company_address" class="form-group-label mb-2">{{__('Company Address:')}}</label>
                                <input type="text" name="company_address" id="company_address" class="form-control"
                                     placeholder="Company Address" value="{{ old('company_address') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="company_gst" class="form-group-label mb-2">{{__('Company GST:')}}</label>
                                <input type="text" name="company_gst" id="company_gst" class="form-control" 
                                    placeholder="Company GST" value="{{ old('company_gst') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="balance_due" class="form-group-label mb-2">{{__('Balance Due:')}}</label>
                                <input type="text" name="balance_due" id="balance_due" class="form-control" 
                                    placeholder="Balance Due" value="{{ old('balance_due') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="client_name" class="form-group-label mb-2">{{__('Client Name:')}}</label>
                                <input type="text" name="client_name" id="client_name" class="form-control" 
                                    placeholder="Client Name" value="{{ old('client_name') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="client_address" class="form-group-label mb-2">{{__('Client Address:')}}</label>
                                <input type="text" name="client_address" id="client_address" class="form-control"
                                     placeholder="Client Address" value="{{ old('client_address') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="client_gst" class="form-group-label mb-2">{{__('Client GST:')}}</label>
                                <input type="text" name="client_gst" id="client_gst" class="form-control" 
                                    placeholder="Client GST" value="{{ old('client_gst') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="invoice_date" class="form-group-label mb-2">{{__('Invoice Date:')}}</label>
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control" 
                                    value="{{ old('invoice_date') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="terms" class="form-group-label mb-2">{{__('Terms:')}}</label>
                                <textarea name="terms" id="terms" class="form-control"  placeholder="Terms">{{ old('terms') }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="due_date" class="form-group-label mb-2">{{__('Due Date:')}}</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" 
                                    value="{{ old('due_date') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="place_supply" class="form-group-label mb-2">{{__('Place of Supply:')}}</label>
                                <input type="text" name="place_supply" id="place_supply" class="form-control"
                                     placeholder="Place of Supply" value="{{ old('place_supply') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="subject" class="form-group-label mb-2">{{__('Subject:')}}</label>
                                <input type="text" name="subject" id="subject" class="form-control" 
                                    placeholder="Subject" value="{{ old('subject') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="link" class="form-group-label mb-2">{{__('Link:')}}</label>
                                <input type="url" name="link" id="link" class="form-control"
                                    placeholder="Link" value="{{ old('link') }}">
                            </div>
                        </div>
                    </div>
                    <h3>{{__('Item Details')}}</h3>
                    <div id="items-container">
                        <div class="row item-row mb-3">
                            <div class="col-lg-3 mb-2">
                                <input type="text" name="item_description[]" class="form-control" placeholder="Item Description">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="text" name="amount[]" class="form-control" placeholder="Amount">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="number" name="qty[]" class="form-control" placeholder="Quantity">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="text" name="rate[]" class="form-control" placeholder="Rate">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="text" name="igst[]" class="form-control" placeholder="IGST">
                            </div>
                            <div class="col-lg-1 mb-2">
                                <button type="button" class="btn btn-danger remove-item">-</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-item" class="btn btn-success mt-2">{{__('+ Add Item')}}</button>
                    
                    <div class="row">
                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="bank_name" class="form-group-label mb-2">{{__('Bank Name:')}}</label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control" 
                                    placeholder="Bank Name" value="{{ old('bank_name') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="account_name" class="form-group-label mb-2">{{__('Account Name:')}}</label>
                                <input type="text" name="account_name" id="account_name" class="form-control"
                                     placeholder="Account Name" value="{{ old('account_name') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="account_number" class="form-group-label mb-2">{{__('Account Number:')}}</label>
                                <input type="text" name="account_number" id="account_number" class="form-control"
                                     placeholder="Account Number" value="{{ old('account_number') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="ifsc_code" class="form-group-label mb-2">{{__('IFSC Code:')}}</label>
                                <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" 
                                    placeholder="IFSC Code" value="{{ old('ifsc_code') }}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-4">
                            <div class="form-group">
                                <label for="branch" class="form-group-label mb-2">{{__('Branch:')}}</label>
                                <input type="text" name="branch" id="branch" class="form-control" 
                                    placeholder="Branch" value="{{ old('branch') }}">
                            </div>
                        </div>

                        <div class="col-lg-12 my-4">
                            <div class="form-group">
                                <label for="terms_conditions" class="form-group-label mb-2">{{__('Terms & Conditions:')}}</label>
                                <textarea name="terms_conditions" id="terms_conditions" class="form-control" 
                                    placeholder="Terms & Conditions">{{ old('terms_conditions') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">{{__('Create Invoice')}}</button>
                </form>
            </div>
        </section>
    @endsection
    @section('scripts')
    <script>
        document.getElementById('add-item').addEventListener('click', function () {
            const itemsContainer = document.getElementById('items-container');
            const itemRow = document.querySelector('.item-row');
            const newRow = itemRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = "");
            itemsContainer.appendChild(newRow);
        });
    
        document.getElementById('items-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                const itemRow = e.target.closest('.item-row');
                if (document.querySelectorAll('.item-row').length > 1) {
                    itemRow.remove();
                }else{
                    toastr.error('Atleast one row is required')
                }
            }
        });
    </script>
    @endsection
 