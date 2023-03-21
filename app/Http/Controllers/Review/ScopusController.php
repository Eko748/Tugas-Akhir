<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scopus\ScopusApi;

class ScopusController extends Controller
{
    public function search(Request $request)
    {
        // $request = '882796ebf357108955189c9cc7b8b9bf';
        $scopus = new ScopusApi('882796ebf357108955189c9cc7b8b9bf');
        $s = 'artificial';
        $results = $scopus->search(['query'=>'ha']);
        // $results = $scopus->retrieveAbstract('85146335078', ['query'=>'artificial']);
        dd($results);
        return response()->json($results);
    }
}
