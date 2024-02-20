<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()->latest()->get();

        return Inertia::render('Project/Index', ['projects' => $projects]);
    }

    public function create()
    {
        return Inertia::render('Project/Create');
    }

    public function show(Project $project)
    {
        return Inertia::render('Project/Show', ['project' => $project]);
    }

    public function store(ProjectStoreRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Project::query()->create([
            'name' => $request->name,
            'description' => $request->description ?? null
        ]);

        return redirect()->route('projects.index');
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $project->update([
            'name' => $request->name ?? $project->name,
            'description' => $request->description ?? $project->description
        ]);

        return redirect()->route('projects.index');
    }

    public function delete(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
