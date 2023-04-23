<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface RecycleController
{
    public function requestRecycleData(Request $request);
}
