<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\ScrapedData;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;


class ProjectsExport implements FromView
{
    protected $project;
    private array $data;

    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->data = [
            'projects' => $this->exportProjectScraping()['projects']
        ];
    }

    public function view(): View
    {
        return view('exports.projects', $this->data);
    }

    private function exportProjectScraping()
    {
        $user_id = Auth::user()->created_by;

        if (Auth::user()->role_id == '1') {
            $projects = ScrapedData::with('getProject', 'getUser', 'getCategory')
                ->where('project_id', $this->project->id)
                ->where('deleted_by', null)
                ->orderBy('code', 'ASC')
                ->get();
        } else {
            $projects = ScrapedData::with('getProject.getLeader', 'getUser', 'getCategory')
                ->where('project_id', $this->project->id)
                ->whereHas('getProject', function ($q) use ($user_id) {
                    $q->whereHas('getLeader', function ($l) use ($user_id) {
                        $l->where('id', $user_id);
                    });
                })
                ->where('deleted_by', null)
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
