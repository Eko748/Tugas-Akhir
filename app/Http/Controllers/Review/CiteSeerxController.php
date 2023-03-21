<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CiteSeerxController extends Controller
{
    public function index()
    {
        $data = [
            "parent" => "Review",
            "child" => "CiteSeerx",
        ];
        return view('pages.review.citeseerx.index', $data);
    }

}
