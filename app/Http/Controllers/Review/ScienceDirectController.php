<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScienceDirectController extends Controller
{
    public function index()
    {
        $data = [
            "parent" => "Review",
            "child" => "ScienceDirect",
        ];
        return view('pages.review.sciencedirect.index', $data);
    }

}
