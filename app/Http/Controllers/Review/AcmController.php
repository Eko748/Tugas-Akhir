<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Auth;

class AcmController extends ReviewMasterController
{
    private string $child;
    private array $data;

    public function __construct(Request $request)
    {
        $this->child = 'ACM';
        $acm = $this->searchAcmData($request);
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
            'search' => $acm['query'],
            'key' => $acm['key'],
        ];
    }

    public function showReviewAcm(Request $request)
    {
        return view('pages.review.acm.index', $this->data);
    }

    public function requestAcmData(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.review.acm.content.components.2-data', $this->data)->render();
        }
    }

    private function searchAcmData(Request $request)
    {
        $delay = 2000;
        $maxRequestsPerMinute = 30;
        $query = $request->query('search');
        $client = new Client();
        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3 Edg/91.0.864.59',
                'Accept-Language' => 'en-US,en;q=0.9',
            ],
        ];
        $requestCount = 0;
        $lastRequestTime = 0;

        $data = null;

        while ($requestCount < $maxRequestsPerMinute) {
            $timeSinceLastRequest = microtime(true) - $lastRequestTime;
            if (!empty($query)) {
                $response = $client->request('GET', $query, $options);
            } else {
                $response = $client->request('GET', 'https://dl.acm.org/doi/10.1145/2018567.2018569', $options);
            }
            if ($timeSinceLastRequest * 1000 >= $delay) {
                $requestCount++;
                $lastRequestTime = microtime(true);

                $title_node = $response->filter('h1.citation__title');
                if ($title_node->count() > 0) {
                    $title = $title_node->text();
                } else {
                    $title = '';
                }
                $publisher = $response->filter('.publisher__name')->text();
                $publication = $response->filter('span.epub-section__title')->text();
                $year = $response->filter('span.CitationCoverDate')->text();
                $type = $response->filter('a.content-navigation__btn--pre > span.type')->text();
                $cited = $response->filter('.citation > span.bold')->text();
                $authors = [];
                $response->filter('span.loa__author-name')->each(function ($node) use (&$authors) {
                    $authors[] = $node->text();
                });
                $abstract = $response->filter('div.abstractSection.abstractInFull')->text();
                $keywords = [];
                $response->filter('.badge-type')->each(function ($node) use (&$keywords) {
                    $keywords[] = $node->text();
                });
                $references = [];
                $response->filter('.references__item')->each(function ($node) use (&$references) {
                    foreach ($node->filter('.references__suffix') as $suffix) {
                        $suffix->parentNode->removeChild($suffix);
                    }
                    $references[] = $node->text();
                });

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
            } else {
                $role_id = Auth::user()->role_id;
                return response()->view('pages.error.404.index', ['role_id' => $role_id])->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                ]);
            }
            return $data;
        }
    }
}
