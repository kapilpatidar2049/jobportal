<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\marketplace\Marketplace_user_skills;
use App\Models\marketplace\MarketplacePortfolio;
use App\Models\marketplace\MarketplacePortfolioImages;
use App\Models\marketplace\MarketplaceExperiences;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function create($id)
    {
        $profile = User::where('id', $id)->first();
        $allPortfolio = MarketplacePortfolio::where('user_id', $id)->get();
        $portfolio = MarketplacePortfolio::where('user_id', $id)
        ->select('category', \DB::raw('count(*) as count'))
        ->groupBy('category')
        ->orderByDesc('count')
        ->get();
        $skills = Marketplace_user_skills::where('user_id', $id)->get();
        $experiences = MarketplaceExperiences::where('user_id', $id)->get();

        return view('marketplace.profile.profile', compact('profile', 'skills','portfolio','allPortfolio','experiences'));
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user->role == 'client') {
            $user->name = $request->name;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->skill = $request->skill;
            $user->project = $request->project;
            $user->area = $request->area;
            $user->street_address = $request->street_address;
            $user->experience = $request->experience;
            $user->remote_project = $request->remote_project;
            $user->pin_code = $request->pin_code;
            $user->user_name = $request->user_name;
            $user->company_name = $request->company_name;
            $user->company_description = $request->company_description;
            $user->gst_number = $request->gst_number;


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $filename);
                $user->image  = $filename;
            }

            if ($request->hasFile('company_logo')) {
                $file = $request->file('company_logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $filename);
                $user->company_logo  = $filename;
            }
            return redirect()->back()->with('success', 'Profile updated successfully!');
        }

        if ($user->role == 'user') {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $filename);
                $user->image  = $filename;
            }

            $user->name = $request->name;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->project = $request->project;
            $user->area = $request->area;
            $user->street_address = $request->street_address;
            $user->experience = $request->experience;
            $user->remote_project = $request->remote_project;
            $user->pin_code = $request->pin_code;
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully!');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'back_image' => 'max:2048|mimes:png,jpg,jpeg',
            'image' => 'max:2048|mimes:png,jpg,jpeg',
        ]);

        $user = User::findOrFail($request->user_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $user->image  = $filename;
        }

        if ($request->hasFile('back_image')) {
            $file = $request->file('back_image');
            $filename = time() . '.back' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $user->back_image  = $filename;
        }

        $user->currency = $request->currency;
        $user->hourly_rate = $request->hourly_rate;
        $user->about = $request->about;
        if ($request->old_password) {
            $request->validate([
                'new_password'=>'required|min:6|confirmed'
            ]);
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return back()->withErrors(['old_password' => 'Incorrect password. Please try again.']);
            } else {
                $user->password = Hash::make($request->new_password);
            }
        }
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
        ]);

        if ($request->old_password) {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return back()->withErrors(['old_password' => 'Incorrect password. Please try again.']);
            }
        }
        $profile = User::findOrFail($id);
        $profile->delete();
    

        Auth::logout();
        return redirect()->route('login')->with('success', 'Profile deleted successfully.');
    }

    public function storePortfolio(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
        ]);
    
        // Save portfolio first
        $portfolio = new MarketplacePortfolio();
        $portfolio->user_id = Auth::user()->id;
        $portfolio->category = $request->category;
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->save();
    
        // Save each image with the portfolio_id
        if ($request->hasFile('port_img')) {
            $images = $request->file('port_img');
            foreach ($images as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('images', $filename);
                MarketplacePortfolioImages::create([
                    'image' => $filename,
                    'portfolio_id' => $portfolio->id, // Use portfolio's ID after saving it
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Portfolio item added successfully!');
    }

    public function storeExperience(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'start_month' => 'required|string|max:20',
            'start_year' => 'required|integer',
            'end_month' => 'nullable|string|max:20',
            'end_year' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        
        MarketplaceExperiences::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'company' => $request->company,
            'country' => $request->country,
            'city' => $request->city,
            'start_month' => $request->start_month,
            'start_year' => $request->start_year,
            'workingStatus' => $request->workingStatus,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Experience added successfully');
    }
}
