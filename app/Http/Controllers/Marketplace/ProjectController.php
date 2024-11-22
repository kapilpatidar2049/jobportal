<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\marketplace\Marketplace_project;
use App\Models\marketplace\Marketplace_project_skills;
use App\Models\marketplace\Marketplace_bids;
use App\Models\marketplace\Marketplace_bookmarks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show()
    {
        return view('marketplace.project.index');
    }
  
    public function store(Request $request)
    {
        $project = Marketplace_project::create([
            'name' => $request->name,
            'description' => $request->description,
            'currency' => $request->currency,
            'project_rate' => $request->project_rate,
            'project' => ($request->project === 'project') ? 'yes' : 'no',  // Fixed '=' to '=>'
            'remote_project' => ($request->project === 'remote-project') ? 'yes' : 'no',  // Fixed '=' to '=>'
            'min_rate' => $request->min_rate,
            'max_rate' => $request->max_rate,
            'listing_type' => $request->listing_type,
            'country' => $request->country,
            'city' => $request->city,
            'industry' => $request->industry,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->filled('selected_skills')) {
            $skillsArray = explode(',', $request->input('selected_skills'));

            foreach ($skillsArray as $item) {
                Marketplace_project_skills::create([
                    'project_id' => $project->id,
                    'name' => trim($item),
                ]);
            }
        }
        return redirect('/')->with('success','Project Post Successfully');
    }

   
   
    public function storeBid(Request $request, $id)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|min:1',
            'delivery_days' => 'required|integer|min:1',
            'proposal' => 'required|string|max:200',
        ]);
        $sameUserBid = Marketplace_bids::where('project_id', $id)
        ->where('user_id', Auth::user()->id)
        ->first();

        if ($sameUserBid) {
        return redirect(route('project-details', $id))->with('error', 'You have already placed a bid on this project.');
        }

        $bid = new Marketplace_bids();
        $bid->project_id = $id;
        $bid->user_id = Auth::user()->id;
        $bid->bid_amount = $request->input('bid_amount');
        $bid->currency = $request->input('currency');
        $bid->delivery_days = $request->input('delivery_days');
        $bid->proposal = $request->input('proposal');
        $bid->save();
        return redirect(route('project-details',$id))->with('success', 'Bid submitted successfully!');
    }

    // public function storeBookmark(Request $request, $id)
    // {
    //     // return $request;
    //     $userId = Auth::user()->id;
    //     $projectId = $id;
    //     // Check if the bookmark already exists
    //     $existingBookmark = Marketplace_bookmarks::where('user_id', $userId)
    //                                 ->where('project_id', $projectId)
    //                                 ->first();

    //     if ($existingBookmark) {
    //         $existingBookmark->delete();
    //         return back()->with('success', 'Project remove from bookmark');
    //     }

    //     Marketplace_bookmarks::create([
    //         'user_id' => $userId,
    //         'project_id' => $projectId,
    //     ]);

    //     return back()->with('success', 'Project bookmarked successfully!');
        
    // }

    public function editBid(Request $request, $id)
    {
        $bid = Marketplace_bids::findOrFail($id);

        $project = Marketplace_project::where('id',$bid->project_id)->first();
        if ($project->assigned_user_id) {
            return back()->with('error', 'You cannot edit your bid as the project has already been assigned.');
        }

        $bid->bid_amount = $request->bid_amount;
        $bid->currency = $request->currency;
        $bid->delivery_days = $request->delivery_days;
        $bid->proposal = $request->proposal;
        $bid->save();
        return back()->with('success','Your bid has been updated successfully.');
    }

    public function storeBookmark(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $bookmark = Marketplace_bookmarks::where('project_id', $id)
                                        ->where('user_id', $userId)
                                        ->first();

        if ($bookmark) {
            // If bookmark exists, remove it (toggle functionality)
            $bookmark->delete();
            return response()->json(['bookmarked' => false]);
        } else {
            // Add the bookmark
            Marketplace_bookmarks::create([
                'project_id' => $id,
                'user_id' => $userId,
            ]);
            return response()->json(['bookmarked' => true]);
        }
    }


    public function assignProject(Request $request, $projectId, $userId)
    {
        $project = Marketplace_project::findOrFail($projectId);

        // Assign the user to the project
        $project->assigned_user_id = $userId;
        $project->save();

        // // Notify the user (optional)
        // $user = User::findOrFail($userId);
        // $user->notify(new ProjectAssignedNotification($project));

        return back()->with('success', 'Project assigned successfully.');
    }
}