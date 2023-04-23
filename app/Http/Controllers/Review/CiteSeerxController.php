<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Http\Request;

class CiteSeerxController extends ReviewMasterController
{
    // private string $apiKey;
    private string $child;
    private array $data;

    public function __construct(Request $request)
    {
        $this->child = 'CiteSeerx';
        // $ieee = $this->searchIeeeData($request);
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
            // 'search' => $ieee['search'],
            // 'path' => $ieee['path'],
            // 'client' => $ieee['client'],
            // 'references' => $ieee['references'],
        ];
    }
    
    public function showReviewCiteSeerx()
    {
        $client = new GuzzleHttpClient();
        $response = $client->request('GET', 'http://citeseerx.ist.psu.edu/api/search?title=home');
        //  [
        //     'query' => [
        //         'q' => 'home',
        //         'start' => 0,
        //         'num' => 10,
        //         'sort' => 'rlv',
        //         'order' => 'desc'
        //     ]
        // ]);
        
        $data = json_decode($response->getBody(), true);
        dd($response);
        return view('pages.review.citeseerx.index', $this->data);
    }

    public function requestReviewCiteSeerx()
    {
        return view('pages.review.content.components.2-data', $this->data);
    }

    private function searchDataCiteSeerx()
    {
        // return 
    }

    // public function index()
    // {
    //     $client = new Client();
    //     $response = $client->request('GET', 'http://citeseerx.ist.psu.edu/api/search', [
    //         'query' => [
    //             'q' => 'query',
    //             'start' => 0,
    //             'num' => 10,
    //             'sort' => 'rlv',
    //             'order' => 'desc'
    //         ]
    //     ]);
        
    //     $data = json_decode($response->getBody(), true);
        
    //     return view('index', ['data' => $data]);
    // }

}
