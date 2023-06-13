<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Interface\RecycleData;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $data = $this->getRecycleMember();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div style="text-align: center; vertical-align: middle;">
                        <button title="Restore '. $data->code .'" class="restore mb-2 review-go btn-info btn-outline-dark" id="restore" data-id="' . $data->id . '">
                        <i class="fa fa-recycle"></i>
                        </button>
                        <button title="Delete '. $data->code .'" class="delete review-go btn-danger btn-outline-dark" data-id="' . $data->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                        </div>';
                    return $btn;
                })->addColumn('info', function ($data) {
                    $info = $data->deleted_at;
                    $parse = Carbon::parse($info)->isoFormat('LLLL');
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $info;
                })->addColumn('member', function ($data) {
                    $member = '(' . $data->code . ') ' . $data->name;
                    return $member;
                })
                ->rawColumns(['action', 'info', 'member'])
                ->make(true);
        }
    }

    public function restoreRecycleData(Request $request)
    {
        $restore = User::find($request->id)->update([
            'updated_by' => Auth::user()->id,
            'deleted_by' => null,
            'deleted_at' => null
        ]);

        if ($restore == 1) {
            $e = true;
            $message = "Member Berhasil dipulihkan!";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }
        return response()->json(['e' => $e, 'status' => $message]);
    }

    public function deleteRecycleData(Request $request)
    {
        $delete = User::find($request->id)->delete();

        if ($delete == 1) {
            $e = true;
            $message = "Member Berhasil dihapus!";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }
        return response()->json(['e' => $e, 'status' => $message]);
    }
}
