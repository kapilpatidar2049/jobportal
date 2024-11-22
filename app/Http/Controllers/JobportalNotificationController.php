<?php

namespace App\Http\Controllers;

use App\Models\Jobportal\JobportalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobportalNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::guard('jobportal')->user()->id;
        $notification = JobportalNotification::where('user_id',$userId)->get();
        return response()->json([$notification]);
    }

    public function read(){
        $userId = Auth::guard('jobportal')->user()->id;
        $notification = JobportalNotification::where('user_id',$userId)->update([
            'read'=>1
        ]);
        return response()->json([$notification]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function clear()
    {
        $userId = Auth::guard('jobportal')->user()->id;
        $notification = JobportalNotification::where('user_id',$userId)->delete();
        return response()->json(['message'=>'all notification cleared']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobportalNotification $jobportalNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobportalNotification $jobportalNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobportalNotification $jobportalNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobportalNotification $jobportalNotification)
    {
        //
    }
}
