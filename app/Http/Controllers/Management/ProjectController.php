<?php

namespace App\Http\Controllers\Management;

use App\Exports\ProjectsExport;
use App\Models\{Institute, Project, Review};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends ManagementController
{
    private string $label = 'Project';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showProjectReview()
    {
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
        ];
        return view('pages.management.project.index', $this->data);
    }

    public function requestProjectReview(Request $request)
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
                    $delete = '<button title="Delete" class="ms-1 me-1 mb-2 review-go btn-danger btn-outline-dark" id="deleteSLR" data-id="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                    if (Auth::user()->role_id == 2) {
                        if ($data->created_by == Auth::user()->id) {
                            $btn_delete = $delete;
                        } else {
                            $btn_delete = '';
                        }
                    } elseif (Auth::user()->role_id == 1) {
                        $btn_delete = $delete;
                    }
                    $btn = '
                    <button title="View Detail" class="ms-1 me-1 mb-2 review-go btn-info btn-outline-dark" onclick="showDetail(' . $data->id . ')">
                        <i class="fa fa-address-book"></i>
                    </button><button title="Backward Snowballing" class="ms-1 me-1 mb-2 review-go btn-warning btn-outline-dark" onclick="snowBalling(' . $data->id . ')">
                        <i class="fa fa-share-square-o"></i>
                    </button>';
                    $button = '<div style="text-align: center; vertical-align: middle;">' . $btn . $btn_delete . '</div>';
                    return $button;
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

    public function getReviewSnowballing(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.management.project.content.components.4-modal-snowballing', $this->getProjectReviewData($request));
        }
    }

    public function getReviewDetail(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.management.project.content.components.5-modal-detail', $this->getProjectReviewData($request));
        }
    }

    public function deleteProjectReview(Request $request)
    {
        $delete = Review::find($request->id)->update([
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now()
        ]);

        if ($delete == 1) {
            $e = true;
            $message = "Project Berhasil dihapus";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }

        return response()->json(['e' => $e, 'status' => $message]);
    }

    public function exportProjectReview()
    {
        if ($this->getInstituteData()) {
            $ins = $this->getInstituteData()->institute_name;
            $ins_array = explode(' ', $ins);
            $prefix = Str::of($ins_array[0])->slug('');
        } else {
            $prefix = 'review';
        }

        $fileName = $prefix . '-project.xlsx';
        $print = Excel::download(new ProjectsExport($this->getProjectData()), $fileName);
        return $print;
    }
}
