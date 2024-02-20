<?php

// This is over engineering for small apps lol

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends BaseRepository
{
    public function all()
    {
        return Project::all();
    }

    public function latest()
    {
        return Project::query()->latest()->get();
    }

    public function findById(int $id)
    {
        return Project::query()->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Project::query()->create([
            'name' => data_get($attributes, 'name'),
            'description' => data_get($attributes, 'description')
        ]);
    }

    public function update(int $id, array $attributes)
    {
        $project = $this->findById($id);

        $project->update([
            'name' => data_get($attributes, 'name', $project->name),
            'description' => data_get($attributes, 'description', $project->description),
        ]);

        return $project;
    }

    public function delete(int $id)
    {
        $project = $this->findById($id);

        return $project->delete();
    }

    // /**
    //  * @param array $attributes
    //  * @return void
    //  *
    //  * @throws MassAssignmentException
    //  */
    // public function create(array $attributes)
    // {
    //     Project::query()->create([
    //         'name' => data_get($attributes, 'name'),
    //         'description' => data_get($attributes, 'description')
    //     ]);
    // }

    // /**
    //  * @param Project $project
    //  * @param array $attributes
    //  * @return void
    //  * @throws MassAssignmentException
    //  */
    // public function update($project, array $attributes)
    // {
    //     $project->update([
    //         'name' => data_get($attributes, 'name', $project->name),
    //         'description' => data_get($attributes, 'description', $project->description),
    //     ]);
    // }

    // /**
    //  * @param Project $project
    //  * @return void
    //  */
    // public function delete($project)
    // {
    //     $project->delete();
    // }
}
