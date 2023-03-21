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
        $user_id = Auth::user()->created_by;

        if (Auth::user()->role_id == '1') {
            $projects = ProjectSLR::with('getProject', 'getUser', 'getCategory')
                ->where('project_id', $this->project->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $projects = ProjectSLR::with('getProject.getLeader', 'getUser', 'getCategory')
                ->where('project_id', $this->project->id)
                ->whereHas('getProject', function ($q) use ($user_id) {
                    $q->whereHas('getLeader', function ($l) use ($user_id) {
                        $l->where('id', $user_id);
                    });
                })
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        $data = [
            "projects" => $projects,
        ];

        return view('exports.projects', $data);
    }
}
