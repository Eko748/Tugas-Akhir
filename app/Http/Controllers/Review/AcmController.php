<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;

class AcmController extends ReviewMasterController
{
    public function reviewAcm()
    {
        $data = [
            "parent" => "Review",
            "child" => "ACM"
        ];
        return view('pages.review.acm.index', $data);
    }

}
