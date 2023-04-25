<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use Goutte\Client;
use Illuminate\Http\Request;

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
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3 Edg/91.0.864.59',
                'Accept-Language' => 'en-US,en;q=0.9',
            ],
        ];
        $crawler = $client->request('GET', 'https://www.sciencedirect.com/science/article/abs/pii/B9780128182345001590', [
            'timeout' => 5, // menunggu 5 detik sebelum melakukan ekstraksi HTML
        ]);
        
        $html = $crawler->html();
        dd($html);
        
        //    return view('pages.review.category.science.index', $this->data);
    }

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

    private function searchScienceDirectData(Request $request)
    {
        try {
            $delay = 2000;
            $maxRequestsPerMinute = 30;
            $query = $request->input('search');
            $client = new Client();
            $options = [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3 Edg/91.0.864.59',
                    'Accept-Language' => 'en-US,en;q=0.9',
                ],
            ];
            $requestCount = 0;
            $lastRequestTime = 0;

            while ($requestCount < $maxRequestsPerMinute) {
                $timeSinceLastRequest = microtime(true) - $lastRequestTime;
                if (!empty($query)) {
                    $response = $client->request('GET', 'https://www.sciencedirect.com/science/article/abs/pii/' . $query);
                    if ($timeSinceLastRequest * 1000 >= $delay) {
                        $requestCount++;
                        $lastRequestTime = microtime(true);

                        $title_node = $response->filter('span.title-text');
                        if ($title_node->count() > 0) {
                            $title = $title_node->text();
                        } else {
                            $title = '';
                        }
                        $publisher = $response->filter('meta[name="citation_publisher"]')->attr('content');
                        $publication = $response->filter('a.publication-title-link')->text();
                        $year = $response->filter('meta[name="citation_publication_date"]')->attr('content');
                        $type = $response->filter('meta[name="citation_type"]')->attr('content');
                        $cited = $response->filter('#citing-articles-header > h2')->text();
                        $authors = [];
                        $response->filter('span.react-xocs-alternative-link')->each(function ($node) use (&$authors) {
                            $authors[] = $node->text();
                        });
                        $abstract = $response->filter('div.Abstracts > div > div > p > span')->text();
                        $keywords = [];
                        $response->filter('div.keyword')->each(function ($node) use (&$keywords) {
                            $keywords[] = $node->text();
                        });
                        $references = [];
                        $response->filter('.bib-reference')->each(function ($node) use (&$references) {
                            $references[] = $node->text();
                        });
                    } else {
                        return response()->json(['error' => 'Terjadi kesalahan saat mengambil data ACM'], 500);
                    }
                    $data = [
                        'query' => $query,
                        'key' => [
                            'title' => $title,
                            'publisher' => $publisher,
                            'publication' => $publication,
                            'year' => $year,
                            'type' => $type,
                            'cited' => $cited,
                            'authors' => $authors,
                            'abstract' => $abstract,
                            'keywords' => $keywords,
                            'references' => $references,
                        ]
                    ];
                }
                return $data;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data ScienceDirect'], 500);
        }
    }
}
