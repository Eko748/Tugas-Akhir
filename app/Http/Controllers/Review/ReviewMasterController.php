<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\ProjectSLR;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewMasterController extends Controller
{
    public function index()
    {
        $data = [
            "parent" => "Review",
            "child" => "Master"
        ];
        return view('pages.review.master.index', $data);
    }

    public function create(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'project_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'code' => ['required', 'string'],
        ]);

        ProjectSLR::create(
            [
                'uuid_project_slr' => Str::uuid(),
                'project_id' => $request->project_id,
                'category_id' => $request->category_id,
                'code' => $request->code . Auth::user()->code,
                'title' => $request->title,
                'publisher' => $request->publisher,
                'publication' => $request->publication,
                'year' => $request->year,
                'type' => $request->type,
                'cited' => $request->cited,
                'abstracts' => $request->abstracts,
                'authors' => $request->authors,
                'keywords' => $request->keywords,
                'references' => $request->references,
                'created_by' => Auth::user()->id,
            ]
        );

        return response()->json(['success' => 'Project berhasil ditambahkan']);
    }
}
