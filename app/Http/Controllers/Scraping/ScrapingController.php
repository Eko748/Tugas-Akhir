<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Models\ScrapingCategory;
use Goutte\Client;
use Illuminate\Support\Facades\Auth;

class ScrapingController extends Controller
{
    public function index()
    {
        $category = ScrapingCategory::where('created_by', Auth::user()->id)->get();
        $data = [
            "parent" => "Scraping",
            "child" => "Document",
            "category" => $category
        ];
        return view('pages.scraping.document.index', $data);
    }

    public function getScraping()
    {
        $url = 'https://ieeexplore.ieee.org/xpl/dwnldReferences?arnumber=9221420';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        // mengambil teks dari tag <body>
        $text = $crawler->filter('body')->text();

        // menghapus karakter \n dan \r
        $text = str_replace(array("\r", "\n"), '', $text);

        // memisahkan teks ke dalam array yang terpisah per item
        $items = preg_split('/(?<=\d\.)/', $text);

        // membersihkan setiap item dari spasi di awal dan akhir, dan menghapus baris kosong
        foreach ($items as $key => $value) {
            $value = trim($value);
            if (empty($value)) {
                unset($items[$key]);
            } else {
                $items[$key] = $value;
            }
        }
        // dd($text);

        $data = [
            "parent" => "Scraping",
            "child" => "IEEE",
            "items" => $items,
        ];

        return view('pages.scraping.document.index', $data);
    }
}
