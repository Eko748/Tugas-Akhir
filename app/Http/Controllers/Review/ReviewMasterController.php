<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Review\CategoryController;
use App\Models\Category;
use App\Models\Leader;
use App\Models\ProjectSLR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewMasterController extends Controller implements CategoryController
{
    public function getView()
    {
        $data = [
            "parent" => "Review",
            "child" => "Master"
        ];
        return view('pages.review.master.index', $data);
    }

    public function createReview(Request $request)
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

    public function createCategory(Request $request)
    {
        $request->validate([
            "code" => ['required', 'string', 'uppercase'],
            "category_name" => "required"
        ]);
 
        $category = Category::create([
            "uuid_category" => Str::uuid(),
            "code" => $request->code,
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name),
            "created_by" => Auth::user()->id,
        ]);

        return redirect()->back()->with(
            ($category) ? ['message' => 'Data berhasil disimpan!'] : ['error' => 'Nampaknya terjadi kesalahan']
        );
    }

    public function getCategory(Request $req)
    {
        $search = $req->q;
        $categories = Category::where('code', 'LIKE', '%' . $search . '%')
            ->orWhere('category_name', 'LIKE', '%' . $search . '%')
            ->orderBy('code', 'asc')
            ->get();

        $response = [];
        foreach ($categories as $category) {
            $response[] = [
                'id' => $category->id,
                'code' => $category->code,
                'text' => $category->code . '/' . $category->category_name
            ];
        }

        return response()->json($response);
    }
}
