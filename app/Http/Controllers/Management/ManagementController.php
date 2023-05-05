<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Member;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    protected string $parent = 'Management';

    protected function getMemberData()
    {
        $institute = User::whereHas('hasInstitute', function ($q) {
            $q->where('created_by', Auth::user()->id);
        })->first();
        $leader = Leader::where('user_id', Auth::user()->id)->first();
        $member = Member::where('created_by', $leader->id)->count();

        return [
            'institute' => $institute,
            'member' => $member
        ];
    }

    protected function getProjectData()
    {
        if (Auth::user()->id == 1) {
            $detail = Project::with('hasProject.getUser')->withCount('hasProject')
                ->where('created_by', Auth::user()->id)
                ->orderBy('created_at', 'desc');
            $all_project = $detail->get();
            $projects = $detail->paginate(12);
            $end = Project::with('hasProject.getUser')->withCount('hasProject')
                ->where('created_by', Auth::user()->id)
                ->orderBy('created_at', "desc")
                ->get();

            // dd($all_project);
        } else {
            $detail = Project::with('getLeader', 'hasProject.getUser')->withCount('hasProject')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->orderBy('created_at', "desc");
            $all_project = $detail->get();
            $projects = $detail->paginate(12);
            $end = Project::with('getLeader', 'hasProject.getUser')->withCount('hasProject')
                ->whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                ->orderBy('created_at', "desc")
                ->get();
        }
        $data = [
            'all_project' => $all_project,
            'projects' => $projects,
            'end' => $end
        ];

        return $data;
    }
}
