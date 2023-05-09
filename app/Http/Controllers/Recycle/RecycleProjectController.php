<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Interface\RecycleData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RecycleProjectController extends RecycleController implements RecycleData
{
    private string $label = 'Project';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showRecycleData()
    {
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
        ];
        return view('pages.recycle.project.index', $this->data);
    }

    public function requestRecycleData(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->recycleProject();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div style="text-align: center; vertical-align: middle;">
                            <button title="View Detail" class="mb-2 review-go btn-info btn-outline-dark" onclick="showDetail(' . $data->id . ')">
                                <i class="fa fa-share"></i>
                            </button>
                            <button title="Delete" class="review-go btn-danger btn-outline-dark" id="deleteSLR" data-id="' . $data->id . '">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>';
                    return $btn;
                })->addColumn('article', function ($data) {
                    $title = $data->title;
                    return $title;
                })->addColumn('sub', function ($data) {
                    $sub = $data->getProject->subject;
                    return $sub;
                })->addColumn('info', function ($data) {
                    $deleted = $data->getDeletedData->name;
                    $name = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $deleted . '</span>';
                    $info = $data->deleted_at;
                    $parse = Carbon::parse($info)->isoFormat('LLLL');
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $name . '<br>' . $info;
                })
                ->rawColumns(['action', 'article', 'info', 'sub'])
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
