<?php

namespace App\Http\Controllers\Management;

use App\Exports\ProjectsExport;
use App\Models\Category;
use App\Models\Project;
use App\Models\ScrapedData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends ManagementController
{
    private string $label = 'Project Scraping';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showProjectScraping()
    {
        $this->data = [
            'subject' => $this->getProjectData(),
            'parent' => $this->page,
            'child' => $this->label,
        ];
        return view('pages.management.project.index', $this->data);
    }

    public function requestProjectScraping(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role_id == 1) {
                $auth = Auth::user()->id;
                $data = ScrapedData::whereHas('getProject', function ($q) use ($auth) {
                    $q->where('created_by', $auth);
                })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'DESC')->get();
            } else {
                $auth = Auth::user()->created_by;
                $data = ScrapedData::whereHas('getProject', function ($q) use ($auth) {
                    $q->where('leader_id', $auth);
                })->whereHas('getProject.getLeader', function ($q) {
                    $q->where('id', Auth::user()->created_by);
                })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'DESC')->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $delete = '<button title="Delete" class="ms-1 me-1 mb-2 review-go btn-danger btn-outline-dark" id="deleteSLR" data-id="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                    if (Auth::user()->role_id == 2) {
                        if ($data->created_by == Auth::user()->id) {
                            $btn_delete = $delete;
                        } else {
                            $btn_delete = '';
                        }
                    } elseif (Auth::user()->role_id == 1) {
                        $btn_delete = $delete;
                    }
                    $btn = '
                    <button title="View Detail" class="ms-1 me-1 mb-2 review-go btn-info btn-outline-dark" onclick="showDetail(' . $data->id . ')">
                        <i class="fa fa-list-alt"></i>
                    </button><button title="Backward Snowballing" class="ms-1 me-1 mb-2 review-go btn-warning btn-outline-dark" onclick="snowBalling(' . $data->id . ')">
                        <i class="fa fa-share-square-o"></i>
                    </button>';
                    $button = '<div style="text-align: center; vertical-align: middle;">' . $btn . $btn_delete . '</div>';
                    return $button;
                })->addColumn('article', function ($data) {
                    $title = $data->title;
                    return $title;
                })->addColumn('info', function ($data) {
                    $created = $data->getUser->name;
                    $name = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $created . '</span>';
                    $info = $data->created_at;
                    $parse = Carbon::parse($info)->isoFormat('LLLL');
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';
                    return $name . '<br>' . $info;
                })
                ->rawColumns(['fiture', 'action', 'article', 'info'])
                ->make(true);
        }
    }

    public function getSnowballScraping(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.management.project.content.components.4-modal-snowballing', $this->getProjectScrapingData($request));
        }
    }

    public function getDetailScraping(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.management.project.content.components.5-modal-detail', $this->getProjectScrapingData($request));
        }
    }

    public function deleteProjectScraping(Request $request)
    {
        $delete = ScrapedData::find($request->id)->update([
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now()
        ]);

        if ($delete == 1) {
            $e = true;
            $message = "Project Berhasil dihapus";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }

        return response()->json(['e' => $e, 'status' => $message]);
    }

    public function exportProjectScraping()
    {
        if (null !== $this->getInstituteData()['institute']) {
            $ins = $this->getInstituteData()['institute'];
            $institute = $ins['institute_name'];
            $ins_array = explode(' ', $institute);
            $prefix = Str::of($ins_array[0])->slug('');
        } else {
            $prefix = 'slr';
        }

        $currentDateTime = date('His-dmY');
        $fileName = $prefix . '-project-' . $currentDateTime . '.xlsx';
        $print = Excel::download(new ProjectsExport($this->getProjectData()), $fileName);
        return $print;
    }

    public function exportPDF(Request $request)
    {
        $request->validate([
            'sort_by' => 'nullable|in:year,title,publisher,publication,category_name',
            'category_name' => 'nullable|in:IEEE,ACM,Springer',
            'start_year' => 'nullable|integer',
            'end_year' => 'nullable|integer',
        ]);

        $scrapies = null;

        if (Auth::user()->role_id == '1') {
            $user = Auth::user()->id;
            $query = ScrapedData::whereHas('getProject', function ($q) use ($user) {
                $q->where('created_by', $user);
            })
                ->where('deleted_by', null);

            if (!empty($request->input('category_name'))) {
                $query->whereHas('getCategory', function ($q) use ($request) {
                    $q->where('category_name', $request->input('category_name'));
                });
            }

            if (!empty($request->input('sort_by'))) {
                if ($request->input('sort_by') === 'category_name') {
                    $query->join('category', 'scraped_data.category_id', '=', 'category.id')
                        ->orderBy('category.category_name', 'desc');
                } else {
                    $query->orderBy($request->input('sort_by'), 'desc');
                }
            }

            if (!empty($request->input('start_year')) && !empty($request->input('end_year'))) {
                $query->whereBetween('year', [$request->input('start_year'), $request->input('end_year')]);
            }

            $scrapies = $query->orderBy('created_at', 'desc')->get();
        } elseif (Auth::user()->role_id == '2') {
            $user_id = Auth::user()->created_by;
            $query = ScrapedData::whereHas('getProject', function ($q) use ($user_id) {
                $q->whereHas('getLeader', function ($l) use ($user_id) {
                    $l->where('id', $user_id);
                });
            })->where('deleted_by', null);

            if (!empty($request->has('category_name'))) {
                $query->whereHas('getProject', function ($q) use ($user_id) {
                    $q->whereHas('getLeader', function ($l) use ($user_id) {
                        $l->where('id', $user_id);
                    });
                })
                    ->whereHas('getCategory', function ($q) use ($request) {
                        $q->where('category_name', $request->category_name);
                    })
                    ->where('deleted_by', null)
                    ->orderBy('created_at', 'desc');
            }

            if (!empty($request->input('sort_by'))) {
                if ($request->input('sort_by') === 'category_name') {
                    $query->join('category', 'scraped_data.category_id', '=', 'category.id')
                        ->orderBy('category.category_name', 'desc');
                } else {
                    $query->orderBy($request->input('sort_by'), 'desc');
                }
            }

            if (!empty($request->input('start_year')) && !empty($request->input('end_year'))) {
                $query->whereBetween('year', [$request->input('start_year'), $request->input('end_year')]);
            }

            $scrapies = $query->get();
        }
        $project = $this->getProjectData();

        $data = [
            'scrapies' => $scrapies,
            'project' => $project
        ];

        if (null !== $this->getInstituteData()['institute']) {
            $ins = $this->getInstituteData()['institute'];
            $institute = $ins['institute_name'];
            $ins_array = explode(' ', $institute);
            $prefix = Str::of($ins_array[0])->slug('');
        } else {
            $prefix = 'slr';
        }

        $currentDateTime = date('His-dmY');
        $fileName = $prefix . '-project-' . $currentDateTime . '.pdf';

        $pdf = Pdf::loadView('exports.pdf', $data);
        return $pdf->download($fileName);
    }

    public function searchProjectScraping(Request $request)
    {
        $search = $request->q;
        if (Auth::user()->role_id == '1') {
            $user = Auth::user()->id;
            $query = ScrapedData::whereHas('getProject', function ($q) use ($user) {
                $q->where('created_by', $user);
            })->where('deleted_by', null)
                ->where('year', 'LIKE', '%' . $search . '%')
                ->orderBy('year', 'desc')->get();
        } elseif (Auth::user()->role_id == '2') {
            $user_id = Auth::user()->created_by;
            $query = ScrapedData::whereHas('getProject', function ($q) use ($user_id) {
                $q->whereHas('getLeader', function ($l) use ($user_id) {
                    $l->where('id', $user_id);
                });
            })->where('deleted_by', null)
                ->where('year', 'LIKE', '%' . $search . '%')
                ->orderBy('year', 'desc')->get();
        }

        $response = [];
        foreach ($query as $data) {
            $pattern = '/\b\d{4}\b/';

            if (preg_match($pattern, $data->year, $matches)) {
                $year = $matches[0];
            } else {
                $year = $data->year;
            }

            $response[] = [
                'id' => $year,
                'text' => $year,
            ];
        }
        $uniqueYears = collect($response)->unique('text')->values();
        $sortedYears = $uniqueYears->sortByDesc('text')->values()->all();

        return response()->json($sortedYears);
    }

    public function searchCategory(Request $request)
    {
        $search = $request->q;
        $query = Category::where('category_name', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'asc')->get();

        $response = [];

        $emptyOption = ['id' => '', 'text' => ''];
        $response[] = $emptyOption;

        foreach ($query as $data) {
            $response[] = [
                'id' => $data->category_name,
                'text' => $data->category_name,
            ];
        }

        return response()->json($response);
    }

    public function searchSortProject(Request $request)
    {
        $column = [
            "title" => "Title",
            "year" => "Year",
            "publisher" => "Publisher",
            "publication" => "Publication",
        ];

        $response = [];
        foreach ($column as $key => $value) {
            $response[] = [
                'id' => $key,
                'text' => $value,
            ];
        }

        return response()->json($response);
    }

    public function updateSubject(Request $request)
    {
        $request->validate(
            [
                'subject' => ['required']
            ],
            [
                'required' => 'Kolom :attribute harus diisi.'
            ]
        );
        $project = $this->getProjectData();
        $project->update([
            'subject' => $request->subject
        ]);

        return back()->with('status', 'subject-updated');
    }
}
