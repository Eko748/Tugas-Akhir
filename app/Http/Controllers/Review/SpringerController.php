<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpringerController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = 'f99e4740f3ccd28f81a8ea39ec4c3a79';
    }

    public function index(Request $request)
    {
        $query = $request->query('search');
        $url = 'http://api.springernature.com/meta/v2/json?q=title:' . urlencode($query) . '&api_key=' . $this->apiKey;
        
        $client = new Client();
        $response = $client->request('GET', $url);
        
        $path = json_decode($response->getBody()->getContents(), true);
        // dd($path['records']);
        $data = [
            "parent" => "Review",
            "child" => "Springer",
            "search" => $query,
            "path" => $path['records'],
        ];

        if ($request->ajax()) {
            return view('pages.review.springer.content.components.2-data', $data)->render();
        }
        
        return view('pages.review.springer.index', $data);
    }
}
