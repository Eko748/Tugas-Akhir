<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcmController extends Controller
{
    public function index()
    {
        $data = [
            "parent" => "Review",
            "child" => "ACM"
        ];
        return view('pages.review.acm.index', $data);
    }

}
