<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Models\ScrapingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Rules\Uppercase;


class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            "code" => ['required', 'string', 'uppercase'],
            "category_name" => "required"
        ]);

        $category = ScrapingCategory::create([
            "code" => $request->code,
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name),
            "created_by" => Auth::user()->id,
        ]);

        return redirect()->back()->with(
            ($category) ? ['message' => 'Data berhasil disimpan!'] : ['error' => 'Nampaknya terjadi kesalahan']
        );
    }
}
