<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interface\RecycleController;
use App\Models\ProjectSLR;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Yajra\DataTables\Facades\DataTables;

class RecycleProjectController extends Controller
{
    private string $parent = 'Recycle';
    private string $child = 'Project';
    private array $data;

    public function __construct()
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
        ];
    }

    public function showRecycleProject()
    {
        return view('pages.recycle.project.index', $this->data);
    }

    public function requestRecycleData(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role_id == '1') {
                $data = ProjectSLR::with('getProject', 'getDeletedData', 'getUser')
                    ->whereHas('getProject', function ($q) {
                        $q->where('created_by', Auth::user()->id);
                    })->where('deleted_by',)
                    ;
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
                        <i class="fa fa-pencil"></i>
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
                    $deleted = $data->getDeletedData->name;
                    $name = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $deleted . '</span>';
                    return $name;
                })->addColumn('date', function ($data) {
                    $date = $data->deleted_at;
                    $parse = Carbon::parse($date)->isoFormat('LLLL');
                    $date = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $date;
                })
                ->rawColumns(['fiture', 'action', 'article', 'name', 'date'])
                ->make(true);
        }
    }

    // public function showModalDetail(Request $request)
    // {
    //     if ($request->ajax()) {
    //         return view('pages.recycle.project.content.components.5-modal-detail', $this->getDetailData($request));
    //     }
    // }

    // private function getDetailData(Request $request)
    // {
    //     $views = ProjectSLR::with('getProject', 'getUser', 'getCategory')
    //         ->where('id', $request->code)->first();
    //     $data = [
    //         'views' => $views,
    //     ];
    //     return $data;
    // }

    // public function deleteProjectSLR(Request $request)
    // {
    // }
}
