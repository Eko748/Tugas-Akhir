<?php

namespace App\Http\Controllers\Management;

use App\Exports\ProjectsExport;
use App\Models\Institute;
use App\Models\Project;
use App\Models\ProjectSLR;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProjectSLRController extends ProjectController
{
    public function showProjectDetail($uuid_project)
    {
        if (Auth::user()->role_id == '1') {
            $project = Project::with('hasProject')->where('uuid_project', $uuid_project)
                ->where('created_by', Auth::user()->id)->firstOrFail();
        } else {
            $project = Project::with('hasProject', 'getLeader')->where('uuid_project', $uuid_project)
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })->firstOrFail();
        }

        if (!$project) {
            abort(404);
        }

        $data = [
            'parent' => 'Project',
            'child' => 'Detail',
            'title' => $project->title,
            'project' => $project,
            'uuid_project' => $project->uuid_project
        ];

        return view('pages.management.project-slr.index', $data);
    }

    public function getProjectDetailData(Request $request, $uuid_project)
    {
        if ($request->ajax()) {
            if (Auth::user()->role_id == '1') {
                $data = ProjectSLR::with('getProject', 'getUser', 'getCategory')
                    ->whereHas('getProject', function ($q) use ($uuid_project) {
                        $q->where('uuid_project', $uuid_project);
                    })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'DESC')->get();
            } else {
                $data = ProjectSLR::with('getProject.getLeader', 'getUser', 'getCategory')
                    ->whereHas('getProject', function ($q) use ($uuid_project) {
                        $q->where('uuid_project', $uuid_project);
                    })->whereHas('getProject.getLeader', function ($q) {
                        $q->where('id', Auth::user()->created_by);
                    })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'DESC')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('fiture', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                            <button title="Backward Snowballing" class="btn cool review-go btn-primary btn-outline-dark hovering shadow-sm" onclick="snowBalling(' . $data->id . ')">
                                <i class="fa fa-address-book"></i>
                            </button>
                        </div>';
                    return $btn;
                })->addColumn('action', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                    <button title="Backward Snowballing" class="mb-2 review-go btn-warning btn-outline-dark" onclick="snowBalling(' . $data->id . ')">
                        <i class="fa fa-address-book"></i>
                    </button>
                            <button title="View Detail" class="mb-2 review-go btn-info btn-outline-dark" onclick="showDetail(' . $data->id . ')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button title="Delete" class="review-go btn-danger btn-outline-dark" id="deleteSLR" data-id="' . $data->id . '">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>';
                    return $btn;
                })->addColumn('article', function ($data) {
                    $title = $data->title;
                    return $title;
                })->addColumn('name', function ($data) {
                    $created = $data->getUser->name;
                    $name = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $created . '</span>';
                    return $name;
                })->addColumn('date', function ($data) {
                    $date = $data->created_at;
                    $parse = Carbon::parse($date)->isoFormat('LLLL');
                    $date = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $date;
                })
                ->rawColumns(['fiture', 'action', 'article', 'name', 'date'])
                ->make(true);
        }
    }

    public function exportProjectData($uuid_project)
    {
        if (Auth::user()->role_id == '1') {
            $project = Project::where('uuid_project', $uuid_project)
                ->where('created_by', Auth::user()->id)
                ->firstOrFail();
            $institute = Institute::with('getUser')->where('created_by', Auth::user()->id)->first();
        } else {
            $project = Project::with('getLeader')->where('uuid_project', $uuid_project)
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->firstOrFail();
            $institute = Institute::with('getUser', 'getLeader')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->first();
        }

        $fileName = $institute->institute_slug . '-project.xlsx';
        $print = Excel::download(new ProjectsExport($project), $fileName);
        return $print;
    }

    public function showModalSnowballing(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.management.project-slr.content.components.4-modal-snowballing', $this->getDetailData($request));
        }
    }

    public function showModalDetail(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.management.project-slr.content.components.5-modal-detail', $this->getDetailData($request));
        }
    }

    private function getDetailData(Request $request)
    {
        $views = ProjectSLR::with('getProject', 'getUser', 'getCategory')
            ->where('id', $request->code)->first();
        $data = [
            'views' => $views,
        ];
        return $data;
    }

    public function deleteProjectSLR(Request $request)
    {
        $delete = ProjectSLR::find($request->id)->update([
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now()
        ]);

        if ($delete == 1) {
            $success = true;
            $message = "Project Berhasil dihapus";
        } else {
            $success = false;
            $message = "Proses Tidak berjalan!";
        }

        return response()->json([
            's' => $success,
            'e' => $message,
        ]);
    }
}
