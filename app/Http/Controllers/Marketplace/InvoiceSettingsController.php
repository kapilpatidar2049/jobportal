<?php

namespace App\Http\Controllers\Marketplace;
use App\Http\Controllers\Controller;
use App\Models\marketplace\Marketplace_Invoice;
use App\Models\marketplace\Marketplace_Invoice_Items;
use Illuminate\Http\Request;
use PDF;

class InvoiceSettingsController extends Controller
{
    public function create()
    {
        return view('marketplace.create_invoice');
    }

    public function store(Request $request)
    {
        $logo = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('admin_theme/marketplace/images/', $filename);
            $logo = $filename;
        }
        
        $invoice = Marketplace_Invoice::create([
            'logo' => $logo,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_gst' => $request->company_gst,
            'balance_due' => $request->balance_due,
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'client_gst' => $request->client_gst,
            'invoice_date' => $request->invoice_date,
            'terms' => $request->terms,
            'due_date' => $request->due_date,
            'place_supply' => $request->place_supply,
            'subject' => $request->subject,
            'link' => $request->link,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch' => $request->branch,
            'terms_conditions' => $request->terms_conditions,
        ]);
    
        foreach ($request->item_description as $index => $description) {
            Marketplace_Invoice_Items::create([
                'invoice_id' => $invoice->id,
                'item_description' => $description,
                'amount' => $request->amount[$index],
                'qty' => $request->qty[$index],
                'rate' => $request->rate[$index],
                'igst' => $request->igst[$index],
            ]);
        }

        return redirect()->route('invoices.download', $invoice->id);
    }

    public function download($id)
    {
        $invoice = Marketplace_Invoice::findOrFail($id);
        $invoice_item = Marketplace_Invoice_Items::where('invoice_id',$id)->get();
        $pdf = PDF::loadView('marketplace.invoice_pdf', compact('invoice','invoice_item'));
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
    
    public function pdfView()
    {
        $id = 19;
        $invoice = Marketplace_Invoice::findOrFail($id);
        $invoice_item = Marketplace_Invoice_Items::where('invoice_id',$id)->get();
        return view('marketplace.invoice_pdf',compact('invoice','invoice_item'));
    }
}
