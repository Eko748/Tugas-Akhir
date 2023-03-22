<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;

class ScienceDirectController extends ReviewMasterController
{
    public function reviewScienceDirect()
    {
        $data = [
            "parent" => "Review",
            "child" => "ScienceDirect",
        ];
        return view('pages.review.sciencedirect.index', $data);
    }

}
