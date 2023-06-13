<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\{Institute, Leader, Member, Project, ScrapedData};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    protected string $page = 'Management';

    protected function getInstituteData()
    {
        if (Auth::user()->role_id == '1') {
            $institute = Institute::where('created_by', Auth::user()->id)->first();
        } elseif (Auth::user()->role_id == '2') {
            $institute = Institute::whereHas('getLeader', function ($q) {
                $q->where('id', Auth::user()->created_by);
            })->first();
        }
        if ($institute != null) {
            $ins = $institute->institute_name;
            $ins_array = explode(' ', $ins);
            $slug = Str::of($ins_array[0])->slug('');
            $data['slug'] = $slug;
        }
        $data = [
            'institute' => $institute
        ];
        return $data;
    }

    protected function getMemberData()
    {
        $leader = Leader::where('user_id', Auth::user()->id)->first();
        $member = Member::where('created_by', $leader->id)->count();

        return $member;
    }

    protected function getProjectData()
    {
        if (Auth::user()->role_id == 1) {
            $projects = Project::where('created_by', Auth::user()->id)
                ->firstOrFail();
        } elseif (Auth::user()->role_id == 2) {
            $projects = Project::where('leader_id', Auth::user()->created_by)
                ->firstOrFail();
        }

        return $projects;
    }

    protected function getProjectScrapingData(Request $request)
    {
        try {
            $hashedId = $request->code;
            $views = ScrapedData::get();
            $detail = null;
            foreach ($views as $view) {
                $hash = hash('sha256', $view->id);
                if ($hash === $hashedId) {
                    $detail = $view;
                    break;
                }
            }
            if (!$detail) {
                return response()->json(['error' => 'Project Tidak ditemukan'], 404);
            }
            $data = [
                'views' => $detail,
            ];
            return $data;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi Kesalahan'], 500);
        }
    }
}
