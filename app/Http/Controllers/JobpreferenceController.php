<?php

namespace App\Http\Controllers;


use App\Models\UserPrefrence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobpreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preferance = UserPrefrence::where('user_id',Auth::guard('jobportal')->user()->id)->first();
        return view('jobportal.front.jobs.jobprefrence',compact('preferance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $user = Auth::guard('jobportal')->user();
        if ($request->title) {
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'title' => implode(',', $request->title)
                ]
            );
        }
        if ($request->job_types) {
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'job_type' => implode(',', $request->job_types)
                ]
            );
        }
        if ($request->days) {
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'days' => implode(',', $request->days)
                ]
            );
        }
        if ($request->shifts) {
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'shifts' => implode(',', $request->shifts)
                ]
            );
        }
        if ($request->minimum_pay) {
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'minimum_pay' => $request->minimum_pay,
                    'pay_periods' => $request->pay_periods
                ]
            );
        }if($request->willing_to_relocate == 1){
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'relocate' => $request->relocate,
                    'locations' => implode(',', $request->locations)
                ]
            );
        }if($request->remote){
            UserPrefrence::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'remote' => implode(',', $request->remote)
                ]
            );
        }
        return back()->with('success','data Updated Successfully!');
    }
    public function getCities(Request $request)
    {
        $text = $request->text;
        $country = DB::table('allstates')->where('name', Auth::guard('jobportal')->user()->state)->first();
        $cities = DB::table('allcities')
            ->where('name', 'like', '%' . $text . '%')
            ->where('state_id', $country->id)
            ->get();
        return response()->json(['data' => $cities], 200);
    }


}
