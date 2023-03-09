<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SLRController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('created_by', Auth::user()->id)
            ->orderBy('id', 'asc')->get();

        $query = $request->get('query');

        $project = Project::where('title', 'LIKE', '%' . $query . '%')->get();

        $data = [
            "parent" => "Management",
            "child" => "SLR",
            "projects" => $projects,
            "project" => $project,
        ];

        if ($request->ajax()) {
            return view('pages.management.slr.content.components.2-data', $data)->render();
        }
        return view('pages.management.slr.index', $data);
    }

    public function print(Request $request)
    {
        $request->validate([
            "institute_name" => "required"
        ]);

        Institute::create([
            "uuid_institute" => Str::uuid(),
            "user_id" => Auth::user()->id,
            "institute_name" => $request->institute_name,
            "institute_slug" => Str::of($request->institute_name)->slug(""),
            "created_by" => Auth::user()->id,
        ]);

        return response()->json(["success" => "true"]);
    }
}
