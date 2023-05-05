<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Interface\ValidationData;
use App\Models\Project;
use App\Models\ProjectSLR;
use Illuminate\{Http\Request, Support\Str, Support\Facades\Auth};

class ReviewMasterController extends ReviewController implements ValidationData
{
    private string $child = 'Master';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showReview()
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
        ];
        return view('pages.review.master.index', $this->data);
    }

    public function createReview(Request $request)
    {
        try {
            if (Auth::user()->role_id == 1) {
                $project = Project::where('created_by', Auth::user()->id)
                ->orderBy('created_at', 'desc')->first();
            } else {
                $project = Project::whereHas('getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })->orderBy('created_at', "desc")->first();
            }
            $v_project = $this->validateDataCreate($request);
            $last_project = ProjectSLR::where('created_by', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $code_suffix = $last_project ? ((int) substr($last_project->code, 2)) + 1 : 1;
            if ($code_suffix > 999) {
                $code_suffix = 1;
            }

            $reference_source = $request->has('reference_source') ? $request->reference_source : null;

            ProjectSLR::create(
                [
                    'id' => random_int(1000000, 9999999),
                    'uuid_project_slr' => Str::uuid(),
                    'project_id' => $project->id,
                    'category_id' => $request->category_id,
                    'code' => $request->code . Auth::user()->code . $code_suffix,
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
                    'reference_source' => $reference_source,
                    'created_by' => Auth::user()->id,
                ]
            );
            return response()->json(['success' => 'Review berhasil ditambahkan ke Project']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal, silahkan coba lagi', 'message' => $e->getMessage()]);
        }
    }


    public function validateDataCreate(Request $request)
    {
        return $request->validate(
            [],
            [
                'required' => 'Kolom :attribute harus diisi.',
                'string' => 'Kolom :attribute harus berupa teks.',
                'alpha' => 'Kolom :attribute harus diisi dengan huruf saja.',
                'size' => 'Kolom :attribute harus terdiri dari satu karakter.',
                'uppercase' => 'Kolom :attribute harus diisi dengan huruf kapital.',
                'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
                'integer' => 'Kolom :attribute harus diisi dengan angka.'
            ]
        );
    }

    // public function getCategory(Request $request)
    // {
    //     $categories = $this->getCategoryReview($request);

    //     $response = [];
    //     foreach ($categories as $category) {
    //         $response[] = [
    //             'id' => $category->id,
    //             'code' => $category->category_code,
    //             'text' => $category->category_code . '/' . $category->category_name
    //         ];
    //     }
    //     return response()->json($response);
    // }

    // public function getProject(Request $request)
    // {
    //     $get_projects = $this->getProjectReview($request);
    //     $response = [];
    //     foreach ($get_projects as $get_project) {
    //         $response[] = [
    //             'no' => $get_project->uuid_project,
    //             'id' => $get_project->id,
    //             'text' => $get_project->priority . '/' . $get_project->subject
    //         ];
    //     }

    //     return response()->json($response);
    // }
}
