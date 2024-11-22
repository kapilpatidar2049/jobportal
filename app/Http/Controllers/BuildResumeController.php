<?php

namespace App\Http\Controllers;

use App\Models\Jobportal\BuildResume;
use App\Models\Jobportal\Certification;
use App\Models\Jobportal\Education;
use App\Models\Jobportal\UserSkills;
use App\Models\Jobportal\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobportal.front.resume.buildresume');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            '_token' => 'required|string',
            'name' => 'required|string|max:255',
            'country_code' => 'required|string|max:5',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'degree' => 'required|array|min:1',
            'degree.*' => 'required|string|max:100',
            'degree_specialization' => 'required|array|min:1',
            'degree_specialization.*' => 'required|string|max:100',
            'institution' => 'required|array|min:1',
            'institution.*' => 'required|string|max:255',
            'year_of_passing' => 'required|array|min:1',
            'year_of_passing.*' => 'required|string|max:4',
            'percentage' => 'required|array|min:1',
            'percentage.*' => 'required|string|max:10',
            'start_date' => 'required|array|min:1',
            'start_date.*' => 'required|date',
            'end_date' => 'required|array|min:1',
            'end_date.*' => 'required|date',
            'achievements' => 'required|string',
            'job_title' => 'required|array|min:1',
            'job_title.*' => 'required|string|max:100',
            'company_name' => 'required|array|min:1',
            'company_name.*' => 'required|string|max:255',
            'job_type' => 'required|array|min:1',
            'job_type.*' => 'required|string|max:50',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'certificate' => 'required|array',
            'certificate.*' => 'required|string|max:50',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extention;
            $file->move(public_path('jobportal/user/'), $fileName);
            $resume = BuildResume::create([
                'user_id' => Auth::guard('jobportal')->user()->id,
                'image' => $fileName,
                'name' => $request->name,
                'contry_code' => $request->country_code,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'achievements' => $request->achievements,
            ]);
        } else {
            $resume =  BuildResume::create([
                'user_id' => Auth::guard('jobportal')->user()->id,

                'name' => $request->name,
                'contry_code' => '+91',
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'achievements' => $request->achievements,
            ]);
        }

        $educationCount = count($request->degree);
        for ($i = 0; $i < $educationCount; $i++) {
            Education::create([
                'resume_id' => $resume->id,
                'degree' => $request->degree[$i],
                'specialization' => $request->degree_specialization[$i],
                'insitution' => $request->institution[$i],
                'year_of_passing' => $request->year_of_passing[$i],
                'percentage' => $request->percentage[$i],
                'start_date' => $request->start_date[$i],
                'end_date' => $request->end_date[$i],
            ]);
        }
        $workCount = count($request->job_title);
        for ($j = 0; $j < $workCount; $j++) {
            WorkExperience::create([
                'resume_id' => $resume->id,
                'job_title' => $request->job_title[$j],
                'company_name' => $request->company_name[$j],
                'job_type' => $request->job_type[$j],
                'city' => $request->workcity[$j],
                'state' => $request->workstate[$j],
                'country' => $request->workcountry[$j],
                'end_date' => $request->workend_date[$j],
                'present' => $request->present[$j],
                'description' => $request->description[$j],
            ]);
        }
        $skillCount = count($request->skill);
        for ($k = 0; $k < $skillCount; $k++) {
            UserSkills::create([
                'resume_id' => $resume->id,
                'skills' => $request->skill[$k]
            ]);
        }
        $certificateCount = count($request->certificate);
        for ($c = 0; $c < $certificateCount; $c++) {
            Certification::create([
                'resume_id' => $resume->id,
                'certificate' => $request->certificate[$c]
            ]);
        }
        return redirect()->route('jobportal.build_resume.preview', $resume->id);
    }

    public function personalInformation(Request $request)
    {
        $resume = BuildResume::findOrFail($request->id);
        $request->validate([
            'dob' => 'required|date',
            'career_label' => 'required',
            'eligible_to_work' => 'required',
            'eligible_to_work' => 'required',
            'year_of_experience' => 'required',
        ]);
        $resume->dob = $request->dob;
        $resume->career_label = $request->career_label;
        $resume->eligible_to_work = implode(',', $request->eligible_to_work);
        $resume->industries = implode(',', $request->eligible_to_work);
        $resume->year_of_experience = $request->year_of_experience;
        $resume->save();
        return back()->with('success', 'Personal Information Upadted Successfully!');
    }

    public function personalInformationDelete(Request $request)
    {
        $resume = BuildResume::findOrFail($request->id);
        $resume->dob = null;
        $resume->career_label = null;
        $resume->eligible_to_work = null;
        $resume->industries = null;
        $resume->year_of_experience = null;
        $resume->save();
        return back()->with('error', 'Personal Information Removed!');
    }

    public function contactInformation(Request $request)
    {
        $resume = BuildResume::findOrFail($request->id);
        $resume->name = $request->name;
        $resume->contry_code = $request->country_code;
        $resume->phone = $request->phone;
        $resume->email = $request->email;
        $resume->address = $request->address;
        $resume->city = $request->city;
        $resume->state = $request->state;
        $resume->pincode = $request->pincode;
        $resume->country = $request->country;

        if ($request->hasFile('profile')) {
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $file->move(public_path('image/resume'), $name);
            $resume->image = $name;
        }
        $resume->save();
        return back()->with('success', 'Contact Information Updated Successfully');
    }

    public function summary(Request $request)
    {
        $resume = BuildResume::findOrFail($request->id);
        $resume->summary = $request->summary;
        $resume->save();
        return back()->with('success', 'Summary Updated successfully !');
    }

    public function experienceUpdate(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'job_type' => 'required',
            'description' => 'required',
            'workstart_date'=> 'required',
        ]);
        if($request->present)
        {
            $present = 1;
            $enddate = null;
        }else{
            $present = 0;
            $enddate = $request->workend_date;
        }
        $work = WorkExperience::findOrFail($request->id);

        $work->job_title = $request->job_title;
        $work->company_name = $request->company_name;
        $work->job_type = $request->job_type;
        $work->city = $request->workcity;
        $work->state = $request->workstate;
        $work->country = $request->workcountry;
        $work->start_date = $request->workstart_date;
        $work->end_date = $enddate;
        $work->present = $present;
        $work->description = $request->description;
        $work->save();
        return back()->with('success', 'Work Updated successfully !');
    }

    public function experiencecreate(Request $request)
    {
        // return $request;
        $request->validate([
            'job_title' => 'required',
            'company_name' => 'required',
            'job_type' => 'required',
            'description' => 'required',
            'workstart_date'=> 'required',
        ]);
        if($request->present)
        {
            $present = 1;
            $enddate = null;
        }else{
            $present = 0;
            $enddate = $request->work_end_date;
        }
        $work = new WorkExperience();
        $work->resume_id = $request->resume_id;
        $work->job_title = $request->job_title;
        $work->company_name = $request->company_name;
        $work->job_type = $request->job_type;
        $work->city = $request->workcity;
        $work->state = $request->workstate;
        $work->country = $request->workcountry;
        $work->start_date = $request->workstart_date;
        $work->end_date = $enddate;
        $work->present = $present;
        $work->description = $request->description;
        $work->save();
        return back()->with('success', 'Work Updated successfully !');
    }

    public function experienceDelete($id){
        $work = WorkExperience::findOrFail($id);
        $work->delete();
        return back()->with('success','Work Experience Deleted Successfully!');
    }

    public function updateEducation(Request $request){
        $request->validate([
            'degree' =>'required',
            'degree_specialization' =>'required',
            'institution' =>'required',
            'year_of_passing' =>'required',
            'percentage' =>'required',
            'start_date' =>'required|date',
            'end_date' =>'required|date',
        ]);
        $education = Education::findOrFail($request->id);
        $education->degree = $request->degree;
        $education->specialization = $request->degree_specialization;
        $education->insitution = $request->institution;
        $education->year_of_passing = $request->year_of_passing;
        $education->percentage = $request->percentage;
        $education->start_date = $request->start_date;
        $education->end_date = $request->end_date;
        $education->save();
        return back()->with('success','Education updated Successfully');
    }

    public function createEducation(Request $request){
        $request->validate([
            'degree' =>'required',
            'degree_specialization' =>'required',
            'institution' =>'required',
            'year_of_passing' =>'required',
            'percentage' =>'required',
            'start_date' =>'required|date',
            'end_date' =>'required|date',
        ]);
        $education = new Education;
        $education->resume_id = $request->resume_id;
        $education->degree = $request->degree;
        $education->specialization = $request->degree_specialization;
        $education->insitution = $request->institution;
        $education->year_of_passing = $request->year_of_passing;
        $education->percentage = $request->percentage;
        $education->start_date = $request->start_date;
        $education->end_date = $request->end_date;
        $education->save();
        return back()->with('success','Education Added Successfully');
    }

    public function deleteEducation($id){
        $education = Education::findorFail($id);
        $education->delete();
        return back()->with('success','Education Deleted Successfully');
    }

    public function deleteCertificate($id){
        $certificate = Certification::findOrFail($id);
        $certificate->delete();
        return back()->with('success','Certificate Deleted Successfully!');
    }
    public function deleteSkills($id){
        $skill = UserSkills::findOrFail($id);
        $skill->delete();
        return back()->with('success','Skill Deleted Successfully!');
    }

    public function addCretificate(Request $request){
        $request->validate([
            'certificate'=>'required'
        ]);
        $certificateCount = count($request->certificate);
        for ($c = 0; $c < $certificateCount; $c++) {
            Certification::create([
                'resume_id' => $request->id,
                'certificate' => $request->certificate[$c]
            ]);
        }
        return back()->with('success','Certifiacte Added Successfully!');
    }

    public function addSkills(Request $request){
        $request->validate([
            'skill'=>'required'
        ]);
        $skillCount = count($request->skill);
        for ($k = 0; $k < $skillCount; $k++) {
            UserSkills::create([
                'resume_id' => $request->id,
                'skills' => $request->skill[$k]
            ]);
        }
        return back()->with('success','Skills Added Successfully!');
    }

    public function searchableUpdate(Request $request){
        $user = Auth::guard('jobportal')->user();
        $user->searchable = $request->searchable;
        $user->save();
        return redirect()->route('jobpreferences');
    }
    /**
     * Display the specified resource.
     */
    public function show(BuildResume $buildResume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BuildResume $buildResume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BuildResume $buildResume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuildResume $buildResume)
    {
        //
    }
    public function preview($id)
    {
        $resume = BuildResume::findOrFail($id);
        return view('jobportal.front.resume.resumepreview', compact('resume'));
    }
    public function resumeType(Request $request){
        $user = Auth::guard('jobportal')->user();
        $user->resume = $request->resume_type;
        $user->save();
        return back()->with('success','Data Updated Successfully');
    }
    public function coverLatter(Request $request){
        $user = Auth::guard('jobportal')->user();
        $user->cover_latter = $request->cover_latter;
        $user->save();
        return back()->with('success','Data Updated Successfully');
    }
}
