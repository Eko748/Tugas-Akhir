<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Interface\ScrapingData;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
            $exist = $this->getData()['exists'];
            $this->data = [
                'search' => $springer['query'],
                'client' => $springer['client'],
                'path' => $springer['path']['records'],
                'exist' => $exist
            ];
            if ($request->ajax()) {
                return view('pages.review.category.springer.content.components.2-data', $this->data)->render();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data Springer'], 500);
        }
    }

    public function searchScrapingData($request)
    {
        $query = $request->query('search');
        $query = str_replace('https://link.springer.com/article/', '', $query);
        $query = str_replace('https://link.springer.com/chapter/', '', $query);
        $url = 'http://api.springernature.com/meta/v2/json?q=doi:' . urlencode($query) . '&api_key=' . 'f99e4740f3ccd28f81a8ea39ec4c3a79';
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
