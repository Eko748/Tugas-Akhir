<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromView;


class ProjectsExport implements FromView
{
    protected $project;
    private array $data;

    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->data = [
            'projects' => $this->logicExportProject()['projects']
        ];
    }

    public function view(): View
    {
        return view('exports.projects', $this->data);
    }

    private function logicExportProject()
    {
        $user_id = Auth::user()->created_by;

        if (Auth::user()->role_id == '1') {
            $projects = Review::with('getProject', 'getUser', 'getCategory')
                ->where('project_id', $this->project->id)
                ->where('deleted_by', null)
                ->orderBy('code', 'ASC')
                ->get();
        } else {
            $projects = Review::with('getProject.getLeader', 'getUser', 'getCategory')
                ->where('project_id', $this->project->id)
                ->whereHas('getProject', function ($q) use ($user_id) {
                    $q->whereHas('getLeader', function ($l) use ($user_id) {
                        $l->where('id', $user_id);
                    });
                })
                ->orderBy('code', 'ASC')
                ->get();
        }

        $data = [
            'projects' => $projects,
            'loop' => $projects,
        ];

        return $data;
    }
}
