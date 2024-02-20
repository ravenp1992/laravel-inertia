<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Inertia\Inertia;

class ProjectController extends Controller
{
    private ProjectRepository $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $projects = $this->repository->latest();

        return Inertia::render('Project/Index', ['projects' => $projects]);
    }

    public function create()
    {
        return Inertia::render('Project/Create');
    }

    public function show(Project $project)
    {
        $project = $this->repository->findById($project->id);

        return Inertia::render('Project/Show', ['project' => $project]);
    }

    public function store(ProjectStoreRequest $request)
    {
        $this->repository->create($request->only(['name', 'description']));

        return redirect()->route('projects.index');
    }

    public function update(Project $project, ProjectUpdateRequest $request)
    {
        $this->repository->update($project->id, $request->only(['name', 'description']));

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $this->repository->delete($project->id);

        return redirect()->route('projects.index');
    }
}
