<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Interface\RecycleData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RecycleMemberController extends RecycleController implements RecycleData
{
    private string $label = 'Member';
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
        return view('pages.recycle.member.index', $this->data);
    }

    public function requestRecycleData(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->recycleMember();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div style="text-align: center; vertical-align: middle;">
                            <button title="View Detail" class="mb-2 review-go btn-info btn-outline-dark" onclick="showDetail(' . $data->id . ')">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button title="Delete" class="review-go btn-danger btn-outline-dark" id="deleteSLR" data-id="' . $data->id . '">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>';
                    return $btn;
                })->addColumn('info', function ($data) {
                    $info = $data->deleted_at;
                    $parse = Carbon::parse($info)->isoFormat('LLLL');
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $info;
                })
                ->rawColumns(['action', 'info'])
                ->make(true);
        }
    }

    public function restoreRecycleData(Request $request)
    {
        
    }

    public function deleteRecycleData(Request $request)
    {
    }
}
