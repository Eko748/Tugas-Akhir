<?php

namespace App\Http\Controllers\Recycle;

use App\Http\Controllers\Controller;
use App\Models\{ScrapedData, User};
use Illuminate\Support\Facades\Auth;

class RecycleController extends Controller
{
    protected string $page = 'Recycle';

    protected function getRecycleMember()
    {
        $auth = Auth::user()->hasLeader->first();
        $data = User::where('created_by', $auth->id)
            ->whereNotNull('deleted_by')->get();
        return $data;
    }

    protected function getRecycleProjectScraping()
    {
        $data = ScrapedData::whereHas('getProject', function ($q) {
            $q->where('created_by', Auth::user()->id);
        })->whereNotNull('deleted_by')->get();
        return $data;
    }
}
