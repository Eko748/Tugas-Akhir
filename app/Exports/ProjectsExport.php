<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\ProjectSLR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProjectsExport implements FromView
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function view(): View
    {
        $projects = ProjectSLR::with('getProject', 'getUser', 'getCategory')
            ->where('project_id', $this->project->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $data = [
            "projects" => $projects,
        ];

        return view('exports.projects', $data);
    }
}
