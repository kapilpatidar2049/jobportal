@extends('marketplace.layouts.master')
@section('title', 'Assign')
@section('page-title', 'Assign')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
    <div class="container">
        <h1>Create Milestone for Project {{ $project->name }}</h1>
    
        <form action="{{ route('milestones.store', $project->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Milestone Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Milestone</button>
        </form>
    </div>
    @endsection
    @section('scripts')

    @endsection