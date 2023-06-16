<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Interface\ScrapingData;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Validation;

class AcmController extends ScrapingMasterController implements ScrapingData
{
    private string $label = 'ACM';
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
        return view('pages.review.category.acm.index', $this->data);
    }

    public function requestScrapingData(Request $request)
    {
        try {
            $acm = $this->searchScrapingData($request);
            return $acm;
            die();
            if (Auth::check()) {
                $exist = $this->getData()['exists'];
            } else {
                $exist = 'Tidak ada';
            }
            $this->data = [
                'key' => $acm['key'],
                'exist' => $exist
            ];
            if ($request->ajax()) {
                // return view('pages.review.category.acm.content.components.2-data', $this->data)->render();
            }
        } catch (\Exception $e) {
            $this->data = [
                'error' => 'Data ACM tidak ditemukan',
            ];
            return view('pages.review.category.acm.content.components.2-data', $this->data)->render();
        }
        return view('pages.review.category.acm.content.components.2-data', $this->data)->render();
    }

    public function searchScrapingData($request)
    {
        $validator = Validation::createValidator();
        $constraint = new Url();
        $query = $request->input('search');
        $errors = $validator->validate($query, $constraint);

        if (count($errors) > 0) {
            throw new \Exception('URL tidak valid');
        }

        try {
            $delay = 9000;
            $maxRequestsPerMinute = 30;

            $client = new Client();
            $options = [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3 Edg/91.0.864.59',
                    'Accept-Language' => 'en-US,en;q=0.9',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'X-Forwarded-For' => $_SERVER['REMOTE_ADDR']
                ]
            ];
            
            
            $requestCount = 0;
            $lastRequestTime = 0;
            while ($requestCount < $maxRequestsPerMinute) {
                $timeSinceLastRequest = microtime(true) - $lastRequestTime;
                if (!empty($query)) {
                    $response = $client->request('GET', $query, $options);
                    $r = $response->html();
                    // if ($timeSinceLastRequest * 1000 >= $delay) {
                    //     $requestCount++;
                    //     $lastRequestTime = microtime(true);
                    //     $title_node = $response->filter('h1.citation__title');
                    //     if ($title_node->count() > 0) {
                    //         $title = $title_node->text();
                    //     } else {
                    //         $title = '';
                    //     }
                    //     $publisher = $response->filter('.publisher__name')->text();
                    //     $publication = $response->filter('span.epub-section__title')->text();
                    //     $year = $response->filter('span.CitationCoverDate')->text();
                    //     $type = $response->filter('a.content-navigation__btn--pre > span.type')->text();
                    //     $cited = $response->filter('.citation > span.bold')->text();
                    //     $authors = [];
                    //     $response->filter('span.loa__author-name')->each(function ($node) use (&$authors) {
                    //         $authors[] = $node->text();
                    //     });
                    //     $abstract = $response->filter('div.abstractSection.abstractInFull')->text();
                    //     $keywords = [];
                    //     $response->filter('.badge-type')->each(function ($node) use (&$keywords) {
                    //         $keywords[] = $node->text();
                    //     });
                    //     $references = [];
                    //     $response->filter('.references__item')->each(function ($node) use (&$references) {
                    //         foreach ($node->filter('.references__suffix') as $suffix) {
                    //             $suffix->parentNode->removeChild($suffix);
                    //         }
                    //         $references[] = $node->text();
                    //     });

                    //     $data = [
                    //         'key' => [
                    //             'title' => $title,
                    //             'publisher' => $publisher,
                    //             'publication' => $publication,
                    //             'year' => $year,
                    //             'type' => $type,
                    //             'cited' => $cited,
                    //             'authors' => $authors,
                    //             'abstract' => $abstract,
                    //             'keywords' => $keywords,
                    //             'references' => $references,
                    //         ]
                    //     ];

                    //     return $data;
                    // } else {
                    //     throw new \Exception('Terjadi kesalahan terhadap permintaan data');
                    // }
                    return $r;
                }
            }
        } catch (\Exception $e) {
            throw new \Exception('Terjadi kesalahan saat mengambil data ACM');
        }
    }
}
