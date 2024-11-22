<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\marketplace\Marketplace_industries;
use App\Models\marketplace\Marketplace_project;
use App\Models\marketplace\Marketplace_bids;
use App\Models\marketplace\Marketplace_user_skills;
use App\Models\marketplace\Marketplace_skills;
use App\Models\marketplace\Bank_account;
use App\Models\marketplace\Milestone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function root()
    {
        $industries = Marketplace_industries::all();
        $project = Marketplace_project::orderBy('id','desc')->get();
        $freelancers = User::all();
        $userSkill = Marketplace_user_skills::where('user_id',Auth::user()->id)->get();

        $selectedSkills = session('selected_skills', []);
        $selectedUserSkills = session('selected_userSkills', []);

        $combinedSkills = collect($selectedSkills)->merge($userSkill->pluck('name'))->unique();
        $combinedUserSkills = collect($selectedUserSkills)->merge($userSkill->pluck('name'))->unique();

        return view('marketplace.index', compact('industries', 'project', 'freelancers','userSkill','selectedSkills','combinedSkills','combinedUserSkills'));
    }

    
    public function filter(Request $request)
    {
        $query = Marketplace_project::query();
        $industries = Marketplace_industries::all();
        $freelancers = User::all();
    
        // Filter by industry
        if ($request->has('industry_id')) {
            $industryId = $request->input('industry_id');
            $query->where('industry', $industryId);
        }
        
        // Filter by remote project if checked
        if ($request->has('remote_project') && $request->remote_project == 'yes') {
            $query->where('remote_project', 'yes');
        }

        // Filter by listing type
        if ($request->has('listing_type') && $request->listing_type != 'All') {
            $query->where('listing_type', $request->listing_type);
        }

        if(($request->has('hourly_rate') && $request->hourly_rate == 'Hourly')&&($request->has('fixed_rate') && $request->fixed_rate == 'Fixed')) {
            
        }
        elseif($request->has('fixed_rate') && $request->fixed_rate == 'Fixed') {
            $query->where('project_rate', 'Fixed');
        }
        elseif($request->has('hourly_rate') && $request->hourly_rate == 'Hourly') {
            $query->where('project_rate', 'Hourly');
        }else{

        }

        // Filter by selected skills
        if ($request->has('selected_skills') && !empty($request->selected_skills)) {
            $selectedSkills = $request->input('selected_skills');
            
            // Adjust filtering to check for skills in Marketplace_project_skills table
            $query->whereHas('skills', function ($q) use ($selectedSkills) {
                $q->whereIn('name', $selectedSkills); // Check for skills in Marketplace_project_skills table
            });
        }

        $subQuery = DB::table('marketplace_bids')
        ->select('project_id', DB::raw('COUNT(id) as bid_count'))
        ->groupBy('project_id');

        if ($request->has('sort')) {
          
            switch ($request->input('sort')) {
                case 'Latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'Oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'Lowest Price':
                        $query->orderBy('max_rate', 'asc');
                        break;
                case 'Highest Price':
                        $query->orderBy('max_rate', 'desc');
                        break;
                case 'Fewest Bids':
                    $query->leftJoinSub($subQuery, 'bids', 'marketplace_projects.id', '=', 'bids.project_id')
                            ->select('marketplace_projects.*', 'bids.bid_count')
                            ->orderBy('bids.bid_count', 'asc');
                    break;
                case 'Most Bids':
                    $query->leftJoinSub($subQuery, 'bids', 'marketplace_projects.id', '=', 'bids.project_id')
                            ->select('marketplace_projects.*', 'bids.bid_count')
                            ->orderBy('bids.bid_count', 'desc');
                    break;
            }
        }
    
        if ($request->has('location') && $request->location != '') {
            $query->where(function ($q) use ($request) {
                $q->where('country', 'like', '%' . $request->location . '%')
                  ->orWhere('city', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->has('currency') && $request->currency != 'All') {
            $query->where('currency', $request->currency);
        }
        // Filter by min_rate and max_rate
        if ($request->has('min_rate') && $request->min_rate != '') {
            $query->where('min_rate', '>=', $request->min_rate);
        }

        if ($request->has('max_rate') && $request->max_rate != '') {
            $query->where('max_rate', '<=', $request->max_rate);
        }
        
        if ($request->has('topSearch') && $request->topSearch != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->topSearch . '%')
                  ->orWhere('description', 'like', '%' . $request->topSearch . '%');
            });
        }

        $project = $query->get();
    
        // Return only the project list partial view for AJAX requests
        if ($request->ajax()) {
            return view('marketplace.project-list', compact('project'))->render();
        }
    
        // For non-AJAX requests, load the full view
        return view('marketplace.index', compact('project', 'industries', 'freelancers'));
    }

    public function projectDetails($id)
    {
        $project = Marketplace_project::where('id', $id)->first();
        $bids = Marketplace_bids::where('project_id', $project->id)->count();
        $avg_rate = ($project->min_rate + $project->max_rate) / 2;

        $user = User::where('id', $project->user_id)->first();
        return view('marketplace.project.project-details', compact('project', 'avg_rate', 'bids', 'user'));
    }

    public function bookmarkedProject($id)
    {
        return view('marketplace.bookmark');
    }

    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return view('errors.404');
    }

    public function showWallet()
    {
        return view('marketplace.wallet.wallet');
    }


    public function showBid($id)
    {
        $bid = Marketplace_bids::where('id', $id)->first();
        $allBid = Marketplace_bids::orderBy('id', 'desc')->get();
        $user = User::where('id', $bid->user_id)->first();
        $bidproject = Marketplace_project::where('id', $bid->project_id)->first();
        return view('marketplace.bids.bid', compact('bid', 'bidproject', 'user', 'allBid'));
    }

    public function userBid(Request $request)
    {
        $allBid = Marketplace_bids::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('marketplace.proposal.user-proposal', compact('allBid'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        // Search skills by name in the marketplace_skills table
        $skills = Marketplace_skills::where('name', 'LIKE', '%' . $query . '%')->get();
        
        // Return skills as JSON to use in frontend JavaScript
        return response()->json($skills);
    }
    
    public function userSearch(Request $request)
    {
        $query = $request->get('query');
        
        // Search skills by name in the marketplace_skills table
        $skills = Marketplace_skills::where('name', 'LIKE', '%' . $query . '%')->get();
        
        // Return skills as JSON to use in frontend JavaScript
        return response()->json($skills);
    }

   

    public function storeSelectedSkills(Request $request)
    {
        // Assuming 'selected_skills' contains skill IDs
        $skillIds = $request->selected_skills;

        // Fetch skill names from the database
        $skills = Marketplace_skills::whereIn('id', $skillIds)->pluck('name', 'id');

        // Get existing skills from the session, or initialize an empty array
        $existingSkills = session('selected_skills', []);

        // Merge new skills with the existing ones, ensuring no duplicates
        $updatedSkills = $existingSkills->merge($skills)->unique();

        // Store the updated skills in the session
        session(['selected_skills' => $updatedSkills]);

        return response()->json(['success' => true, 'skills' => $updatedSkills]);
    }


    public function userFilter(Request $request){
        $industries = Marketplace_industries::all();
        $query = User::query();

        if ($request->has('currency') && $request->currency != 'All') {
            $query->where('currency', $request->currency);
        }

        if ($request->has('min_rate') && $request->min_rate != '') {
            $query->where('hourly_rate', '>=', $request->min_rate);
        }

        if ($request->has('max_rate') && $request->max_rate != '') {
            $query->where('hourly_rate', '<=', $request->max_rate);
        }

          // Filter by selected skills
          if ($request->has('selected_userSkills') && !empty($request->selected_userSkills)) {
            $selectedSkills = $request->input('selected_userSkills');
            
            // Adjust filtering to check for skills in Marketplace_project_skills table
            $query->whereHas('userSkills', function ($q) use ($selectedSkills) {
                $q->whereIn('name', $selectedSkills); // Check for skills in Marketplace_project_skills table
            });
          }

        $freelancers = $query->get();
    
        // Return only the project list partial view for AJAX requests
        if ($request->ajax()) {
            return view('marketplace.user-list', compact('freelancers'))->render();
        }
    
        // For non-AJAX requests, load the full view
        return view('marketplace.index', compact('project', 'industries', 'freelancers'));
    }

    public function userSelectedSkills(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'selected_userSkills' => 'required|array',
            'selected_userSkills.*' => 'integer|exists:marketplace_skills,id',
        ]);
    
        // Get skill IDs from request
        $skillIds = $request->input('selected_userSkills');
    
        // Fetch skill names based on IDs
        $skills = Marketplace_skills::whereIn('id', $skillIds)->pluck('name', 'id');
    
        // Get existing skills from session
        $existingSkills = collect(session('selected_userSkills', []));
    
        // Merge with new skills and remove duplicates
        $updatedSkills = $existingSkills->merge($skills)->unique();
    
        // Store updated skills in the session
        session(['selected_userSkills' => $updatedSkills->toArray()]);
    
        return response()->json(['success' => true, 'skills' => $updatedSkills]);
    }

    public function showReview(Request $request,$id)
    {
        $projectId = $id;
        $milestones = Milestone::where('project_id', $projectId)->get();
      return view('marketplace.assign.index',compact('milestones'));
    }
    
    public function rating(Request $request)
    {
      return view('marketplace.review.index');
    }
    public function acceptProposal(Request $request)
    {
      return view('marketplace.proposal.accept-proposal');
    }
    public function storeBankDetails(Request $request)
    {
        $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'bank_name' => 'required|string|max:255',
            'ifsc_code' => 'nullable|string|max:11',
            'routing_number' => 'nullable|string|max:9',
            'swift_code' => 'nullable|string|max:11',
            'currency' => 'required|string|max:3',
        ]);

        Bank_account::create([
            'user_id' => Auth::user()->id,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'ifsc_code' => $request->ifsc_code,
            'routing_number' => $request->routing_number,
            'swift_code' => $request->swift_code,
            'currency' => $request->currency,
        ]);

        return redirect()->back()->with('success', 'Bank account added successfully.');
    }


}
