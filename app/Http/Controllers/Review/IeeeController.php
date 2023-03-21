<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\Request;

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

}
