<?php
  
namespace App\Http\Controllers\Scraping;
  
use App\Http\Controllers\Controller;
use App\Models\ScrapingCategory;
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
        
    }

}