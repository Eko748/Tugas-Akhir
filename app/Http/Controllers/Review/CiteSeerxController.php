<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Review\ReviewMasterController;

class CiteSeerxController extends ReviewMasterController
{
    public function reviewCiteSeerx()
    {
        $data = [
            "parent" => "Review",
            "child" => "CiteSeerx",
        ];
        return view('pages.review.citeseerx.index', $data);
    }

}
