<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Str;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $null = "NULL";
        $project = Project::where('created_by', Auth::user()->id)->paginate(2);
        if ($project == !null) {
        } else {
            $null;
        }

        $data = [
            "parent" => "Management",
            "child" => "Project",
            "project" => $project,
        ];

        if ($request->ajax()) {
            return view('pages.management.project.content.components.2-data', $data)->render();
        }

        return view('pages.management.project.index', $data);
    }

    public function create(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'priority' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s', 'after:start_date'],
        ]);

        $project = Project::create(
            [
                'uuid' => Str::uuid(),
                'leader_id' => $user->id,
                'title' => $request->title,
                'priority' => $request->priority,
                'description' => $request->description,
                'status' => "1",
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'created_by' => Auth::user()->id,
            ]
        );

        return response()->json(['success' => 'Project berhasil ditambahkan']);
    }

    public function getProject(Request $req)
    {
        $search = $req->q;
        $projects = Project::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('priority', 'LIKE', '%' . $search . '%')
            ->orderBy('priority', 'asc')
            ->get();

        $response = [];
        foreach ($projects as $project) {
            $response[] = [
                'no' => $project->uuid,
                'id' => $project->id,
                'text' => $project->priority . '/' . $project->title
            ];
        }

        return response()->json($response);
    }
}
