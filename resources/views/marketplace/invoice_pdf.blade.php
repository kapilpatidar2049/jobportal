<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invoice #{{ $invoice->id }}</title>
    <link href="{{ public_path('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ public_path('admin_theme/marketplace/css/style.css') }}">
   
</head>

<body>
    <div class="mb-3">
        <div>
            <span class="float-end invoice_TAX">
                {{__('Tax Invoice')}}
            </span>
            <div class="invoice_logo">
                <img src="{{ public_path('/admin_theme/marketplace/images/' . $invoice->logo) }}" alt="Company Logo">
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-lg-6">
            <h3><b>{{ $invoice->company_name }}</b><span class="float-end">{{__('Balance Due')}} <br> <b>${{ number_format($invoice->balance_due, 2) }}</b></span> </h3>
            <span>{{ $invoice->company_address }}</span><br>
            <span>{{ $invoice->company_gst }}</span>
        </div>
       
    </div>
    <div class="mb-5">
        <span class="float-end mt-3">
            <span class="float-end "><strong>{{__('Invoice Date:')}}</strong> {{ $invoice->invoice_date }}</span><br>
            <span class="float-end"><strong>{{__('Terms:')}}</strong> {{ $invoice->terms }}</span><br>
            <span class="float-end"><strong>{{__('Due Date:')}}</strong> {{ $invoice->due_date }}</span>
        </span><br>
        <span>{{__('Bill to')}}</span><br>
        <span class="mb-3">
            <span><b>{{ $invoice->client_name }}</b></span><br>
            <span>{{ $invoice->client_address }}</span><br>
            <span>{{ $invoice->client_gst }}</span><br>
        </span><br>
        <span ><strong>{{__('Place of Supply:')}}</strong> {{ $invoice->place_supply }}</span><br>
        <span ><strong>{{__('Subject:')}}</strong> {{ $invoice->subject }}</span><br>
        <span ><a href="{{ $invoice->link }}" target="_blank">{{ $invoice->link }}</a>
       </span>
    </div>

    

    <table class="table">
        <thead class="invoice_table_dark">
            <tr>
                <th scope="col">{{__('#')}}</th>
                <th scope="col">{{__('Item/Description')}}</th>
                <th scope="col">{{__('Amount')}}</th>
                <th scope="col">{{__('Qty')}}</th>
                <th scope="col">{{__('Rate')}}</th>
                <th scope="col">{{__('IGST')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice_item as $key => $items)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>
                    <p>{{ $items->item_description }}</p>
                </td>
                <td>
                    <p>${{ number_format($items->amount, 2) }}</p>
                </td>
                <td>
                    <p>{{ $items->qty }}</p>
                </td>
                <td>
                    <p>${{ number_format($items->rate, 2) }}</p>
                </td>
                <td>
                    <p>{{ $items->igst }}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <div class="text-end mb-3">
        <div class="">
         <span>{{__('Sub Total : 0.0')}}</span><br>
         <span>{{__('IGST : 0.0')}}</span><br>
         <span><b>{{__('Total : 0.0')}}</b></span><br>
         <span class="invoice_total_balance float-end p-2"><b>{{__('Balance Due :')}}</b> {{__('0.0')}}</span><br>
        </div>
    </div>

    <div class="mt-3">
        <h3 class="mb-2">{{__('Payment Details')}}</h3>
        <div class="">
            <span>{{__('Bank Name:')}} {{ $invoice->bank_name }}</span><br>
            <span>{{__('Account Name:')}} {{ $invoice->account_name }}</span><br>
            <span>{{__('Account Number:')}} {{ $invoice->account_number }}</span><br>
            <span>{{__('IFSC Code:')}} {{ $invoice->ifsc_code }}</span><br>
            <span>{{__('Branch:')}} {{ $invoice->branch }}</span><br>
        </div>
    </div>
</body>

</html>
