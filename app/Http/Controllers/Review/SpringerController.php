<?php

namespace App\Http\Controllers\Review;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpringerController extends ReviewMasterController
{
    private string $apiKey = 'f99e4740f3ccd28f81a8ea39ec4c3a79';
    private string $child = 'Springer';
    private array $data;

    public function __construct(Request $request)
    {
        parent::__construct();
        $springer = $this->searchSpringerData($request);
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
            'search' => $springer['query'],
            'path' => $springer['path']['records'],
        ];
    }

    public function showReviewSpringer()
    {
        return view('pages.review.springer.index', $this->data);
    }

    public function requestSpringerData(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.review.springer.content.components.2-data', $this->data)->render();
        }
    }

    private function searchSpringerData(Request $request)
    {
        $query = $request->query('search');
        $url = 'http://api.springernature.com/meta/v2/json?q=title:' . urlencode($query) . '&api_key=' . $this->apiKey;
        $client = new Client();
        $response = $client->request('GET', $url);
        $path = json_decode($response->getBody()->getContents(), true);
        return [
            'query' => $query,
            'path' => $path,
        ];
    }

}
