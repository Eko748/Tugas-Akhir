<?php
  
namespace App\Http\Controllers\Scraping;
  
use App\Http\Controllers\Controller;
use App\Models\ScrapingTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Rules\Uppercase;


class TemplateController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            // "code" => ['required', 'string', new Uppercase],
            // "category_name" => "required"
        ]);

        $template = ScrapingTemplate::create([
            "category_id" => $request->code,
            "icon" => $request->icon,
            "title" => $request->title,
            "publication" => $request->publication,
            "year" => $request->year,
            "authors" => $request->authors,
            "abstracts" => $request->abstracts,
            "keywords" => $request->keywords,
            "type" => $request->type,
            "publisher" => $request->publisher,
            "references" => $request->references,
            "bahasa" => $request->bahasa,
            "cited" => $request->cited,
            "citing" => $request->citing,
            "created_by" => Auth::user()->id,
        ]);

        return ($template==true)?redirect()->back()->with('message','Data berhasil disimpan!'):redirect()->back()->with('error','Nampaknya terjadi kesalahan');

    }
}