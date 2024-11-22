<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\marketplace\Milestone;
use App\Models\marketplace\Marketplace_project;

class MilestoneController extends Controller
{
    public function index($id)
    {
        $projectId = $id;
        $milestones = Milestone::where('project_id', $projectId)->get();
      return view('marketplace.assign.index',compact('milestones','projectId'));
    }

    public function create($projectId)
    {
       $project = Marketplace_project::where('id',$projectId)->first();
        return view('marketplace.assign.milestones', compact('project'));
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        Milestone::create([
            'user_id' => Auth::user()->id,
            'project_id' => $projectId,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('milestones.index', $projectId)
                         ->with('success', 'Milestone created successfully.');
    }
}
