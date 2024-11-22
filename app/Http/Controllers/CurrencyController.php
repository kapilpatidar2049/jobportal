<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Torann\Currency\Facades\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class CurrencyController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:currency.view', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:currency.create', ['only' => ['store', 'exchangestore']]);
    //     $this->middleware('permission:currency.edit', ['only' => ['updateStatus', 'update_currency']]);
    //     $this->middleware('permission:currency.delete', ['only' => ['destroy']]);
    // }
    //----------------------------------Page View Code start-------------------------------//
    public function index()
    {
        return view('jobportal.currency.index');
    }
    //----------------------------------Page View Code start-------------------------------//

    //---------------------------------- Data Store Code start-------------------------------
    public function store(Request $request)
    {
        // $request->validate([
        //     'code' => 'required|alpha|size:3|unique:currencies'
        // ]);
        // Artisan::call('currency:manage add ' . $request->code);
        // Artisan::call('currency:update -o');

        // Flash::success('Currency added')->important();
        // return back()->with('success','Currency added');


        // Validate the request
        $request->validate([
            'code' => 'required|alpha|size:3|unique:currencies'
        ]);

        try {
            // Run the 'currency:manage' command with the 'add' action and the currency code
            Artisan::call('currency:manage add '. $request->code,);

            // Run the 'currency:update' command with the '-o' option
            Artisan::call('currency:update', [
                '-o' => true,
            ]);

            // Flash success message
            Flash::success('Currency added successfully');
        } catch (\Exception $e) {
            // Handle any exceptions and flash an error message
            Flash::error('Failed to add currency: ' . $e->getMessage())->important();
        }
    }

    public function exchangestore(Request $request)
    {
        $env_update = DotenvEditor::setKeys([
            'OPEN_EXCHANGE_RATE_KEY' => $request->input('OPEN_EXCHANGE_RATE_KEY'),
        ]);
        $env_update->save();
        Flash::success('Data has been added.')->important();
        return back();
    }
    //---------------------------------- Data Store Code end-------------------------------

    //---------------------------------- All Data Show Code start-------------------------------
    public function show()
    {
        $currency = DB::table('currencies')->get();
        $openKey = env('OPEN_EXCHANGE_RATE_KEY');
        return view('jobportal.currency.index', compact('openKey', 'currency'));
    }
    //---------------------------------- All Data Show Code end-------------------------------

    //---------------------------------- Status  Code start-------------------------------
    public function updateStatus(Request $request)
    {
        $currencies = DB::table('currencies')->get();
        foreach ($currencies as $currency) {
            if ($currency->id == $request->id) {
                DB::table('currencies')->where('id', $currency->id)->update(['default' => 1]);
            } else {
                DB::table('currencies')->where('id', $currency->id)->update(['default' => 0]);
            }
        }
        Flash::success('Status change successfully.')->important();
        return back();
    }
    //---------------------------------- Status  Code end-------------------------------

    //---------------------------------- Data Delete Code start-------------------------------
    public function destroy(string $id)
    {
        $currency = DB::table('currencies')->where('id', $id)->first();
        if ($currency->default == 1) {
            Flash::error('You can\'t delete default currency!')->important();
            return back();
        }
        if ($currency) {
            DB::table('currencies')->where('id', $id)->delete();
            Flash::success('Data Delete Successfully')->important();
            return back();
        } else {
            Flash::error('Record not found')->important();
            return back();
        }
    }
    //---------------------------------- Data Delete Code End-------------------------------

    //---------------------------------- currencySwitch Code start-------------------------------
    public function currencySwitch($symbol)
    {
        $currency = DB::table('currencies')->where('symbol', $symbol)->first();
        if ($currency) {
            DB::table('currencies')->where('symbol', '!=', $symbol)->update(['default' => 0]);
            DB::table('currencies')->where('id', $currency->id)->where('symbol', '=', $symbol)->update(['default' => 1]);
            Session::put('changed_currency', $currency->symbol);
            Session::put('changed_currency', $symbol);
        }
        return back();
    }
    //---------------------------------- currencySwitch Code End-------------------------------

    // ---------------------update_currency code start----------------------
    public function update_currency(Request $request)
    {
        Artisan::call('currency:update -o');
        return response()->json(['success' => 'Currency Rate Auto Update Successfully ! !']);
    }
    // ---------------------update_currency code end----------------------

}
