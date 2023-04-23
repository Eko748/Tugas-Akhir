<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    private $data;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $logicProject = $this->setLogicProject($request);
            $this->data = [
                'parent' => 'Management',
                'child' => 'Project',
                'projects' => $logicProject['projects'],
                'current_p' => $logicProject['current_p'],
                'end_p' => $logicProject['end_p'],
                'done' => $logicProject['done'],
                'doing' => $logicProject['doing'],
            ];
            return $next($request);
        });
    }

    public function showProject()
    {
        return view('pages.management.project.index', $this->data);
    }

    public function requestProjectData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('type') && $request->input('type') == 'projects') {
                return view('pages.management.project.content.components.2-data', $this->data)->render();
            } elseif ($request->has('type') && $request->input('type') == 'doing') {
                return view('pages.management.project.content.components.3-data-doing', $this->data)->render();
            } elseif ($request->has('type') && $request->input('type') == 'done') {
                return view('pages.management.project.content.components.4-data-done', $this->data)->render();
            }
        }
    }

    private function setLogicProject(Request $request)
    {
        if (Auth::user()->id == 1) {
            $projects = Project::with('hasProject.getUser')->withCount('hasProject')
                ->where('created_by', Auth::user()->id)
                ->orderBy('priority', 'desc')
                ->paginate(9);
            $end = Project::with('hasProject.getUser')->withCount('hasProject')
                ->where('created_by', Auth::user()->id)
                ->orderBy('priority', "desc")
                ->get();
        } else {
            $projects = Project::with('getLeader', 'hasProject.getUser')->withCount('hasProject')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->orderBy('priority', "desc")
                ->paginate(9);
            $end = Project::with('getLeader', 'hasProject.getUser')->withCount('hasProject')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->orderBy('priority', "desc")
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $current_p = Carbon::now()->setTimezone('Asia/Jakarta');
        $end_p = $projects->pluck('end_date')->flatten()->max() ?
            Carbon::parse($projects->pluck('end_date')->flatten()->max())->setTimezone('Asia/Jakarta') : null;

        $done = $end->where('end_date', '<=', $current_p);
        $perPage = 2;
        $currentPage = $request->page ?? 1;
        $page_done = new LengthAwarePaginator(
            $done->forPage($currentPage, $perPage),
            $done->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        $doing = $end->where('end_date', '>', $current_p);
        $perPage = 2;
        $currentPage = $request->page ?? 1;
        $page_doing = new LengthAwarePaginator(
            $doing->forPage($currentPage, $perPage),
            $doing->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return [
            "projects" => $projects,
            "current_p" => $current_p,
            "end_p" => $end_p,
            "done" => $page_done,
            "doing" => $page_doing,
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

        Project::create(
            [
                'uuid_project' => Str::uuid(),
                'leader_id' => $user->id,
                'subject' => $request->subject,
                'priority' => $request->priority,
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
