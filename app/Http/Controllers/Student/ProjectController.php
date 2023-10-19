<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    function show()
    {
//$project = Project::find(1);

        return Inertia::render('Student/Project/ProjectView', [
//            'project' => $project,
        ]);
    }
}
