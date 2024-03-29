<?php

namespace Database\Seeders;

use App\Models\Project;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('projects');

        $projects = Project::factory(10)->create();

        $projects->each(function (Project $project) {
            $project->users()->sync([1]);
        });
    }
}
