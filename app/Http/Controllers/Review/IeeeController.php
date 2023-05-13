<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\{Interface\ReviewData, Review\ReviewMasterController};
use Goutte\Client;
use Illuminate\Http\Request;

class IeeeController extends ReviewMasterController implements ReviewData
{
    private string $label = 'IEEE';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showReviewData()
    {
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
        ];
        return view('pages.review.category.ieee.index', $this->data);
    }

    public function requestReviewData(Request $request)
    {
        try {
            $ieee = $this->searchReviewData($request);
            $this->data = [
                'search' => $ieee['search'],
                'path' => $ieee['path'],
                'client' => $ieee['client'],
                'references' => $ieee['references'],
            ];
            if ($request->ajax()) {
                return view('pages.review.category.ieee.content.components.2-data', $this->data)->render();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data IEEE'], 500);
        }
    }

    public function searchReviewData($request)
    {
        $search = $request->input('search');
        $article_number = str_replace('https://ieeexplore.ieee.org/document/', '', $search);
        $client = new Client();
        $token1 = '6gt3qk5zbgegvb9zb7epynjy';
        $token2 = 'psqph6ps5ehvbrd2zgp4w6dq';
        $references = 'https://ieeexplore.ieee.org/xpl/dwnldReferences?arnumber=';

        $query = new XPLORE($token1);
        $query->searchField('article_number', $article_number);
        $results = $query->callAPI();

        if (!isset($results['articles'])) {
            $query = new XPLORE($token2);
            $query->searchField('article_number', $article_number);
            $results = $query->callAPI();
        }

        if (isset($results['articles'])) {
            if (!isset($data)) {
                return
                    $data = [
                        "path" => $results['articles'],
                        "search" => $search,
                        "references" => $references,
                        "client" => $client,
                    ];
            }
        } else {
            if (!isset($data)) {
                return
                    $data = [
                        "path" => $results,
                        "search" => $search,
                        "references" => $references,
                        "client" => $client,
                    ];
            }
        }
    }
}
