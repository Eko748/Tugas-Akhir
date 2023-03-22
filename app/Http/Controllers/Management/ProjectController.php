<?php

namespace App\Http\Controllers\Management;

use App\Exports\ProjectsExport;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Leader;
use App\Models\Project;
use App\Models\ProjectSLR;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    private $leader_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->leader_id = Auth::user()->created_by;
            return $next($request);
        });
    }

    public function getView(Request $request)
    {
        if (Auth::user()->role_id == "1") {
            $projects = Project::with('hasProject.getUser')->withCount('hasProject')
                ->where('created_by', Auth::user()->id)
                ->orderBy('priority', 'desc')
                ->paginate(2);
            $end = Project::with('hasProject.getUser')->withCount('hasProject')
                ->where('created_by', Auth::user()->id)
                ->orderBy('priority', "desc")
                ->get();
        } else {
            $projects = Project::with('getLeader', 'hasProject.getUser')->withCount('hasProject')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', $this->leader_id);
                })
                ->orderBy('priority', "desc")
                ->paginate(2);
            $end = Project::with('getLeader', 'hasProject.getUser')->withCount('hasProject')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', $this->leader_id);
                })
                ->orderBy('priority', "desc")
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $current_p = Carbon::now()->setTimezone('Asia/Jakarta');
        $end_p = $projects->pluck('end_date')->flatten()->max() ? 
        Carbon::parse($projects->pluck('end_date')->flatten()->max())->setTimezone('Asia/Jakarta') : null;

        $done = $end->where('end_date', '<=', $current_p);
        $perPage = 1;
        $currentPage = $request->page ?? 1;
        $page_done = new LengthAwarePaginator(
            $done->forPage($currentPage, $perPage),
            $done->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        $doing = $end->where('end_date', '>', $current_p);
        $perPage = 1;
        $currentPage = $request->page ?? 1;
        $page_doing = new LengthAwarePaginator(
            $doing->forPage($currentPage, $perPage),
            $doing->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        $data = [
            "parent" => "Management",
            "child" => "Project",
            "projects" => $projects,
            "current_p" => $current_p,
            "end_p" => $end_p,
            "done" => $page_done,
            "doing" => $page_doing,
        ];

        if ($request->ajax()) {
            if ($request->has('type') && $request->input('type') == 'projects') {
                return view('pages.management.project.content.components.2-data', $data)->render();
            } elseif ($request->has('type') && $request->input('type') == 'doing') {
                    return view('pages.management.project.content.components.3-data-doing', $data)->render();
            } elseif ($request->has('type') && $request->input('type') == 'done') {
                return view('pages.management.project.content.components.4-data-done', $data)->render();
            }
        }

        return view('pages.management.project.index', $data);
    }

    public function getProjectDetail($uuid_project)
    {
        if (Auth::user()->role_id == '1') {
            $project = Project::with('hasProject')->where('uuid_project', $uuid_project)
                ->where('created_by', Auth::user()->id)->firstOrFail();
        } else {
            $project = Project::with('hasProject', 'getLeader')->where('uuid_project', $uuid_project)
                ->whereHas('getLeader', function ($q){
                    $q->where('id', $this->leader_id);
                })->firstOrFail();
        }

        if (!$project) {
            abort(404);
        }

        $data = [
            "parent" => "Project",
            "child" => "Detail",
            "title" => $project->title,
            "project" => $project,
            "uuid_project" => $project->uuid_project
        ];

        return view('pages.management.project-slr.index', $data);
    }

    public function getProjectData(Request $request, $uuid_project)
    {
        if ($request->ajax()) {

            if (Auth::user()->role_id == '1') {
                $data = ProjectSLR::with('getProject', 'getUser', 'getCategory')
                    ->whereHas('getProject', function ($q) use ($uuid_project) {
                        $q->where('uuid_project', $uuid_project);
                    })
                    ->orderBy('created_at', 'DESC')->get();
            } else {
                $data = ProjectSLR::with('getProject.getLeader', 'getUser', 'getCategory')
                    ->whereHas('getProject', function ($q) use ($uuid_project) {
                        $q->where('uuid_project', $uuid_project);
                    })->whereHas('getProject.getLeader', function ($q){
                        $q->where('id', $this->leader_id);
                    })
                    ->orderBy('created_at', 'DESC')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                            <button title="Detail" class="btn btn-info btn-sm btn-outline-dark hovering shadow-sm" onclick="readMember(' . $data->id . ')">
                                <i class="fa fa-address-book"></i>
                            </button>
                            <button title="Edit" class="btn btn-secondary btn-sm btn-outline-dark hovering shadow-sm" onclick="editMember(' . $data->getUser->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateMember">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button title="Delete" class="btn btn-danger btn-s btn-outline-dark hovering shadow-sm" onclick="deleteMember(' . $data->id . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>';
                    return $btn;
                })->addColumn('article', function ($data) {
                    $title = $data->title;
                    return $title;
                })->addColumn('name', function ($data) {
                    $created = $data->getUser->name;
                    $name = '<span class="badge btn-outline-success hovering badge-light-success">' . $created . '</span>';
                    return $name;
                })->addColumn('date', function ($data) {
                    $date = $data->created_at;
                    $parse = Carbon::parse($date)->isoFormat('LLLL');
                    $date = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $date;
                })
                ->rawColumns(['action', 'article', 'name', 'date'])
                ->make(true);
        }
    }

    public function createProject(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'priority' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s', 'after:start_date'],
        ]);

        Project::create(
            [
                'uuid_project' => Str::uuid(),
                'leader_id' => $user->id,
                'title' => $request->title,
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

    public function getProject(Request $req)
    {
        $search = $req->q;

        if (Auth::user()->role_id == '1') {
            $projects = Project::where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->where('created_by', Auth::user()->id)
                ->orderBy('priority', 'asc')
                ->get();
        } else {
            $projects = Project::with('getLeader')->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->whereHas('getLeader', function ($q){
                    $q->where('id', $this->leader_id);
                })
                ->orderBy('priority', 'asc')
                ->get();
        }

        $response = [];
        foreach ($projects as $project) {
            $response[] = [
                'no' => $project->uuid_project,
                'id' => $project->id,
                'text' => $project->priority . '/' . $project->title
            ];
        }

        return response()->json($response);
    }

    public function exportProjectData($uuid_project)
    {

        if (Auth::user()->role_id == '1') {
            $project = Project::where('uuid_project', $uuid_project)
                ->where('created_by', Auth::user()->id)
                ->firstOrFail();
            $institute = Institute::with('getUser')->where('user_id', Auth::user()->id)->first();
        } else {
            $project = Project::with('getLeader')->where('uuid_project', $uuid_project)
                ->whereHas('getLeader', function ($q){
                    $q->where('id', $this->leader_id);
                })
                ->firstOrFail();
            $institute = Institute::with('getUser')->where('user_id', Auth::user()->id)->first();
        }

        $fileName = $institute->institute_slug . '-project.xlsx';
        $print = Excel::download(new ProjectsExport($project), $fileName);
        return $print;
    }
}
