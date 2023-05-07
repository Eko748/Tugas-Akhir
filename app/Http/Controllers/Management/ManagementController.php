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
    protected string $page = 'Management';

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
        if (Auth::user()->role_id == 1) {
            $projects = Project::where('created_by', Auth::user()->id)
                ->orderBy('created_at', 'desc');
        } elseif (Auth::user()->role_id == 2) {
            $projects = Project::where('leader_id', Auth::user()->created_by)
                ->orderBy('created_at', 'desc');
        }

        return $projects;
    }
}
