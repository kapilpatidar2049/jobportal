<?php

namespace App\Http\Controllers\Jobportal;

use App\Http\Controllers\Controller;
use App\Models\Allcity;
use App\Models\Allcountry;
use App\Models\Allstate;
use App\Models\Jobportal\BuildResume;
use App\Models\Jobportal\CompnyDetail;
use App\Models\Jobportal\Interview;
use App\Models\Jobportal\JobportalCandidate;
use App\Models\Jobportal\JobportalPrescreenQuestion;
use App\Models\Jobportal\JobportalResume;
use App\Models\Jobportal\JobPreference;
use App\Models\Jobportal\Jobs;
use App\Models\Jobportal\JobSponser;
use App\Models\Jobportal\NoIntrestJob;
use App\Models\Jobportal\SavedJob;
use App\Models\Jobportal\UserPrescreenAnswer;
use App\Models\JobportalSkill;
use App\Models\JobPortalUser;
use App\Models\JobSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    // ---------------------------------All Jobs Code Start-------------------------------------
    public function index()
    {
        $jobs = Jobs::where('user_id', Auth::guard('jobportal')->user()->id)->where('status', '!=', 'Close')->get();
        return view('jobportal.jobs.index', compact('jobs'));
    }
    // ---------------------------------All Jobs Code End-------------------------------------

    // --------------------------------All Jobs View in Frontend Code Start--------------------------------
    public function jobFront()
    {
        if(Auth::guard('jobportal')->check()){
        $notintrested = NoIntrestJob::where('user_id', Auth::guard('jobportal')->user()->id)->pluck('job_id')->toArray();
        $jobs = Jobs::where('status', 'Open')
            ->whereNotIn('id', $notintrested)
            ->get();
        }else{
            $jobs = Jobs::where('status', 'Open')->orderBy('id','desc')->get();
        }

        return view('jobportal.front.jobs.home', compact('jobs'));
    }
    // --------------------------------All Jobs View in Frontend Code End--------------------------------

    //---------------------------------View Job In  Frontend Code Start------------------------------------
    public function view($id)
    {
        $job_id = base64_decode($id);
        $job = Jobs::where('id', $job_id)->first();
        return view('jobportal.front.jobs.viewjob', compact('job'));
    }
    //---------------------------------View Job In  Frontend Code End------------------------------------

    // ---------------------------------Create Job Code Start-------------------------------------
    public function create()
    {
        $company = CompnyDetail::where('user_id', Auth::guard('jobportal')->user()->id)->first();
        if (!$company) {
            return redirect('jobportal/company/register')->with('error', 'Please Register Your Company First!');
        }
        return view('jobportal.jobs.create');
    }
    // ---------------------------------Create Job Code End-------------------------------------

    // ---------------------------------Store Job Code Start-------------------------------------
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'language' => 'required|string',
            'country' => 'nullable|string',
            'title' => 'required|string',
            'type' => 'nullable|string',
            'job_type' => 'required|array',
            'job_type.*' => 'string',
            'timelength' => 'nullable|integer',
            'timeperiod' => 'nullable|string',
            'showby' => 'nullable|string',
            'schedule' => 'required|array',
            'schedule.*' => 'string',
            'startdate' => 'nullable|string',
            'startdatefield' => 'nullable|date',
            'numberofpeople' => 'required|string',
            'recruitment_timeline' => 'required|string',
            'pay' => 'nullable|string',
            'exactamount' => 'nullable|numeric',
            'minimumamount' => 'nullable|numeric',
            'maximumamount' => 'nullable|numeric',
            'rate' => 'nullable|string',
            'supplement' => 'nullable|array',
            'benefit' => 'nullable|array',
            'job_description' => 'required|string|min:200',
        ]);
        if ($request->type == 'on-site') {
            $request->validate([
                'city' => 'required|string',
                'area' => 'nullable|string',
                'address' => 'nullable|string',
                'pincode' => 'nullable|string',
            ]);
        }
        if ($request->type == 'remote') {
            $request->validate([
                'adscity' => 'required|string',
            ]);
        }

        $job = Jobs::create([
            'language' => $request->language,
            'user_id' => Auth::guard('jobportal')->user()->id,
            'country' => $request->country,
            'title' => $request->title,
            'type' => $request->type,
            'city' => $request->city,
            'state' => $request->state,
            'area' => $request->area,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'adscity' => $request->adscity,
            'job_type' => $request->job_type,
            'timelength' => $request->timelength,
            'timeperiod' => $request->timeperiod,
            'showby' => $request->showby,
            'schedule' => $request->schedule,
            'startdate' => $request->startdate,
            'startdatefield' => $request->startdatefield,
            'numberofpeople' => $request->numberofpeople,
            'recruitment_timeline' => $request->recruitment_timeline,
            'pay' => $request->pay,
            'exactamount' => $request->exactamount,
            'minimumamount' => $request->minimumamount,
            'maximumamount' => $request->maximumamount,
            'rate' => $request->rate,
            'supplement' => $request->supplement,
            'benefit' => $request->benefit,
            'job_description' => $request->job_description,
        ]);
        return redirect()->route('jobportal.job_preference', $job->id);
    }
    // ---------------------------------Store Job Code End-------------------------------------

    // ---------------------------------Edit Job Code Start-------------------------------------
    public function edit($id)
    {
        $job = Jobs::where('id', $id)->where('user_id', Auth::guard('jobportal')->user()->id)->first();
        if ($job) {
            return view('jobportal.jobs.edit', compact('job'));
        } else {
            return back()->with('error', 'Job Not Found');
        }
    }
    // ---------------------------------Edit Job Code End-------------------------------------

    // ---------------------------------Update Job Code Start-------------------------------------
    public function jobupdate(Request $request)
    {
        // return $request;
        $job = Jobs::find($request->id);
        $currency = Session::get('changed_currency') ? Session::get('changed_currency') : 'USD';
        switch ($request->type) {
            case 'title':
                $job->title = $request->title;
                break;

            case 'openings':
                $job->numberofpeople = $request->number_of_openings;
                break;

            case 'lang_country':
                $job->language = $request->language;
                $job->country = $request->country;
                break;

            case 'job_location':
                $job->type = $request->job_type;
                $job->city = $request->city;
                $job->area = $request->area;
                $job->address = $request->address;
                $job->pincode = $request->pincode;
                $job->adscity = $request->adscity;
                break;

            case 'job_type':
                $job->job_type = $request->job_type;
                break;

            case 'schedule':
                $job->schedule = $request->schedule;
                break;

            case 'pay':
                $job->pay = $request->pay; // Update pay type

                if ($request->pay === 'Exact Amount') {
                    $job->exactamount = $request->exactamount;
                } else {
                    $job->minimumamount = $request->minimumamount;
                    $job->maximumamount = $request->maximumamount;
                }
                $job->currency = $currency;
                $job->rate = $request->rate; // Update rate
                break;
            case 'supplement':
                $job->supplement = $request->supplement;
                break;
            case 'benefit':
                $job->benefit = $request->benefit;
                break;
            case 'description':
                $job->job_description = $request->job_description;
                break;
            case 'recruitment_timeline':
                $job->recruitment_timeline = $request->recruitment_timeline;
                break;
            default:
                return response()->json(['error' => 'Invalid update type'], 400);
        }
        $job->save();

        return response()->json(['message' => 'Job details updated successfully.']);
    }
    // ---------------------------------Update Job Code End-------------------------------------

    // ---------------------------------Review Job Code Start-------------------------------------
    public function review($id)
    {
        $job = Jobs::where('id', $id)->first();
        return view('jobportal.jobs.review', compact('job'));
    }
    // ---------------------------------Review Job Code End-------------------------------------

    // ---------------------------------Job Preference Code Start-------------------------------------
    public function preference($id)
    {
        $job = Jobs::where('id', $id)->first();
        return view('jobportal.jobs.preference', compact('job'));
    }
    // ---------------------------------Job Preference Code End-------------------------------------

    // ---------------------------------Job PreferenceSave Code Start-------------------------------------
    public function savepreferences(Request $request)
    {

        $request->validate([
            'email' => 'required|array',
            'email.*' => ' string',
            'job_id' => 'required|integer',
            'requirecv' => 'required'
        ]);
        if ($request->deadline == 'yes') {
            $request->validate([
                'deadlinetime' => 'required|date'
            ]);
        }
        $sendmail = $request->sendmail ? 1 : 0;
        $contactmail = $request->contactmail ? 1 : 0;

        $preference = JobPreference::updateOrCreate(['job_id' => $request->job_id], [
            'email' => json_encode($request->email),
            'contactmail' => $contactmail,
            'sendmail' => $sendmail,
            'job_id' => $request->job_id,
            'requirecv' => $request->requirecv,
            'deadline' => $request->deadline,
            'deadlinetime' => $request->deadlinetime,
        ]);
        if ($preference) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Preferences saved successfully.'
                ]);
            } else {
                return redirect()->route('jobportal.job_review', $request->job_id)->with('success', 'Preferences saved successfully.');
            }
        }
    }
    // ---------------------------------Job PreferenceSave Code End-------------------------------------

    // ---------------------------------Skill Code Start-------------------------------------
    public function skills($id)
    {
        $job = Jobs::findOrFail($id);
        return view('jobportal.jobs.skills', compact('job'));
    }
    // ---------------------------------Skill Code Edn-------------------------------------

    // ---------------------------------Get Skill Code Start-------------------------------------
    public function getskills()
    {
        $skills = JobportalSkill::all();
        return response()->json($skills);
    }
    // ---------------------------------Get Skill Code End-------------------------------------

    // ---------------------------------Job Skill Code Start-------------------------------------
    public function addskill(Request $request)
    {
        $request->validate([
            'skill' => 'required|array',
            'skill.*' => 'string'
        ]);
        $count = count($request->skill);
        for ($i = 0; $i < $count; $i++) {
            $existingSkill = JobSkill::where('job_id', $request->job_id)->where('skill', $request->skill[$i])->first();
            if (!$existingSkill) {
                JobSkill::create([
                    'job_id' => $request->job_id,
                    'skill' => $request->skill[$i],
                ]);
            }
        }
        return redirect()->route('jobportal.job_precsreen', $request->job_id)->with('success', 'Skill Added Successfully!');
    }
    // ---------------------------------Job Skill Code End-------------------------------------

    // ---------------------------------Precsreen Code Start-------------------------------------
    public function precsreen($id)
    {
        $skills = JobSkill::where('job_id', $id)->get();
        $job = Jobs::where('id', $id)->first();
        return view('jobportal.jobs.prescreen', compact('skills', 'job'));
    }
    // ---------------------------------Precsreen Code Start-------------------------------------

    // ---------------------------------Precsreen Store Code Start-------------------------------------
    public function precsreensave(Request $request)
    {
        $typecount = count($request->type);
        for ($i = 0; $i < $typecount; $i++) {
            $questionType = $request->type[$i];

            switch ($questionType) {
                case 'education':
                    JobportalPrescreenQuestion::create([
                        'job_id' => $request->job_id,
                        'type' => 'education',
                        'education' => $request->education,
                    ]);
                    break;

                case 'experience':
                    $existingexperience = JobportalPrescreenQuestion::where('job_id', $request->job_id)->where('type', 'experience')->first();
                    if (!$existingexperience) {
                        for ($j = 0; $j < count($request->year); $j++) {
                            JobportalPrescreenQuestion::create([
                                'job_id' => $request->job_id,
                                'type' => 'experience',
                                'year' => $request->year[$j] ?? null,
                                'field' => $request->field[$j] ?? null,
                            ]);
                        }
                    }
                    break;

                case 'language':
                    $existinglanguage = JobportalPrescreenQuestion::where('job_id', $request->job_id)->where('type', 'language')->first();
                    if (!$existinglanguage) {
                        for ($l = 0; $l < count($request->language); $l++) {
                            JobportalPrescreenQuestion::create([
                                'job_id' => $request->job_id,
                                'type' => 'language',
                                'language' => $request->language[$l] ?? null,
                            ]);
                        }
                    }
                    break;

                case 'certificate':
                    $existingcertificate = JobportalPrescreenQuestion::where('job_id', $request->job_id)->where('type', 'certificate')->first();
                    if (!$existingcertificate) {
                        for ($c = 0; $c < count($request->certificate); $c++) {
                            JobportalPrescreenQuestion::create([
                                'job_id' => $request->job_id,
                                'type' => 'certificate',
                                'certificate' => $request->certificate[$c] ?? null,
                            ]);
                        }
                    }
                    break;

                case 'location':
                    JobportalPrescreenQuestion::create([
                        'job_id' => $request->job_id,
                        'type' => 'location',
                        'location' => $request->location ?? null,
                    ]);
                    break;

                case 'shift':
                    JobportalPrescreenQuestion::create([
                        'job_id' => $request->job_id,
                        'type' => 'shift',
                        'shift' => implode(',', $request->shift) ?? null,
                    ]);
                    break;

                case 'travel':
                    JobportalPrescreenQuestion::create([
                        'job_id' => $request->job_id,
                        'type' => 'travel',
                        'travel' => $request->travel ?? null,
                    ]);
                    break;

                case 'custom':
                    $existingcustom = JobportalPrescreenQuestion::where('job_id', $request->job_id)->where('type', 'custom')->first();
                    if (!$existingcustom) {
                        for ($cus = 0; $cus < count($request->custom_question); $cus++) {
                            JobportalPrescreenQuestion::create([
                                'job_id' => $request->job_id,
                                'type' => 'custom',
                                'custom_question' => $request->custom_question[$cus] ?? null,
                            ]);
                        }
                    }
                    break;
            }
        }

        return redirect()->route('jobportal.job_sponser', $request->job_id)->with('success', 'Questions saved successfully!');
    }
    // ---------------------------------Precsreen Store Code End-------------------------------------

    // ---------------------------------Sponser Page Code Start-------------------------------------
    public function sponser($id)
    {
        $job = Jobs::findOrFail($id);
        if ($job) {
            return view('jobportal.jobs.sponser', compact('job'));
        }
    }
    // ---------------------------------Sponser Page Code End-------------------------------------

    // ---------------------------------Sponser Store Code Start-------------------------------------
    public function sponserstore(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'duration' => 'required',
            'customdate' => 'nullable|date',
            'budget' => 'required',
            'budget_type' => 'required'
        ]);
        $lable = $request->addlabel ? true : false;
        $sponser = JobSponser::create([
            'job_id' => $request->job_id,
            'duration' => $request->duration,
            'customdate' => $request->customdate,
            'budget' => $request->budget,
            'currency' => $request->currency,
            'budget_type' => $request->budget_type,
            'addlabel' => $lable
        ]);
    }
    // ---------------------------------Sponser Store Code End-------------------------------------

    // ---------------------------------Payment Page Code Start-------------------------------------
    public function payment($id)
    {
        $sponser = JobSponser::where('job_id', $id)->first();
        return view('jobportal.jobs.payment', compact('sponser'));
    }
    // ---------------------------------Payment Page Code End-------------------------------------

    // ----------------------------get country code state------------------------------------------
    public function get_state_country(Request $request)
    {
        $city = Allcity::where('name', $request->city)->first();

        if ($city) {
            $state = Allstate::where('id', $city->state_id)->first();
            $country = Allcountry::where('id', $state->country_id)->first();
            // return $country;
            if ($state && $country) {
                $data['status'] = "True";
                $data['city_id'] = $city->name;
                $data['state'] = $state->name;
                $data['state_id'] = $state->name;
                $data['country'] = $country->name;
                $data['country_id'] = $country->name;
            } else {
                $data['status'] = "False";
                $data['msg'] = "State And Country Not Found";
            }
        } else {
            $data['status'] = "False";
            $data['msg'] = "City Not Found";
        }
        return response()->json($data);
    }
    // ----------------------------get country code end------------------------------------------

    // --------------------------------------Update Job Status Code Start-----------------------
    public function statusUpdate(Request $request)
    {
        $job = Jobs::findOrFail($request->id);
        $job->status = $request->value;
        $job->save();
        return response()->json(['message' => 'Status Updated Succesfully', 'status' => 200]);
    }
    // --------------------------------------Update Job Status Code End-----------------------

    // --------------------------------------resume for Job Code Start-------------------------
    public function contactinfo($id)
    {
        $id = base64_decode($id);
        $user = Auth::guard('jobportal')->user();
        $existingData = JobportalCandidate::where('job_id', $id)->where('user_id', $user->id,)->first();
        if (!$existingData) {
            return view('jobportal.front.jobs.contact-info', compact('id'));
        } else {
            return redirect()->route('jobportal.frontjob')->with('success', 'You`ve applied to this job');
        }
    }
    public function updateinfo(Request  $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user = Auth::guard('jobportal')->user();
        $user->name = $request->name;
        $user->country_code = $request->country_code;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->save();
        return redirect()->route('jobportal.resume', $id);
    }
    public function resume($id)
    {;
        $job = Jobs::where('id', $id)->first();
        $file = JobportalResume::where('user_id', Auth::guard('jobportal')->user()->id)->first();
        $resume = BuildResume::where('user_id', Auth::guard('jobportal')->user()->id)->first();
        if ($file || $resume) {
            return view('jobportal.front.jobs.applyforjob', compact('id', 'job', 'file'));
        } else {
            return view('jobportal.front.jobs.resume', compact('id'));
        }
    }
    public function resumeupload(Request $request, $id)
    {
        $job = Jobs::findOrFail($id);
        if ($request->resume_type == 'upload') {
            $request->validate([
                'resume' => 'required|max:2048'
            ]);
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $fileName = $file->getClientOriginalname();
                $file->move(public_path('jobportal/resume'), $fileName);
                $resume = JobportalResume::updateOrCreate(['user_id' => Auth::guard('jobportal')->user()->id], [
                    'user_id' => Auth::guard('jobportal')->user()->id,
                    'resume' => $fileName,
                    'status' => 1
                ]);
                $user = Auth::guard('jobportal')->user();
                JobPortalUser::where('id', $user->id)->update([
                    'resume' => 'upload'
                ]);
                $jobs = JobportalPrescreenQuestion::where('job_id', $id)->first();
                if ($jobs) {
                    return redirect()->route('prescreentest', $id);
                }
                return redirect()->route('jobportal.resume', $id);
            }
        } else {
            return redirect()->route('jobportal.build_resume');
        }
    }
    public function applyJob(Request $request)
    {
        $jobId = $request->job_id;
        $user = Auth::guard('jobportal')->user();
        JobportalCandidate::create([
            'job_id' => $jobId,
            'user_id' => $user->id,
            'resume_type' => $user->resume
        ]);
        SavedJob::create([
            'job_id' => $jobId,
            'user_id' => $user->id,
            'status' => 'applied'
        ]);
        return redirect()->route('jobportal.frontjob')->with('success', 'Applied Successfully!');
    }
    // --------------------------------------resume for Job Code End---------------------------

    // -------------------------------------Employee Job Filter Code Start --------------------

    public function empJobFilter(Request $request)
    {
        $status = $request->status;
        switch ($status) {
            case 'open':
                $jobs = Jobs::where('user_id', Auth::guard('jobportal')->user()->id)->where('status', '!=', 'Close')->get();
                break;
            case 'close':
                $jobs = Jobs::where('user_id', Auth::guard('jobportal')->user()->id)->where('status',  'Close')->get();
                break;
        }
        return view('jobportal.jobs.jobfilter', compact('jobs'))->render();
    }
    public function prescreentest($id)
    {
        $jobs = JobportalPrescreenQuestion::where('job_id', $id)->get();
        $currentjob = Jobs::findOrFail($id);
        return view('jobportal.front.jobs.prescreen', compact('jobs', 'currentjob'));
    }
    public function prescreentestsave(Request $request, $id)
    {
        // return $request;

        $count = count($request->question);
        for ($i = 0; $i < $count; $i++) {
            UserPrescreenAnswer::create([
                'question_id' => $request->question_id[$i],
                'job_id' => $request->job_id,
                'user_id' => Auth::guard('jobportal')->user()->id,
                'question' => $request->question[$i],
                'answer' => $request->answer[$i],
                'shifts' => $request->answer[$i] == 'shifts' ? implode(',', $request->shift) : '',
            ]);
        }
        return redirect()->route('jobportal.resume', $id);
    }
    public function saveJob(Request $request)
    {
        $userId = Auth::guard('jobportal')->user()->id;
        $jobId = $request->jobId;
        $savedJob = SavedJob::where('job_id', $jobId)
            ->where('user_id', $userId)
            ->first();

        if ($savedJob) {
            $savedJob->delete();
        } else {
            SavedJob::create([
                'job_id' => $jobId,
                'user_id' => $userId,
                'status' => 'saved'
            ]);
        }
        return response()->json(['message' => 'Job Saved Successfully']);
    }
    public function saveJobFilter(Request $request)
    {
        $status = $request->status;
        $userId = Auth::guard('jobportal')->user()->id;
        switch ($status) {
            case "saved":
                $candidates = SavedJob::with(['user', 'job'])
                    ->where('user_id', $userId)
                    ->where('status', $status)
                    ->get();
                break;

            case "applied":
                $candidates = JobportalCandidate::with(['user', 'job'])
                    ->where('user_id', $userId)
                    ->get();
                break;

            case "interview":
                $candidates = Interview::with(['user', 'job'])
                    ->where('user_id', $userId)
                    ->get();
                break;
            case "all":
                $savedJobs = SavedJob::with(['user', 'job'])
                    ->where('user_id', $userId)
                    ->get();

                $appliedJobs = JobportalCandidate::with(['user', 'job'])
                    ->where('user_id', $userId)
                    ->get();

                $interviews = Interview::with(['user', 'job'])
                    ->where('user_id', $userId)
                    ->get();

                $candidates = $savedJobs->merge($appliedJobs)->merge($interviews);
                break;
            default:
                break;
        }

        return view('jobportal.front.jobs.myjobfilter', compact('candidates'))->render();
    }
    public function searchJobs(Request $request)
    {
        $query = Jobs::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%')->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('lang')) {
            $query->where('language',$request->lang);
        }

        if ($request->filled('date')) {
            $days = match ($request->date) {
                '24 hours' => 1,
                '3 days' => 3,
                '7 days' => 7,
                '30 days' => 30,
                default => null,
            };

            if ($days) {
                // Ensure the date comparison works with correct timezone
                $query->where('created_at', '>=', now()->subDays($days)->toDateTimeString());
            }
        }

        if ($request->filled('minimum') || $request->filled('maximum')) {
            $minimum = $request->minimum; // Minimum salary
            $maximum = $request->maximum; // Maximum salary

            // Build the query with proper checks
            $query->where(function ($q) use ($minimum, $maximum) {
                // If minimum salary is provided
                if ($minimum) {
                    $q->where('minimumamount', '>=', $minimum); // Check if minimumamount is greater than or equal to the specified minimum salary
                }

                // If maximum salary is provided
                if ($maximum) {
                    $q->where('maximumamount', '<=', $maximum); // Check if maximumamount is less than or equal to the specified maximum salary
                }

                // Check if exactamount is within the specified range (if both minimum and maximum are provided)
                if ($minimum && $maximum) {
                    $q->orWhere(function ($q) use ($minimum, $maximum) {
                        $q->where('exactamount', '>=', $minimum)
                          ->where('exactamount', '<=', $maximum);
                    });
                }
            });
        }


        if ($request->filled('job_type')) {
            $jobTypes = is_array($request->job_type) ? $request->job_type : [$request->job_type];
            $jobTypes = array_map('trim', $jobTypes); // Trim any extra spaces

            // Initialize the query
            foreach ($jobTypes as $jobType) {
                // Use JSON_CONTAINS to check if the job_type JSON contains the value
                $query->orWhereRaw("JSON_CONTAINS(job_type, ?)", [json_encode([$jobType])]);
            }
        }


        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $jobs = $query->get();
        return view('jobportal.jobs.jobfilter', compact('jobs'))->render();
    }
    public function myjobstatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;
        $job = SavedJob::findOrFail($id);
        $job->status = $status;
        $job->save();
        return response()->json([$status]);
    }

    public function notintrested(Request $request) {
        $jobId = $request->job_id;
        $userId = Auth::guard('jobportal')->user()->id;
        NoIntrestJob::create([
            'job_id'=> $jobId,
            'user_id' => $userId
        ]);
        return response()->json(['success'],200);
    }
}
