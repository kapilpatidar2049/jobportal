<?php

namespace App\Http\Controllers\Jobportal;

use App\Http\Controllers\Controller;
use App\Mail\Jobportal\OTPVerification;
use App\Models\Allcountry;
use App\Models\JobPortalUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class AuthController extends Controller
{
    //----------------------JobPortal Login Code Start----------------------------
    public function login()
    {
        return view('jobportal.auth.login');
    }
    //----------------------JobPortal Login Code End----------------------------

    // ---------------------Check Credential Code Start-------------------------
    public function checkemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $user = JobPortalUser::where('email', $email)->first();

        if ($user && $user->email_verified_at !== null) {
            return redirect()->route('jobportal.password', base64_encode($email));
        } else {
            $otp = rand(100000, 999999);
            $user = JobPortalUser::updateOrCreate(['email' => $email], [
                'email' => $email,
                'otp' => $otp
            ]);
            Mail::to($email)->send(new OTPVerification($otp));
            return redirect()->route('jobportal.otp', base64_encode($email))->with('success', 'Otp Was Sent Successfully');
        }
    }

    public function checkotp(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $email = $request->email;
        $otp = $request->otp;
        $user = JobPortalUser::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }
        if ($otp != $user->otp) {
            return back()->with('error', 'Invalid OTP.');
        }

        // Set the user's password and clear OTP
        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->email_verified_at = Carbon::now();
        $user->save();
        $role = $request->role;
        $credentials = [
            'email' => $user->email,
            'password' => $request->password
        ];
        // Log the user in
        Auth::guard('jobportal')->attempt($credentials);
        if($role = 'employee'){
            return redirect('/jobportal/dashboard');
        }else{
            return redirect()->route('jobportal.frontjob');
        }
    }

    public function password($email)
    {
        $email = base64_decode($email);
        return view('jobportal.auth.password', compact('email'));
    }
    public function otp($email)
    {
        $email = base64_decode($email);
        return view('jobportal.auth.otp', compact('email'));
    }


    public function dologin(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Credentials for authentication
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Attempt login with 'remember' option
        $login = Auth::guard('jobportal')->attempt($credentials);

        if ($login) {
            Session::put('changed_currency_symbol', '$');
            Session::put('changed_currency', 'USD');
            Flash::success('Welcome to Dashboard');
            return redirect()->route('jobportal.frontjob');
        } else {
            return back()->withErrors(['error' => 'These credentials do not match our records.']);
        }
    }

    // ---------------------Check Credential Code End  -------------------------
    // ---------------------Logout Code Start ------------------------------
    public function logout()
    {
        Auth::guard('jobportal')->logout();
        return redirect()->route('jobportal.login');
    }
    // ---------------------Logout Code End ------------------------------

    // -------------------------Profile Code Start-----------------------
    public function profile(Request $request)
    {
        $ip = $request->ip();
        $apiToken = env('IPINFO_TOKEN');
        $countryCode = null;
        $response = Http::get("http://ipinfo.io/{$ip}?token={$apiToken}");

        if ($response->successful()) {
            $data = $response->json();
            $countryCode = $data['country'] ?? null;
        }
        $countries = Allcountry::whereNotNull('phonecode')->get();
        $user = Auth::guard('jobportal')->user();
        return view('jobportal.profile', compact('countries', 'user', 'countryCode'));
    }
    // -------------------------Profile Code End-----------------------
    public function saveProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_code' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            // 'city' => 'required|string|max:255',
            // 'state' => 'required|string|max:255',
            // 'country' => 'required|string|max:255',
        ]);

        $user = Auth::guard('jobportal')->user();
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extention;
            $file->move(public_path('/jobportal/user'), $fileName);
            $user->image = $fileName;
            $user->save();
        }
        $user->name = $request->name;
        $user->country_code = $request->country_code;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->save();
        return back()->with('success','Your Profile has bin Updated Successfully');
    }
    public function searchable(){
        return view('jobportal.front.resume.searchable');
    }
}
