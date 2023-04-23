<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use App\Models\Project;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IeeeController extends ReviewMasterController
{
    // private string $apiKey;
    private string $child;
    private array $data;

    public function __construct(Request $request)
    {
        $this->child = 'IEEE';
        $ieee = $this->searchIeeeData($request);
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
            'search' => $ieee['search'],
            'path' => $ieee['path'],
            'client' => $ieee['client'],
            'references' => $ieee['references'],
        ];
    }

    public function showReviewIeee()
    {
        return view('pages.review.ieee.index', $this->data);
    }

    public function requestIeeeData(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.review.ieee.content.components.2-data', $this->data)->render();
        }
    }

    private function searchIeeeData(Request $request)
    {
        $search = $request->input('search');
        $client = new Client();
        $token1 = '6gt3qk5zbgegvb9zb7epynjy';
        $token2 = 'psqph6ps5ehvbrd2zgp4w6dq';
        $references = 'https://ieeexplore.ieee.org/xpl/dwnldReferences?arnumber=';

        $query = new XPLORE($token1);
        $query->searchField('article_title', $search);
        $results = $query->callAPI();

        if (!isset($results['articles'])) {
            $query = new XPLORE($token2);
            $query->searchField('article_title', $search);
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
                        "path" => "Oops! Path is null",
                        "search" => $search,
                        "references" => $references,
                        "client" => $client,
                    ];
            }
        }
    }
}
