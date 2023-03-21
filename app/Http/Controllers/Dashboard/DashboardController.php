<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $date = date('Y-m-d H:i:s');
        // $projects = Project::with('getLeader.getUser')
        //     ->where('created_by', Auth::user()->id)
        //     ->get();
        // foreach ($projects as $project) {
        //     // $project;
        //     $start_date = $project->start_date;
        //     $end_date = $project->end_date;
        //     $current_time = date('Y-m-d H:i:s');
        // }

        // $data = [
        //     "start_date" => $start_date,
        //     "end_date" => $end_date,
        //     "current_time" => $current_time,
        // ];
        // dd($data);
        // $auth = Auth::user()->hasLeader->first();

        // dd($auth->id);
        // $p = Project::with('getLeader')->whereHas('getLeader', function ($q) {
        //         $q->where('id', Auth::user()->created_by);
        //     })->get();
        //     dd($p);
        //     $a = $p->getLeader->hasMember->id;
        // $adminId = $admin ? $admin->id : null; // mengambil nilai id dari objek model Admin, jika objek tidak null
        $data = ["parent" => "Dashboard", "child" => "Admin"];
        return view('pages.dashboard.index', $data);
    }
}
