<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Interface\RecycleData;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $data = $this->getRecycleProjectReview();
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

    public function restoreRecycleData(Request $request)
    {
        $restore = Review::find($request->id)->update([
            'updated_by' => Auth::user()->id,
            'deleted_by' => null,
            'deleted_at' => null
        ]);

        if ($restore == 1) {
            $e = true;
            $message = "Poject Review Berhasil dipulihkan!";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }
        return response()->json(['e' => $e, 'status' => $message]);
    }

    public function deleteRecycleData(Request $request)
    {
        $delete = Review::find($request->id)->delete();

        if ($delete == 1) {
            $e = true;
            $message = "Poject Review Berhasil dihapus!";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }
        return response()->json(['e' => $e, 'status' => $message]);
    }
}
