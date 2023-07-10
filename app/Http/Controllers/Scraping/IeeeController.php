<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Interface\ScrapingData;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IeeeController extends ScrapingMasterController implements ScrapingData
{
    private string $label = 'IEEE';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showScrapingData()
    {
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
        ];
        return view('pages.review.category.ieee.index', $this->data);
    }

    public function requestScrapingData(Request $request)
    {
        try {
            $ieee = $this->searchScrapingData($request);
            if (Auth::check()) {
                $exist = $this->getData()['exists'];
            } else {
                $exist = 'Tidak ada';
            }
            $this->data = [
                'search' => $ieee['search'],
                'path' => $ieee['path'],
                'client' => $ieee['client'],
                'references' => $ieee['references'],
                'exist' => $exist
            ];
            return view('pages.review.category.ieee.content.components.2-data', $this->data)->render();
        } catch (\Exception $e) {
            $this->data = [
                'error' => 'Data IEEE tidak ditemukan'
            ];
            return view('pages.review.category.ieee.content.components.2-data', $this->data)->render();
        }
        return view('pages.review.category.ieee.content.components.2-data', $this->data)->render();
    }

    public function searchScrapingData($request)
    {
        $search = $request->input('search');
        $article_number = str_ireplace('https://ieeexplore.ieee.org/abstract/document/', '', $search);
        $article_number = str_ireplace('https://ieeexplore.ieee.org/document/', '', $article_number);
        $client = new Client();
        $token1 = config('services.scrape.ieee_key_1');
        $token2 = config('services.scrape.ieee_key_2');
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
