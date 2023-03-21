<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\ProjectSLR;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IeeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $client = new Client();
        $token1 = '6gt3qk5zbgegvb9zb7epynjy';
        $token2 = 'psqph6ps5ehvbrd2zgp4w6dq';
        $references = 'https://ieeexplore.ieee.org/xpl/dwnldReferences?arnumber=';

        $query = new XPLORE($token1);
        $query->searchField('article_title', $search);
        $results = $query->callAPI();

        if (!isset($results['articles'])) { // jika token1 mengalami error
            $query = new XPLORE($token2);
            $query->searchField('article_title', $search);
            $results = $query->callAPI();
        }

        if (isset($results['articles'])) {
            if (!isset($data)) {
                $data = [
                    "parent" => "Review",
                    "child" => "IEEE",
                    "path" => $results['articles'],
                    "search" => $search,
                    "references" => $references,
                    "client" => $client,
                ];
            }
        } else {
            if (!isset($data)) {
                $data = [
                    "parent" => "Review",
                    "child" => "IEEE",
                    "path" => "Oops! Path is null",
                    "search" => $search,
                    "references" => $references,
                    "client" => $client,
                ];
            }
        }

        if ($request->ajax()) {
            return view('pages.review.ieee.content.components.2-data', $data)->render();
        }
        return view('pages.review.ieee.index', $data);
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
