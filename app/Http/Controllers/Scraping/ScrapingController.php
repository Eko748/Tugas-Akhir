<?php
  
namespace App\Http\Controllers\Scraping;
  
use App\Http\Controllers\Controller;

class ScrapingController extends Controller
{
    public function index()
    {
        $data = ["parent" => "Scraping", "child" => "Document"];
        return view('pages.scraping.index', $data);
    }
}