<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Interface\ValidationData;
use App\Models\Review;
use Illuminate\{Http\Request, Support\Str, Support\Facades\Auth};

class ReviewMasterController extends ReviewController implements ValidationData
{
    private string $label = 'Master';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showReview()
    {
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
            'category' => $this->getCategoryReview()
        ];
        return view('pages.review.master.index', $this->data);
    }

    public function createReview(Request $request)
    {
        try {
            $reference_source = $request->has('reference_source') ? $request->reference_source : null;
            Review::create(
                [
                    'id' => random_int(1000000, 9999999),
                    'uuid_review' => Str::uuid(),
                    'project_id' => $this->getProjectReview()['project']->id,
                    'category_id' => $request->category_id,
                    'code' => $request->code . Auth::user()->code . $this->getProjectReview()['code'],
                    'title' => $request->title,
                    'publisher' => $request->publisher,
                    'publication' => $request->publication,
                    'year' => $request->year,
                    'type' => $request->type,
                    'cited' => $request->cited,
                    'abstracts' => $request->abstracts,
                    'authors' => $request->authors,
                    'keywords' => $request->keywords,
                    'references' => $request->references,
                    'reference_source' => $reference_source,
                    'created_by' => Auth::user()->id,
                ]
            );
            return response()->json(['success' => 'Review berhasil ditambahkan ke Project']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal, silahkan coba lagi', 'message' => $e->getMessage()]);
        }
    }

    public function validateDataCreate(Request $request)
    {
        return $request->validate(
            [],
            [
                'required' => 'Kolom :attribute harus diisi.',
                'string' => 'Kolom :attribute harus berupa teks.',
                'alpha' => 'Kolom :attribute harus diisi dengan huruf saja.',
                'size' => 'Kolom :attribute harus terdiri dari satu karakter.',
                'uppercase' => 'Kolom :attribute harus diisi dengan huruf kapital.',
                'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
                'integer' => 'Kolom :attribute harus diisi dengan angka.'
            ]
        );
    }

}
