<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Controller;
use App\Models\ProjectSLR;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecycleController extends Controller
{
    protected string $parent = 'Recycle';

    public function recycleMember()
    {
        $auth = Auth::user()->hasLeader->first();
        $data = User::where('created_by', $auth->id)
            ->whereNotNull('deleted_by')->get();
        return $data;
    }

    public function recycleProject()
    {
        $data = ProjectSLR::whereHas('getProject', function ($q) {
            $q->where('created_by', Auth::user()->id);
        })->whereNotNull('deleted_by')->get();
        return $data;
    }
}
