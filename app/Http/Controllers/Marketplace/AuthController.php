<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\marketplace\Marketplace_skills;
use App\Models\marketplace\Marketplace_user_skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpFoundation\Session\Flash;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    protected function authenticated(Request $request, $user)
    {
        // Redirect to the welcome animation view after successful login
        return redirect()->route('welcome.animation');
    }

    //-------------------------------Login page View Code Start-------------------------------------
    public function showLoginForm()
    {
        return view('marketplace.auth.login');
    }
    //-------------------------------Login page View Code End-------------------------------------

    //-------------------------------Login Check Code Start-------------------------------------

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $successMessage = 'Welcome ' . Auth::user()->name . ', You Logged in successfully!';
            $user = Auth::user();
            if ($user) {
                $user->is_online = true;
                $user->save();
            }
            return redirect('/')->with('success', $successMessage);
        }

        // Authentication failed, redirect back with an error
        return back()->withErrors(['email' => 'Invalid email or password.']);
    }
    //-------------------------------Login Check Code End-------------------------------------

    //------------------------Show dashboard after login----------------------------------------
    public function dashboard()
    {
        return view('marketplace.index');
    }

    //-------------------------------Register Form page View Code Start-------------------------------------
    public function registerForm()
    {
        return view('marketplace.auth.register');
    }
    //-------------------------------Register Form page View Code end-------------------------------------

    //------------------------------- Store Register Details Code Start-------------------------------------
    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return view('marketplace.Client-User.index', compact('user'));
    }
    //------------------------------- Store Register Details Code End-------------------------------------

    public function showUserClient()
    {
        return view('marketplace.Client-User.index');
    }
    //-------------------------------Client Details View Code Start-------------------------------------
    public function showClientDetails($id)
    {
        $user = User::findOrFail($id);
        return view('marketplace.Client-User.client-details', compact('user'));
    }
    //-------------------------------Client Details View Code End-------------------------------------

    //-------------------------------Client Details Store Code Start-------------------------------------
    public function storeClientDetails(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->role = $request->role;
        $user->platform = $request->platform;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->user_name = $request->user_name;
        $user->company_name = $request->company_name;
        $user->gst_number = $request->gst_number;

        $user->project = ($request->project === 'project') ? 'yes' : 'no';
        $user->remote_project = ($request->project === 'remote-project') ? 'yes' : 'no';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $user->image  = $filename;
        }

        // if ($request->hasFile('company_logo')) {
        //     $file = $request->file('company_logo');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move('images', $filename);
        //     $user->company_logo  = $filename;
        // }

        // Save the updated user data

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the user
        $user->save();

        // Automatically log in the user
        Auth::login($user);
        $successMessage = 'Welcome ' . $request->name . ', You Logged in successfully!';
        return redirect('/')->with('success', $successMessage);
    }
    //-------------------------------Client Details Store Code End-------------------------------------

    //-------------------------------User Details View Code Start-------------------------------------
    public function showUserDetails($id)
    {
        $user = User::findOrFail($id);
        return view('marketplace.Client-User.user-details', compact('user'));
    }
    //-------------------------------User Details View Code end-------------------------------------

    //-------------------------------User Details Store Code Start-------------------------------------
    public function storeUserDetails(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $user->image  = $filename;
        }

        $user->role = $request->role;
        $user->platform = $request->platform;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->industry = $request->industry;
        $user->area = $request->area;
        $user->street_address = $request->street_address;
        $user->experience = $request->experience;
        $user->pin_code = $request->pin_code;

        $user->project = ($request->project === 'project') ? 'yes' : 'no';
        $user->remote_project = ($request->project === 'remote-project') ? 'yes' : 'no';

        if ($request->filled('userSkills')) {
            $skillsArray = explode(',', $request->input('userSkills'));
            foreach ($skillsArray as $skillName) {
                Marketplace_user_skills::create([
                    'user_id' => $user->id,
                    'name' => trim($skillName),
                ]);
            }
        }
       

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the user
        $user->save();

        // Automatically log in the user
        Auth::login($user);
        $successMessage = 'Welcome ' . $request->name . ', You Logged in successfully!';
        return redirect('/')->with('success', $successMessage);
    }
    //-------------------------------User Details Store Code end-------------------------------------

    //----------------------------------------Logout Code Start---------------------------------------------
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->is_online = false;
            $user->save();
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
    //----------------------------------------Logout Code End---------------------------------------------

    public function showForgetPasswordForm()
    {
        return view('marketplace.auth.forgetpassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);
        $user = User::where('email', $request->email)->first();
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::send('email.send-otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password Reset OTP');
        });

        // Persist email in session
        session(['email' => $request->email]);

        return redirect()->route('verify.otp.get')->with('success', 'OTP has been sent to your email.');
    }

    public function showOtpForm()
    {
        // Optionally, check if email exists in session
        if (!session('email')) {
            return redirect()->route('forget.password.get')->with('error', 'Please initiate a password reset first.');
        }

        return view('marketplace.auth.verify_otp');
    }

    public function submitOtpForm(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp || now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        // Reset OTP fields
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Optionally, you can regenerate the session or remove the email from session
        session()->forget('email');

        // Redirect to reset password page
        return view('marketplace.auth.reset-password', ['email' => $user->email]);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(10);
            $user->save();

            // Resend OTP email
            Mail::send('email.send-otp', ['otp' => $otp], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Resend OTP');
            });

            return response()->json(['success' => true, 'message' => 'OTP resent successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8', // 'confirmed' ensures password_confirmation matches
        ]);

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('forget.password.get')->with('error', 'User not found.');
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        // Clear OTP fields just in case (they should already be null)
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();
        return redirect()->route('login')->with('success', 'Your password has been reset successfully. You can now log in.');
    }

    public function getSubIndustry(Request $request)
    {
        $id = $request->id;
        $subindustries = Marketplace_skills::where('industry_id', $id)->get();
        return response()->json(['subindustries' => $subindustries]);
    }

    public function searchSkills(Request $request)
    {
        $query = $request->input('query');
        $industries = $request->input('industries', []);

        // Base query to search skills by name
        $skills = Marketplace_skills::where('name', 'LIKE', "%{$query}%");

        // If industries are provided, filter the skills based on those industries
        if (!empty($industries)) {
            $skills->whereIn('industry_id', $industries);
        }

        // Fetch and return the skills
        return response()->json($skills->get());
    }
    public function searchProjectSkills(Request $request)
    {
        $query = $request->input('query');
        $industryId = $request->input('industry_id');
    
        $skills = Marketplace_skills::where('name', 'LIKE', "%{$query}%")
                    ->where('industry_id', $industryId) // Filter by selected industry
                    ->get();
    
        return response()->json($skills);
    }
  
    public function logoutWindow(Request $request)
    {
    // Get the user ID from the form data
  // Get the user ID from the form data
  $userId = $request->input('user_id');

  // Find the user by ID and mark them as offline
  $user = User::find($userId);

  if ($user) {
      // Mark the user as offline
      $user->is_online = false;
      $user->save();
  }
    
     return response()->json(['status' => 'success']);
    }
   
}
