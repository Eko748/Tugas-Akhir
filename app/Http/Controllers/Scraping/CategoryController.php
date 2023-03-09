<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

        $category = Category::create([
            "uuid_category" => Str::uuid(),
            "code" => $request->code,
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name),
            "created_by" => Auth::user()->id,
        ]);

        return redirect()->back()->with(
            ($category) ? ['message' => 'Data berhasil disimpan!'] : ['error' => 'Nampaknya terjadi kesalahan']
        );
    }

    public function getCategory(Request $req)
    {
        $search = $req->q;
        $categories = Category::where('code', 'LIKE', '%' . $search . '%')
            ->orWhere('category_name', 'LIKE', '%' . $search . '%')
            ->orderBy('code', 'asc')
            ->get();

        $response = [];
        foreach ($categories as $category) {
            $response[] = [
                'id' => $category->id,
                'code' => $category->code,
                'text' => $category->code . '/' . $category->category_name
            ];
        }

        return response()->json($response);
    }
}
