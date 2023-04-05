<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use Illuminate\Http\Request;

class ScienceDirectController extends ReviewMasterController
{
    private string $apiKey;
    private string $child;
    private array $data;

    public function __construct(Request $request)
    {
        $this->child = 'ScienceDirect';
        // $ieee = $this->searchIeeeData($request);
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child,
            // 'search' => $ieee['search'],
            // 'path' => $ieee['path'],
            // 'client' => $ieee['client'],
            // 'references' => $ieee['references'],
        ];
    }
    
    public function reviewScienceDirect()
    {
        return view('pages.review.sciencedirect.index', $this->data);
    }

}
