<?php

namespace App\Http\Controllers\Jobportal;

use App\Models\Jobportal\CompnyDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jobportal\SubIndustries;
use App\Models\JobPortalUser;
use Illuminate\Support\Facades\Auth;

class CompnyDetailController extends Controller
{

    public function index()
    {
        $compnyDetail = CompnyDetail::where('user_id', Auth::guard('jobportal')->user()->id)->first();
        if (!$compnyDetail) {
            $compnyDetail = (object) []; // Convert to empty object to prevent property access issues
        }
        return view('jobportal.auth.companydetails', compact('compnyDetail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'name' => 'required',
            'industry' => 'required',
            'website' => 'required'
        ]);
        $phone = null;
        if ($request->phone) {
            $phone = $request->countrycode . $request->phone;
        }
        $compnyDetail = CompnyDetail::createOrUpdate(
            ['user_id' => Auth::guard('jobportal')->user()->id],
            [
                'name' => $request->name,
                'company_name' => $request->company_name,
                'website' => $request->website,
                'employees' => $request->employees,
                'heared_about_us' => $request->heared_about_us,
                'phone' => $phone,
                'industry' => $request->industry,
                'description' => $request->description,
                'country' => $request->country,
                'language' => $request->language,
                'sub_industry' => $request->sub_industry,
                'gst_number' => $request->gst_number,
            ]
        );

        if ($compnyDetail) {
            return redirect()->route('jobportal.job_create')->with('success', 'Your Company Registered Successfully!');
        }
    }


    public function getSubcategory(Request $request)
    {
        $id = $request->id;
        $subindustries = SubIndustries::where('industry_id', $id)->get();
        return response()->json(['subindustries' => $subindustries]);
    }
}
