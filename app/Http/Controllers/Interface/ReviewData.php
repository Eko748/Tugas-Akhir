<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface ReviewData
{
    public function showReviewData();
    public function requestReviewData(Request $request);
    public function searchReviewData(Request $request);
}
