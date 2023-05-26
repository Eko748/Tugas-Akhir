<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Interface\ScrapingData;
use Goutte\Client;
use Illuminate\Http\Request;

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
            $exist = $this->getData()['exists'];
            $this->data = [
                'search' => $ieee['search'],
                'path' => $ieee['path'],
                'client' => $ieee['client'],
                'references' => $ieee['references'],
                'exist' => $exist
            ];
            if ($request->ajax()) {
                return view('pages.review.category.ieee.content.components.2-data', $this->data)->render();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data IEEE'], 500);
        }
    }

    public function searchScrapingData($request)
    {
        $search = $request->input('search');
        $article_number = str_ireplace('https://ieeexplore.ieee.org/abstract/document/', '', $search);
        $article_number = str_ireplace('https://ieeexplore.ieee.org/document/', '', $article_number);
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
