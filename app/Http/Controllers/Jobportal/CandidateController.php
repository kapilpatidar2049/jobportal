<?php

namespace App\Http\Controllers\Jobportal;

use App\Http\Controllers\Controller;
use App\Models\Jobportal\BuildResume;
use App\Models\Jobportal\Certification;
use App\Models\Jobportal\Education;
use App\Models\Jobportal\Interview;
use App\Models\Jobportal\JobportalCandidate;
use App\Models\Jobportal\JobportalNotification;
use App\Models\Jobportal\Jobs;
use App\Models\Jobportal\SavedJob;
use App\Models\Jobportal\UserSkills;
use App\Models\Jobportal\WorkExperience;
use App\Models\JobPortalUser;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    // -------------------------------------Candidates list code Start----------------------------
    public function index(Request $request)
    {
        $userId = Auth::guard('jobportal')->user()->id;
        if ($request->id) {
            $job = Jobs::where('id', $request->id)->first();
            $candidates = JobportalCandidate::with(['user', 'job'])
                ->whereHas('job', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->where('job_id', $request->id)
                ->get();

            return view('jobportal.candidates.index', compact('candidates', 'job'));
        } else {
            $candidates = JobportalCandidate::with(['user', 'job'])
                ->whereHas('job', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->get();
            return view('jobportal.candidates.index', compact('candidates'));
        }
    }
    // -------------------------------Filter Code Start--------------------------------------
    public function filter(Request $request)
    {
        $filter = $request->filter;
        $userId = Auth::guard('jobportal')->user()->id;
        if ($request->id) {
            switch ($filter) {
                case 'active':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('job_id', $request->id)
                        ->get();
                    break;
                case 'shortlist':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('job_id', $request->id)
                        ->where('intrested', 1)
                        ->get();
                    break;

                case 'awaiting review':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('job_id', $request->id)
                        ->where('intrested', null)
                        ->get();
                    break;

                case 'reviewed':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('job_id', $request->id)
                        ->where('intrested', '!=', null)
                        ->get();
                    break;

                case 'rejected':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('job_id', $request->id)
                        ->where('intrested', 0)
                        ->get();
                    break;

                case 'hired':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('job_id', $request->id)
                        ->where('hired', 1)
                        ->get();
                    break;

                default:
                    break;
            }
        } else {
            switch ($filter) {
                case 'active':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->get();
                    break;
                case 'shortlist':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('intrested', 1)
                        ->get();
                    break;

                case 'awaiting review':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('intrested', null)
                        ->get();
                    break;

                case 'reviewed':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('intrested', '!=', null)
                        ->get();
                    break;

                case 'rejected':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('intrested', 0)
                        ->get();
                    break;

                case 'hired':
                    $candidates = JobportalCandidate::with(['user', 'job'])
                        ->whereHas('job', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->where('hired', 1)
                        ->get();
                    break;

                default:
                    break;
            }
        }
        return view('jobportal.candidates.candidatefilter', compact('candidates'));
    }
    // -------------------------------Filter Code End--------------------------------------

    // -------------------------------Shortlist Code Start--------------------------------------
    public function shortlisted(Request $request)
    {
        $id = $request->id;
        $candidate = JobportalCandidate::findOrFail($id);
        $candidate->intrested = $request->intrested;
        $candidate->save();

        $job = Jobs::where('id', $candidate->job_id)->first();


        if ($request->intrested == 1) {
            JobportalNotification::create([
                'user_id' => $candidate->user_id,
                'message' => 'You have been selected for ' . $job->title
            ]);
            return response()->json(['shortlisted' => true]);
        } else {
            JobportalNotification::create([
                'user_id' => $candidate->user_id,
                'message' => 'You have been Rejected for ' . $job->title
            ]);
            return response()->json(['shortlisted' => false]);
        }
    }
    // -------------------------------Shortlist Code End--------------------------------------
    public function candidateProfile($id)
    {
        $userId = Auth::guard('jobportal')->user()->id;
        $candidate = JobportalCandidate::with(['user', 'job'])
            ->whereHas('job', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('id', $id)
            ->first();
        $job = Jobs::where('id', $candidate->job_id)->first();

        JobportalNotification::create([
            'user_id' => $candidate->user_id,
            'message' => 'Your Application for ' . $job->title . ' viwed by Employeer'
        ]);

        return view('jobportal.candidates.details', compact('candidate'));
    }
    public function sertupInterview(Request $request)
    {
        $id = $request->id;
        $date = $request->date;
        $time = $request->time;
        $candidate = new Interview;
        $candidate->interview = 1;
        $candidate->interview_date = $date;
        $candidate->interview_time = $time;
        $candidate->status = 'interviewing';
        $candidate->save();
        Interview::create([
            'job_id' => $candidate->job_id,
            'user_id' => $candidate->user_id,
            'interview_date' => $date,
            'interview_time' => $time,
            'status' => 'interview'
        ]);
        return response()->json(['message' => 'Setup interview successfully']);
    }
    public function download($id)
    {
        $resume = BuildResume::findOrFail($id);
        $user = JobPortalUser::findOrFail($resume->user_id);
        $workExperience = WorkExperience::where('resume_id', $id)->get();
        $educations = Education::where('resume_id', $id)->get();
        $skills = UserSkills::where('resume_id', $id)->get();
        $certificates = Certification::where('resume_id', $id)->get();
        $pdf = PDF::loadView('jobportal.candidates.resume', compact('workExperience', 'educations', 'skills', 'certificates', 'resume', 'user'));
        return $pdf->download($resume->name . '.pdf');
    }
    public function interview()
    {
        $userId = Auth::guard('jobportal')->user()->id;
        $candidates = Interview::with(['user', 'job'])
            ->whereHas('job', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('interview', 1)
            ->get();
        return view('jobportal.candidates.interview', compact('candidates'));
    }
    public function getHired(Request $request)
    {
        $id = $request->id;
        $candidate = JobportalCandidate::findOrFail($id);
        $candidate->hired = $request->hired;
        $candidate->save();

        SavedJob::create([
            'job_id' => $candidate->job_id,
            'user_id' => $candidate->user_id,
            'status' => 'hired'
        ]);

        if ($candidate->hired == 1) {
            return response()->json(['hired' => true]);
        } else {
            return response()->json(['hired' => false]);
        }
    }
    public function myjobs()
    {
        $userId = Auth::guard('jobportal')->user()->id;

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
        // return $candidates;
        return view('jobportal.front.jobs.myjob', compact('candidates'));
    }

    public function interviewFilter(Request $request)
    {
        $userId = Auth::guard('jobportal')->user()->id;
        $status = $request->status;
        // dd();
        switch ($status) {
            case 'upcoming':
                $candidates = Interview::with(['user', 'job'])
                    ->whereHas('job', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })
                    ->where('interview_date', '>=', date('Y-m-d'))
                    ->get();
                break;

            case 'expire':
                $candidates = Interview::with(['user', 'job'])
                    ->whereHas('job', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })
                    ->where('interview_date', '<', date('Y-m-d'))
                    ->get();
                break;

            default:
                break;
        }
        // dd($candidates);
        return view('jobportal.candidates.interviewfilter', compact('candidates'))->render();
    }
}
