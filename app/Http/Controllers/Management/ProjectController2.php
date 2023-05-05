<?php

namespace App\Http\Controllers\Management;

use App\Models\Leader;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends ManagementController
{
    private string $child = 'Project';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showProject($uuid_project)
    {
        $this->data['uuid_project'] = $uuid_project;
        return view('pages.management.project.index', $this->data);
    }

    public function requestProjectData(Request $request)
    {
        if ($request->ajax()) {
            $logicProject = $this->setLogicProject($request);
            if ($request->has('type') && $request->input('type') == 'projects') {
                $this->data = [
                    'projects' => $logicProject['projects'],
                    'all_project' => $logicProject['all_project']
                ];
                return view('pages.management.project.content.components.2-data', $this->data)->render();
            } elseif ($request->has('type') && $request->input('type') == 'doing') {
                $this->data = [
                    'doing' => $logicProject['doing'],
                    'page_doing' => $logicProject['page_doing']
                ];
                return view('pages.management.project.content.components.3-data-doing', $this->data)->render();
            } elseif ($request->has('type') && $request->input('type') == 'done') {
                $this->data = [
                    'done' => $logicProject['done'],
                    'page' => $logicProject['page']
                ];
                return view('pages.management.project.content.components.4-data-done', $this->data)->render();
            }
        }
    }

    private function setLogicProject(Request $request)
    {
        $get = $this->getProjectData();

        $current_p = Carbon::now()->setTimezone('Asia/Jakarta');
        $done = $get['end']->where('end_date', '<=', $current_p);
        $perPage = 12;
        $currentPage = $request->page ?? 1;
        $page_done = new LengthAwarePaginator(
            $done->forPage($currentPage, $perPage),
            $done->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        $doing = $get['end']->where('end_date', '>', $current_p);
        $perPage = 12;
        $currentPage = $request->page ?? 1;
        $page_doing = new LengthAwarePaginator(
            $doing->forPage($currentPage, $perPage),
            $doing->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return [
            'parent' => $this->parent,
            'child' => $this->child,
            'projects' => $get['projects'],
            'all_project' => $get['all_project'],
            'doing' => $page_doing,
            'page_doing' => $doing,
            'done' => $page_done,
            'page' => $done,
        ];
    }

    public function createProject(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'subject' => ['required', 'string', 'max:50'],
            'priority' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s', 'after:start_date'],
        ]);
        $target = $request->target ? $request->target : 10;

        Project::create(
            [
                'uuid_project' => Str::uuid(),
                'leader_id' => $user->id,
                'subject' => $request->subject,
                'priority' => $request->priority,
                'target' => $target,
                'description' => $request->description,
                'status' => "1",
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'created_by' => Auth::user()->id,
            ]
        );

        return response()->json(['success' => 'Project berhasil ditambahkan']);
    }
}
