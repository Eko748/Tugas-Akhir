<?php

namespace App\Http\Controllers\Review;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

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
            'client' => $springer['client'],
            'path' => $springer['path']['records'],
        ];
    }

    public function showReviewSpringer(Request $request)
    {
        // $query = $request->query('search');
        // $a = 'Predicting Code Smells and Analysis of Predictions';
        // $url = 'http://api.springernature.com/meta/v2/json?q=title:' . urlencode($a) . '&api_key=' . $this->apiKey;
        // $client = new Client();
        // $response = $client->request('GET', $url);
        // $path = json_decode($response->getBody()->getContents(), true);
        // // $ref = 'http://link.springer.com/openurl/fulltext?id=doi:10.1007/s41870-023-01185-y';
        // // $response = $client->request('GET', $ref);
        // // $html = (string) $response->getBody();
        // // $crawler = new Crawler($html);
        // // $text = '';
        // // $items = $crawler->evaluate('//p[@class="c-article-references__text"]')->each(function ($node) {
        // //     return $node->text();
        // // });
        // // dd($items);
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
