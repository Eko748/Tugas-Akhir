<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\ProjectData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
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

        // dd($results['articles']);
        if (isset($results['articles'])) {
            if (!isset($data)) {
                $data = [
                    "parent" => "Scraping",
                    "child" => "Review",
                    "path" => $results['articles'],
                    "search" => $search,
                    "references" => $references,
                ];
            }
        } else {
            if (!isset($data)) {
                $data = [
                    "parent" => "Scraping",
                    "child" => "Review",
                    "path" => "Oops! Path is null",
                    "search" => $search,
                    "references" => $references,
                ];
            }
        }

        if ($request->ajax()) {
            return view('pages.scraping.review.content.components.2-data', $data)->render();
        }
        return view('pages.scraping.review.index', $data);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');
            $query = new XPLORE('psqph6ps5ehvbrd2zgp4w6dq');
            $query->searchField('article_title', $search);
            $results = $query->callAPI();
            $item = [];
            $item[] = $results;
            $cek = [];
            foreach ($results['articles'] as $article) {
                $cek[] = $article;
            }
            $hore = json_decode(json_encode($cek), true);
            $path = $hore;
            return view('pages.scraping.review.content.components.data', compact('path'))->render();
        }
    }

    public function create(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();

        $request->validate([
            'project_id' => ['required', 'integer'],
            // 'category_id' => ['required', 'integer'],
        ]);

        $project = ProjectData::create(
            [
                'uuid' => Str::uuid(),
                'project_id' => $request->project_id,
                'category_id' => $request->category_id,
                'code' => $request->code . Auth::user()->id,
                'title' => $request->title,
                'publisher' => $request->publisher,
                'publication' => $request->publication,
                'year' => $request->year,
                'type' => $request->type,
                'cited' => $request->cited,
                'abstracts' => $request->abstracts,
                'authors' => $request->authors,
                'keywords' => $request->keywords,
                'references' => "On the way",
                'created_by' => Auth::user()->id,
            ]
        );

        return response()->json(['success' => 'Project berhasil ditambahkan']);
    }
}
