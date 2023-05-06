<?php

namespace App\Http\Controllers\Management;

use App\Exports\ProjectsExport;
use App\Models\Institute;
use App\Models\Project;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends ManagementController
{
    private string $page = 'Project';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showProject()
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->page,
        ];
        return view('pages.management.project-slr.index', $this->data);
    }

    public function requestReviewData(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role_id == 1) {
                $auth = Auth::user()->id;
                $data = Review::whereHas('getProject', function ($q) use ($auth) {
                    $q->where('created_by', $auth);
                })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'DESC')->get();
            } else {
                $auth = Auth::user()->created_by;
                $data = Review::whereHas('getProject', function ($q) use ($auth) {
                    $q->where('leader_id', $auth);
                })->whereHas('getProject.getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'DESC')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
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
                })->addColumn('info', function ($data) {
                    $created = $data->getUser->name;
                    $name = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $created . '</span>';
                    $info = $data->created_at;
                    $parse = Carbon::parse($info)->isoFormat('LLLL');
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $name . '<br>' . $info;
                })
                ->rawColumns(['fiture', 'action', 'article', 'info'])
                ->make(true);
        }
    }

    public function exportProjectData()
    {
        if (Auth::user()->role_id == '1') {
            $project = Project::where('created_by', Auth::user()->id)
                ->firstOrFail();
            $institute = Institute::with('getUser')->where('created_by', Auth::user()->id)->first();
        } else {
            $project = Project::whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->firstOrFail();
            $institute = Institute::with('getUser', 'getLeader')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->first();
        }
        if ($institute == null) {
            $prefix = 'review';
        } else {
            $prefix = $institute->institute_slug;
        }

        $fileName = $prefix . '-project.xlsx';
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
        try {
            $hashedId = $request->code;
            $views = Review::with('getProject', 'getCategory')
                ->get();
            $detail = null;
            foreach ($views as $view) {
                $hash = hash('sha256', $view->id); // hashing nilai id pengguna untuk membandingkan dengan nilai hash yang diterima
                if ($hash === $hashedId) {
                    $detail = $view;
                    break;
                }
            }
            if (!$detail) {
                return response()->json(['error' => 'User not found.'], 404);
            }
            $data = [
                'views' => $detail,
            ];
            return $data;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function deleteReview(Request $request)
    {
        $delete = Review::find($request->id)->update([
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
