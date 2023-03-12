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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('created_by', Auth::user()->id)->paginate(2);

        $data = [
            "parent" => "Management",
            "child" => "Project",
            "projects" => $projects,
        ];

        if ($request->ajax()) {
            return view('pages.management.project.content.components.2-data', $data)->render();
        }

        return view('pages.management.project.index', $data);
    }

    public function detail($uuid_project)
    {
        $project = Project::with('hasProject')->where('uuid_project', $uuid_project)
            ->where('created_by', Auth::user()->id)->firstOrFail();

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

    public function getTable(Request $request, $uuid_project)
    {
        if ($request->ajax()) {
            $project = Project::where('uuid_project', $uuid_project)
                ->where('created_by', Auth::user()->id)->firstOrFail();

            $data = ProjectSLR::with('getProject', 'getUser', 'getCategory')
                ->whereHas('getProject', function ($q) use ($uuid_project) {
                    $q->where('uuid_project', $uuid_project);
                })
                ->orderBy('created_at', 'DESC')->get();

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



    public function create(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'priority' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s', 'after:start_date'],
        ]);

        $project = Project::create(
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
        $projects = Project::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('priority', 'LIKE', '%' . $search . '%')
            ->orderBy('priority', 'asc')
            ->get();

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

    public function export($uuid_project)
    {
        $project = Project::where('uuid_project', $uuid_project)
            ->where('created_by', Auth::user()->id)
            ->firstOrFail();

        $institute = Institute::with('getUser')->where('user_id', Auth::user()->id)->first();
        $fileName = '-project.xlsx';
        $print = Excel::download(new ProjectsExport($project), $fileName);
        return $print;
    }
}
