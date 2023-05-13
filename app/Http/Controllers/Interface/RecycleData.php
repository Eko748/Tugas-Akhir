<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface RecycleData
{
    public function showRecycleData();
    public function requestRecycleData(Request $request);
    public function restoreRecycleData(Request $request);
    public function deleteRecycleData(Request $request);
}
