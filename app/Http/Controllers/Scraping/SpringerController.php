<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Interface\ScrapingData;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class SpringerController extends ScrapingMasterController implements ScrapingData
{
    private string $label = 'Springer';
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
        return view('pages.review.category.springer.index', $this->data);
    }

    public function requestScrapingData(Request $request)
    {
        try {
            $springer = $this->searchScrapingData($request);
            if (Auth::check()) {
                $exist = $this->getData()['exists'];
            } else {
                $exist = 'Tidak ada';
            }
            if (empty($springer['path']['records'])) {
                $this->data = [
                    'error' => 'Data Springer tidak ditemukan'
                ];
                if ($request->ajax()) {
                    return view('pages.review.category.springer.content.components.2-data', $this->data)->render();
                }
            } else {
                if (isset($springer['path']['records'])) {
                    $this->data = [
                        'search_link' => $springer['search'],
                        'search' => $springer['query'],
                        'client' => $springer['client'],
                        'path' => $springer['path']['records'],
                        'exist' => $exist
                    ];
                } else {
                    $this->data = [
                        'error' => 'Data Springer tidak ditemukan'
                    ];
                }
                if ($request->ajax()) {
                    return view('pages.review.category.springer.content.components.2-data', $this->data)->render();
                }
            }
        } catch (\Exception $e) {
            $this->data = [
                'error' => 'Data Springer tidak ditemukan'
            ];
            return view('pages.review.category.springer.content.components.2-data', $this->data)->render();
        }
    }

    public function searchScrapingData($request)
    {
        $search = $request->query('search');
        $query = $request->query('search');
        $springer = config('services.scrape.springer_key');
        $query = str_ireplace('https://link.springer.com/article/', '', $query);
        $query = str_ireplace('https://link.springer.com/chapter/', '', $query);
        $url = 'http://api.springernature.com/meta/v2/json?q=doi:' . urlencode($query) . '&api_key=' . $springer;
        $client = new Client();
        $response = $client->request('GET', $url);
        $path = json_decode($response->getBody()->getContents(), true);
        if (isset($path)) {
            return [
                'search' => $search,
                'query' => $query,
                'path' => $path,
                'client' => $client,
            ];
        }
    }
}
