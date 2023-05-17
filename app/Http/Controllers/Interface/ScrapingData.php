<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface ScrapingData
{
    public function showScrapingData();
    public function requestScrapingData(Request $request);
    public function searchScrapingData(Request $request);
}
