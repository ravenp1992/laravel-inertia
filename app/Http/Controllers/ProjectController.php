<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function index()
    {
        $projects = $this->projectRepository->latest();

        return Inertia::render('Project/Index', ['projects' => $projects]);
    }

    public function create()
    {
        return Inertia::render('Project/Create');
    }

    public function show(Project $project)
    {
        $project = $this->projectRepository->findById($project->id);

        return Inertia::render('Project/Show', ['project' => $project]);
    }

    public function store(ProjectStoreRequest $request)
    {
        $this->projectRepository->create($request->only(['name', 'description']));

        return redirect()->route('projects.index');
    }

    public function update(Project $project, ProjectUpdateRequest $request)
    {
        $this->projectRepository->update($project->id, $request->only(['name', 'description']));

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $this->projectRepository->delete($project->id);

        return redirect()->route('projects.index');
    }
}
