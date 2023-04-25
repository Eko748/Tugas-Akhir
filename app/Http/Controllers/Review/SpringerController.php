<?php

namespace App\Http\Controllers\Review;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpringerController extends ReviewMasterController
{
    private string $apiKey = 'f99e4740f3ccd28f81a8ea39ec4c3a79';
    private string $child = 'Springer';
    private array $data;

    public function __construct()
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child
        ];
    }

    public function showReviewSpringer()
    {
        return view('pages.review.category.springer.index', $this->data);
    }

    public function requestSpringerData(Request $request)
    {
        $springer = $this->searchSpringerData($request);
        $this->data = [
            'search' => $springer['query'],
            'client' => $springer['client'],
            'path' => $springer['path']['records'],
        ];
        if ($request->ajax()) {
            return view('pages.review.category.springer.content.components.2-data', $this->data)->render();
        }
    }

    private function searchSpringerData(Request $request)
    {
        $query = $request->query('search');
        $url = 'http://api.springernature.com/meta/v2/json?q=doi:' . urlencode($query) . '&api_key=' . $this->apiKey;
        $client = new Client();
        $response = $client->request('GET', $url);
        $path = json_decode($response->getBody()->getContents(), true);
        return [
            'query' => $query,
            'path' => $path,
            'client' => $client,
        ];
    }
}
