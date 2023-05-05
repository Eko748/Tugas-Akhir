<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use ProxyManager\Factory\ProxyFactory;
use ProxyManager\Proxy\VirtualProxyInterface;

class ScienceDirectController extends ReviewMasterController
{
    private string $child = 'ScienceDirect';
    private array $data;

    public function __construct()
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
        ];
    }

    public function showReviewScienceDirect()
    {
        $client = new Client();
        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36',
            ],
        ];
        $response = $client->request('GET', 'https://sciencedirect.com/science/article/abs/pii/S2214212621001939', $options);
        echo $response->html();

        // 'Content-Type' => 'text/html; charset=UTF-8',
        // 'Connection' => 'keep-alive',
        // 'X-Frame-Options' => 'SAMEORIGIN',
        // 'Referrer-Policy' => 'same-origin',
        // 'Cache-Control' => 'private, max-age=0, no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
        // 'Expires' => 'Thu, 01 Jan 1970 00:00:01 GMT',
        // 'Set-Cookie' => '__cf_bm=ITmPqWaY4R7RdBP6ehlFLHO_OKBtWjIaPz30W1Sk4ac-1682430351-0-AUmahOUYNOCxurgOd9d+Nqc5IjL1XitfqkEX6bDPanzzzyBuyEVYXhH4Dj4Pqn8LNY/MsYr5U3OK536NDGgv9wQ8Hc1LkgGDF/flwV8QxFvn; path=/; expires=Tue, 25-Apr-23 14:15:51 GMT; domain=.sciencedirect.com; HttpOnly; Secure; SameSite=None',
        // 'Strict-Transport-Security' => 'max-age=2678400; preload',
        // 'X-Content-Type-Options' => 'nosniff',
        // 'Server' => 'cloudflare',
        // 'CF-RAY' => '7bd7075dd8564acd-CGK',
        // 'http-equiv' => 'Content-Type'
        // $html = (string) $response->getBody();
        // $crawler = new Crawler($html);
        // $hitung = 1;
        // $items = $crawler->html();
        // $html = $crawler->html();
    }

    //    return view('pages.review.category.science.index', $this->data);

    public function requestScienceDirectData(Request $request)
    {
        try {
            $science = $this->searchScienceDirectData($request);
            $this->data = [
                'search' => $science['query'],
                'key' => $science['key']
            ];
            if ($request->ajax()) {
                return view('pages.review.category.science.content.components.2-data', $this->data)->render();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data ScienceDirect'], 500);
        }
    }

    // private function searchScienceDirectData(Request $request)
    // {
    //     try {
    //         $delay = 2000;
    //         $maxRequestsPerMinute = 30;
    //         $query = $request->input('search');
    //         $client = new Client();
    //         $options = [
    //             'headers' => [
    //                 'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3 Edg/91.0.864.59',
    //                 'Accept-Language' => 'en-US,en;q=0.9',
    //             ],
    //         ];
    //         $requestCount = 0;
    //         $lastRequestTime = 0;

    //         while ($requestCount < $maxRequestsPerMinute) {
    //             $timeSinceLastRequest = microtime(true) - $lastRequestTime;
    //             if (!empty($query)) {
    //                 $response = $client->request('GET', 'https://www.sciencedirect.com/science/article/abs/pii/' . $query);
    //                 if ($timeSinceLastRequest * 1000 >= $delay) {
    //                     $requestCount++;
    //                     $lastRequestTime = microtime(true);

    //                     $title_node = $response->filter('span.title-text');
    //                     if ($title_node->count() > 0) {
    //                         $title = $title_node->text();
    //                     } else {
    //                         $title = '';
    //                     }
    //                     $publisher = $response->filter('meta[name="citation_publisher"]')->attr('content');
    //                     $publication = $response->filter('a.publication-title-link')->text();
    //                     $year = $response->filter('meta[name="citation_publication_date"]')->attr('content');
    //                     $type = $response->filter('meta[name="citation_type"]')->attr('content');
    //                     $cited = $response->filter('#citing-articles-header > h2')->text();
    //                     $authors = [];
    //                     $response->filter('span.react-xocs-alternative-link')->each(function ($node) use (&$authors) {
    //                         $authors[] = $node->text();
    //                     });
    //                     $abstract = $response->filter('div.Abstracts > div > div > p > span')->text();
    //                     $keywords = [];
    //                     $response->filter('div.keyword')->each(function ($node) use (&$keywords) {
    //                         $keywords[] = $node->text();
    //                     });
    //                     $references = [];
    //                     $response->filter('.bib-reference')->each(function ($node) use (&$references) {
    //                         $references[] = $node->text();
    //                     });
    //                 } else {
    //                     return response()->json(['error' => 'Terjadi kesalahan saat mengambil data ACM'], 500);
    //                 }
    //                 $data = [
    //                     'query' => $query,
    //                     'key' => [
    //                         'title' => $title,
    //                         'publisher' => $publisher,
    //                         'publication' => $publication,
    //                         'year' => $year,
    //                         'type' => $type,
    //                         'cited' => $cited,
    //                         'authors' => $authors,
    //                         'abstract' => $abstract,
    //                         'keywords' => $keywords,
    //                         'references' => $references,
    //                     ]
    //                 ];
    //             }
    //             return $data;
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Terjadi kesalahan saat mengambil data ScienceDirect'], 500);
    //     }
    // }
}
