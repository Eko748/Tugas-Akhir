<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;
use Illuminate\Http\Request;

class CiteSeerxController extends ReviewMasterController
{
    // private string $apiKey;
    private string $child;
    private array $data;

    public function __construct(Request $request)
    {
        $this->child = 'CiteSeerx';
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
    
    public function reviewCiteSeerx()
    {
        return view('pages.review.citeseerx.index', $this->data);
    }

}
