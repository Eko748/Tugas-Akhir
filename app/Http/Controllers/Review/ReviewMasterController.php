<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\{Controller, Interface\CategoryController, Interface\ValidationController};
use App\Models\{Category, Project, ProjectSLR};
use Illuminate\{Http\Request, Support\Str, Support\Facades\Auth};

class ReviewMasterController extends Controller implements CategoryController, ValidationController
{
    protected string $parent = 'Review';
    private string $child = 'Master';
    private array $data;

    public function __construct()
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
        ];
    }

    public function showReview()
    {
        return view('pages.review.master.index', $this->data);
    }

    public function createReview(Request $request)
    {
        $v_project = $this->validateDataCreate($request);
        $last_project = ProjectSLR::where('created_by', Auth::user()->id)
            ->where('project_id', $v_project['project_id'])
            ->orderBy('id', 'desc')
            ->first();

        $code_suffix = $last_project ? ((int) substr($last_project->code, -2)) + 1 : 1;
        if ($code_suffix > 999) {
            $code_suffix = 1;
        }

        $reference_source = $request->has('reference_source') ? $request->reference_source : null;

        ProjectSLR::create(
            [
                'uuid_project_slr' => Str::uuid(),
                'project_id' => $v_project['project_id'],
                'category_id' => $v_project['category_id'],
                'code' => $v_project['code'] . Auth::user()->code . $code_suffix,
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

        return response()->json(['success' => true]);
    }

    public function createCategory(Request $request)
    {
        $v_category = $this->validateDataCreate($request);
        $category = Category::create([
            "uuid_category" => Str::uuid(),
            "category_code" => $v_category['category_code'],
            "category_name" => $v_category['category_name'],
            "created_by" => Auth::user()->id,
        ]);

        return redirect()->back()->with(
            ($category) ? ['message' => 'Data berhasil disimpan!'] : ['error' => 'Nampaknya terjadi kesalahan']
        );
    }

    public function validateDataCreate(Request $request)
    {
        return $request->validate([
            'project_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'code' => ['required', 'string'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'alpha' => 'Kolom :attribute harus diisi dengan huruf saja.',
            'size' => 'Kolom :attribute harus terdiri dari satu karakter.',
            'uppercase' => 'Kolom :attribute harus diisi dengan huruf kapital.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'integer' => 'Kolom :attribute harus diisi dengan angka.'
        ]);
    }

    public function getCategory(Request $req)
    {
        $search = $req->q;
        $categories = Category::where('category_code', 'LIKE', '%' . $search . '%')
            ->orWhere('category_name', 'LIKE', '%' . $search . '%')
            ->orderBy('category_code', 'asc')
            ->get();

        $response = [];
        foreach ($categories as $category) {
            $response[] = [
                'id' => $category->id,
                'code' => $category->category_code,
                'text' => $category->category_code . '/' . $category->category_name
            ];
        }

        return response()->json($response);
    }

    public function getProject(Request $req)
    {
        $search = $req->q;
        $id = $req->id;

        if (Auth::user()->role_id == '1') {
            $get_projects = Project::with('getLeader')
                ->whereHas('getLeader', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->where('subject', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->orderBy('priority', 'asc')
                ->get();
        } else {
            $get_projects = Project::with('getLeader')
                ->where('subject', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->orderBy('priority', 'asc')
                ->get();
        }

        $response = [];
        foreach ($get_projects as $get_project) {
            $response[] = [
                'no' => $get_project->uuid_project,
                'id' => $get_project->id,
                'text' => $get_project->priority . '/' . $get_project->subject
            ];
        }

        return response()->json($response);
    }

    public function getProjectDetail(Request $req)
    {
        $search = $req->q;

        if (Auth::user()->role_id == '1') {
            $get_projects = ProjectSLR::with('getProject.getLeader')
                ->whereHas('getProject', function ($query) {
                    $query->where('created_by', Auth::user()->id);
                })
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%')
                ->orWhere('year', 'LIKE', '%' . $search . '%')
                ->orderBy('code', 'asc')
                ->get();
        } else {
            $get_projects = ProjectSLR::with('getProject.getLeader')
                ->whereHas('getProject.getLeader', function ($query) {
                    $query->where('leader_id', Auth::user()->created_by);
                })
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%')
                ->orWhere('year', 'LIKE', '%' . $search . '%')
                ->orderBy('code', 'asc')
                ->get();
        }

        $response = [];
        foreach ($get_projects as $get_project) {
            $response[] = [
                'no' => $get_project->uuid_project_slr,
                'id' => $get_project->id,
                'text' => $get_project->code . '/' . $get_project->year . '/' . $get_project->title
            ];
        }

        return response()->json($response);
    }
}
